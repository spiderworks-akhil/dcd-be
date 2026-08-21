# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

DCD backend — a Laravel 12 / PHP 8.2 admin CMS (`/sw-admin`) plus a read-only public JSON API (`routes/api.php`) consumed by a separate frontend. There is no server-rendered public site; `routes/web.php` only serves a placeholder and includes `routes/admin.php`.

## Commands

```bash
composer install && npm install
php artisan serve                  # app
npm run dev                        # Vite (only needed for the Breeze/Tailwind auth scaffolding)
npm run build

php artisan migrate
php artisan db:seed

php artisan test                   # or vendor/bin/phpunit
php artisan test --filter=AdminAuthTest
php artisan test tests/Feature/AdminAuthTest.php

vendor/bin/pint                    # formatting (Pint is installed; most legacy code predates it)
```

`phpunit.xml` has the sqlite/`:memory:` env lines commented out, so **tests run against the `.env` database**. Any test using `RefreshDatabase` will wipe the dev DB — uncomment those lines locally before running such a test.

Clearing caches in a deployed environment: `GET /cache-clear` (`CacheClearController`) runs `cache:clear`, `config:clear`, `route:clear`, `view:clear`.

## Deployment

`.github/workflows/deploy.yml` SSHes into the production host and runs `./deploy.sh` on **every push to `main`**. `deploy.sh` is not in the repo. Treat pushes to `main` as deploys.

Because the deploy caches routes, `routes/*.php` must stay closure-free — every route points at a controller (see commit `dbc9c36`). Do not add `Route::get(..., function () {...})`.

## Architecture

### Two auth guards

- `web` guard → `App\Models\User` — Laravel Breeze scaffolding, largely vestigial.
- `admin` guard → `App\Models\Admin` — the real admin login. Uses `spatie/laravel-permission`'s `HasRoles` and Sanctum tokens.

`config/admin.php` drives the admin area: `url_prefix` (`/sw-admin`) and `admin_middleware` (`auth:admin`), both read at the top of `routes/admin.php`.

Admin login is an **email → OTP** flow (`Admin\Auth\AuthenticateSessionOtpController`), with a password path when `admins.authentication_method === 'username'`. The controller enforces its own rate limits via the `otp_sent_on`, `opt_try_count`, and `account_blocked_on` columns on `admins`.

### The CRUD backbone: `App\Traits\ResourceTrait`

Nearly every `Admin\*Controller` follows the same shape:

```php
class BlogController extends BaseController   // App\Http\Controllers\Admin\BaseController
{
    use ResourceTrait;

    public function __construct() {
        parent::__construct();                  // sets $this->route = $this->views = 'admin'
        $this->model = new Blog;
        $this->route .= '.blogs';               // route name prefix: admin.blogs.*
        $this->views .= '.blogs';               // view path: admin/blogs/*
        $this->permissions = ['list'=>'blog_listing','create'=>'blog_adding','edit'=>'blog_editing','delete'=>'blog_deleting'];
        $this->resourceConstruct();
    }

    protected function getCollection() { ... }      // abstract — the DataTables query
    protected function getSearchSettings() { ... }  // abstract — filter UI config
}
```

`resourceConstruct()` registers the spatie `permission:` middleware per action from `$this->permissions`, derives `$this->entity` from the model class name, and `View::share`s `route`, `views`, `entity`, `permissions` — the blades under `resources/views/admin/<entity>/` rely on those shared variables.

Key conventions the trait imposes:

- **Record IDs in admin URLs are `encrypt()`ed** and `decrypt()`ed in the controller. Any new admin route taking an id must follow this, or the shared blade partials and DataTables action links break.
- `index()` returns the blade for normal requests and **yajra DataTables JSON for AJAX requests**. `initDTData()` adds the standard `date`, `status`, `action_edit`, `action_ajax_edit`, `action_delete` columns (each permission-gated); subclasses override `setDTData()` mainly to declare `rawColumns`.
- Action links carry `webadmin-*` CSS classes (`webadmin-btn-warning-popup`, `webadmin-open-ajax-popup`) handled by `public/admin/assets/js/webadmin.js`.
- `redirect($op, $type, $view, $params)` centralises flash-message plus AJAX-vs-redirect handling.
- The default `store()`/`update()` normalise `status`, `is_featured`, `priority` from checkbox input. Controllers that override them (most do) must repeat that normalisation.

### Models

Content models extend `App\Models\BaseModel`, which:

- auto-stamps `created_by` / `updated_by` from `Auth::user()`, guarded by `Schema::hasColumn` (so it works on tables lacking those columns);
- uses `Haruncpi\LaravelUserActivity\Traits\Loggable` for activity logging (surfaced in the admin "Logs" section);
- defines `created_user`, `updated_user`, `featured_image`, `banner_image`, `og_image` relations conditionally on column existence.

Content models typically use `$guarded` (not `$fillable`) plus `SoftDeletes`.

### Two validation systems — check which one a controller uses

1. `App\Http\Requests\Admin\*Request` FormRequests, type-hinted in the action (newer controllers, e.g. `BlogController`, `EventController`).
2. `App\Traits\ValidationTrait` mixed into the *model*, called as `$this->model->validate($data, $id)` from `ResourceTrait`'s default `store()`/`update()` (older path; `Role`, `Permission` still use it). Rules live in the model's `setRules()`, with the literal token `ignoreId` string-replaced for unique-rule exclusion.

### Media & uploads

`BaseController::uploadFile()` is the single upload path. It classifies the mime type, picks a thumbnail placeholder, then branches on `config('app.flag')` (`FLAG` env var): `'AWS'` writes to the `s3` disk, anything else writes to `public/uploads/`. `saveMedia()` persists the resulting `Media` row and returns the shape the media-centre JS expects. Media can be attached polymorphically via `related_type` / `related_id`.

### Multi-language content

Language versions are a `type` **string column** on content tables — `en`, `en_draft`, `ar`, `ar_draft` — not a relation. The `languages` table holds the type list.

Which languages an admin may edit comes from the **`language_roles` table, queried with raw `DB::table()`** in the controllers (e.g. `EventController::getCollection()`). There is no migration for `language_roles` under `database/migrations/` — it exists in the database only, so `php artisan migrate` on a fresh DB does not produce a working install.

`EventController` also enforces a featured cap: `MAX_FEATURED = 4` per *language group*, where a group pairs a live type with its draft (`['en','en_draft']`). Published and draft rows compete for the same slots. `featuredPayload()` returns the currently-featured set so the client can render the swap popup from the same response that rejected the toggle.

### Approval workflow

`approval_notifications` links to content by string `notifiable_type` (`'Event'`, …) plus `notifiable_id`. Models expose `approvalNotification()` (latest row) and a `publication_status` accessor. Status transitions mail the relevant editors (`sendStatusMail`, `App\Mail\Admin\*`, `App\Services\MailSettings`).

### DB-driven admin sidebar

The sidebar is not hard-coded. `App\View\Components\AdminMenu` builds a tree from `admin_links` joined to `permissions` on `permissions.route = <current route name>`, rendered by `resources/views/admin/_partials/menu.blade.php`. **Adding an admin section requires a `permissions` row (with its `route` name) and an `admin_links` row**, not just a route and controller.

### Frontend assets — two disjoint stacks

- The admin UI is a **legacy jQuery + Bootstrap 4 theme committed under `public/admin/`** (DataTables, select2, summernote, metisMenu, jquery-confirm), loaded with `asset()` from `resources/views/admin/_layouts/default.blade.php`. Vite is not involved.
- Vite + Tailwind + Alpine build `resources/css/app.css` / `resources/js/app.js` and are used only by the Breeze scaffolding views (`resources/views/layouts/`, `resources/views/components/`).

### Public API

`routes/api.php` exposes unauthenticated read endpoints backed by `App\Http\Controllers\Apis\*` and `App\Http\Resources\*`. Auth endpoints (`login`, `verify-otp`) are `throttle:5,1`. `SECURITY_CHANGES_REVIEW.md` documents a past remediation pass on these controllers — notably, the raw `whereRaw("MATCH … AGAINST (?)")` full-text searches must stay parameter-bound.
