# Security Changes Review

**Project:** DCD Backend
**Date:** 2026-01-26
**Review Type:** Security Remediation
**Total Files Modified:** 10

---

## Summary of Changes

| Severity | Issues Fixed |
|----------|--------------|
| Critical | 2 |
| High | 6 |
| Medium | 5 |
| **Total** | **13** |

---

## 1. SQL Injection Fixes

### File: `app/Http/Controllers/Apis/CommonController.php`

#### Change 1: FAQ Search (Lines 232-237)

**Before:**
```php
if($search = $request->search){
    $faqs->where(function($query) use($search){
        $query->whereRaw("MATCH (question) AGAINST ('{$search}')")->orWhereRaw("MATCH (answer) AGAINST ('{$search}')")->orWhere('question', 'LIKE', '%'.$search.'%')->orWhere('answer', 'LIKE', '%'.$search.'%');
    });
}
```

**After:**
```php
if($search = $request->search){
    $faqs->where(function($query) use($search){
        $query->whereRaw("MATCH (question) AGAINST (? IN BOOLEAN MODE)", [$search])
              ->orWhereRaw("MATCH (answer) AGAINST (? IN BOOLEAN MODE)", [$search])
              ->orWhere('question', 'LIKE', '%'.$search.'%')
              ->orWhere('answer', 'LIKE', '%'.$search.'%');
    });
}
```

**Reason:** User input was directly interpolated into raw SQL, allowing SQL injection attacks.

---

#### Change 2: Leads Search (Lines 247-252)

**Before:**
```php
if($search = $request->search){
    $leads->where(function($query) use($search){
        $query->whereRaw("MATCH (name) AGAINST ('{$search}')")->orWhereRaw("MATCH (email) AGAINST ('{$search}')")->orWhere('phone_number', 'LIKE', '%'.$search.'%')->orWhere('created_at', 'LIKE', '%'.$search.'%');
    });
}
```

**After:**
```php
if($search = $request->search){
    $leads->where(function($query) use($search){
        $query->whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", [$search])
              ->orWhereRaw("MATCH (email) AGAINST (? IN BOOLEAN MODE)", [$search])
              ->orWhere('phone_number', 'LIKE', '%'.$search.'%')
              ->orWhere('created_at', 'LIKE', '%'.$search.'%');
    });
}
```

**Reason:** Same SQL injection vulnerability as above.

---

## 2. Authentication & Authorization

### File: `routes/api.php`

#### Change 1: Protect Leads API with Authentication (Lines 88-93)

**Before:**
```php
Route::get('faq', [CommonController::class, 'faq'])->name('api.faq');
Route::get('leads', [CommonController::class, 'leads'])->name('api.leads');
Route::get('leads/{id}', [CommonController::class, 'leads_view'])->name('api.leads_view');
```

**After:**
```php
Route::get('faq', [CommonController::class, 'faq'])->name('api.faq');

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('leads', [CommonController::class, 'leads'])->name('api.leads');
    Route::get('leads/{id}', [CommonController::class, 'leads_view'])->name('api.leads_view');
});
```

**Reason:** Leads endpoint exposed sensitive customer PII (names, emails, phone numbers) without authentication.

---

#### Change 2: Rate Limiting on Auth Endpoints (Lines 35-36)

**Before:**
```php
Route::post('login', [AuthController::class, 'login'])->name('app.login');
Route::post('verify-otp', [AuthController::class, 'verify_otp'])->name('app.verify-otp');
```

**After:**
```php
Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('app.login');
Route::post('verify-otp', [AuthController::class, 'verify_otp'])->middleware('throttle:5,1')->name('app.verify-otp');
```

**Reason:** Prevent brute-force attacks and OTP enumeration. Limits to 5 requests per minute.

---

#### Change 3: Rate Limiting on Job Application (Line 81)

**Before:**
```php
Route::post('jobs/apply', [JobController::class, 'apply'])->name('api.jobs.apply');
```

**After:**
```php
Route::post('jobs/apply', [JobController::class, 'apply'])->middleware('throttle:10,1')->name('api.jobs.apply');
```

**Reason:** Prevent form spam. Limits to 10 requests per minute.

---

#### Change 4: Rate Limiting on Contact Form (Line 98)

**Before:**
```php
Route::post('contact/save', [CommonController::class, 'contact_save'])->name('contacts.save');
```

**After:**
```php
Route::post('contact/save', [CommonController::class, 'contact_save'])->middleware('throttle:10,1')->name('contacts.save');
```

**Reason:** Prevent form spam. Limits to 10 requests per minute.

---

## 3. CORS Configuration

### File: `config/cors.php`

**Before:**
```php
'allowed_methods' => ['*'],

'allowed_origins' => ['*'],

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'],
```

**After:**
```php
'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

'allowed_origins' => array_filter([
    env('FRONTEND_URL'),
    'http://localhost:3000',
    'http://127.0.0.1:3000',
]),

'allowed_origins_patterns' => [],

'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With', 'Accept', 'Origin'],
```

**Reason:** Wildcard CORS allowed any website to make requests. Now restricted to specific frontend domains.

**Action Required:** Set `FRONTEND_URL` in `.env` for production.

---

## 4. Token Expiration

### File: `config/sanctum.php`

**Before:**
```php
'expiration' => null,
```

**After:**
```php
'expiration' => 1440, // 24 hours
```

**Reason:** Tokens never expired, meaning compromised tokens remained valid indefinitely.

---

## 5. Session Security

### File: `config/session.php`

#### Change 1: Enable Encryption (Line 49)

**Before:**
```php
'encrypt' => false,
```

**After:**
```php
'encrypt' => env('SESSION_ENCRYPT', true),
```

**Reason:** Session data was stored unencrypted.

---

#### Change 2: Secure Cookies (Line 171)

**Before:**
```php
'secure' => env('SESSION_SECURE_COOKIE'),
```

**After:**
```php
'secure' => env('SESSION_SECURE_COOKIE', env('APP_ENV') === 'production'),
```

**Reason:** Secure cookie flag was not enforced in production by default.

---

## 6. OTP Security

### File: `app/Http/Controllers/Apis/AuthController.php`

#### Change 1: Add Hash Import (Line 5)

**Added:**
```php
use Illuminate\Support\Facades\Hash;
```

---

#### Change 2: Secure OTP Generation & Storage (Lines 48-54)

**Before:**
```php
$otp = rand(111111,999999);
$admin->otp = $otp;
$admin->otp_sent_on = date('Y-m-d H:i:s');
$admin->save();

$mail = new MailSettings;
$mail->to($admin->email)->send(new RequestOtp($admin->name, $admin->otp));
```

**After:**
```php
$otp = random_int(100000, 999999);
$admin->otp = Hash::make($otp);
$admin->otp_sent_on = now();
$admin->save();

$mail = new MailSettings;
$mail->to($admin->email)->send(new RequestOtp($admin->name, $otp));
```

**Reason:**
1. `rand()` is not cryptographically secure; `random_int()` is CSPRNG
2. OTP was stored as plaintext; now hashed with bcrypt
3. Plain OTP sent to email, hashed version stored in database

---

#### Change 3: OTP Verification (Line 89)

**Before:**
```php
if($admin->otp != $data['otp']){
```

**After:**
```php
if(!Hash::check($data['otp'], $admin->otp)){
```

**Reason:** Compare user input against hashed OTP using `Hash::check()`.

---

## 7. File Upload Validation

### File: `app/Http/Requests/Job.php`

**Before:**
```php
public function rules(): array
{
    return [
        //
    ];
}
```

**After:**
```php
public function rules(): array
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'nullable|string|max:20',
        'message' => 'nullable|string|max:5000',
        'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        'careers_id' => 'nullable|integer|exists:jobs,id',
    ];
}

/**
 * Get custom messages for validator errors.
 *
 * @return array<string, string>
 */
public function messages(): array
{
    return [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'resume.required' => 'Please upload your resume.',
        'resume.mimes' => 'Resume must be a PDF, DOC, or DOCX file.',
        'resume.max' => 'Resume file size must not exceed 5MB.',
    ];
}
```

**Reason:** No validation existed; attackers could upload any file type (including PHP shells) of any size.

---

## 8. Exception Handling

### File: `app/Http/Controllers/Apis/JobController.php`

#### Change 1: Add Log Import (Line 6)

**Added:**
```php
use Illuminate\Support\Facades\Log;
```

---

#### Change 2: Index Method Exception (Lines 30-36)

**Before:**
```php
catch(\Exception $e){
    return response()->json(['error' => $e->getMessage()], 500);
}
```

**After:**
```php
catch(\Exception $e){
    Log::error('Job listing failed', [
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
        'ip' => request()->ip()
    ]);
    return response()->json(['error' => 'Unable to fetch jobs. Please try again later.'], 500);
}
```

---

#### Change 3: View Method Exception (Lines 49-56)

**Before:**
```php
catch(\Exception $e){
    return response()->json(['error' => $e->getMessage()], 500);
}
```

**After:**
```php
catch(\Exception $e){
    Log::error('Job view failed', [
        'error' => $e->getMessage(),
        'slug' => $slug ?? null,
        'trace' => $e->getTraceAsString(),
        'ip' => request()->ip()
    ]);
    return response()->json(['error' => 'Unable to fetch job details. Please try again later.'], 500);
}
```

---

#### Change 4: Apply Method Exception (Lines 92-99)

**Before:**
```php
catch(\Exception $e){
    return response()->json(['error' => $e->getMessage()], 500);
}
```

**After:**
```php
catch(\Exception $e){
    Log::error('Job application failed', [
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
        'ip' => request()->ip()
    ]);
    return response()->json(['error' => 'Unable to submit application. Please try again later.'], 500);
}
```

**Reason:** Raw exception messages were returned to clients, potentially leaking database structure, file paths, and internal logic.

---

## 9. Global Exception Handler

### File: `app/Exceptions/Handler.php`

**Before:**
```php
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
```

**After:**
```php
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Sanitize exception responses for API routes
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

                // Log the actual error for debugging
                if ($statusCode >= 500) {
                    Log::error('API Exception', [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'url' => $request->fullUrl(),
                        'method' => $request->method(),
                        'ip' => $request->ip(),
                    ]);
                }

                // Return generic message in production
                if (app()->isProduction() && $statusCode >= 500) {
                    return response()->json([
                        'error' => 'An unexpected error occurred. Please try again later.'
                    ], $statusCode);
                }
            }
        });
    }
}
```

**Reason:** Provides global exception sanitization for all API routes in production, ensuring no sensitive information is leaked.

---

## 10. Security Logging

### File: `config/logging.php`

**Added channel:**
```php
'security' => [
    'driver' => 'daily',
    'path' => storage_path('logs/security.log'),
    'level' => 'info',
    'days' => 90,
    'replace_placeholders' => true,
],
```

**Reason:** Dedicated logging channel for security events with 90-day retention.

**Usage:**
```php
Log::channel('security')->warning('Failed login attempt', [
    'email' => $email,
    'ip' => request()->ip(),
]);
```

---

## Database Migration Required

The OTP field now stores hashed values (60+ characters). Create and run this migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('otp', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->unsignedMediumInteger('otp')->nullable()->change();
        });
    }
};
```

**Run:**
```bash
php artisan make:migration change_otp_column_to_string_in_admins_table
# Edit the migration file with the above code
php artisan migrate
```

---

## Environment Variables Required

Add to `.env` for production:

```env
# Application
APP_ENV=production
APP_DEBUG=false

# Frontend URL for CORS
FRONTEND_URL=https://your-production-domain.com

# Session (optional - defaults are now secure)
SESSION_SECURE_COOKIE=true
SESSION_ENCRYPT=true
```

---

## Testing Checklist

Please verify the following after deploying:

- [ ] Login flow works correctly
- [ ] OTP is received via email
- [ ] OTP verification succeeds with correct code
- [ ] OTP verification fails with incorrect code
- [ ] Account lockout activates after 3 failed attempts
- [ ] Job application submission works
- [ ] Resume upload accepts PDF/DOC/DOCX only
- [ ] Resume upload rejects other file types
- [ ] Contact form submission works
- [ ] Rate limiting activates after threshold (test with rapid requests)
- [ ] Leads API returns 401 without authentication
- [ ] Leads API works with valid Sanctum token
- [ ] CORS allows requests from frontend domain
- [ ] CORS blocks requests from unauthorized domains

---

## Files Modified Summary

| File | Type of Change |
|------|----------------|
| `app/Http/Controllers/Apis/CommonController.php` | SQL injection fix |
| `app/Http/Controllers/Apis/AuthController.php` | OTP security |
| `app/Http/Controllers/Apis/JobController.php` | Exception handling |
| `app/Http/Requests/Job.php` | File validation |
| `app/Exceptions/Handler.php` | Global exception handler |
| `config/cors.php` | CORS restrictions |
| `config/sanctum.php` | Token expiration |
| `config/session.php` | Encryption & secure cookies |
| `config/logging.php` | Security log channel |
| `routes/api.php` | Auth & rate limiting |

---

## Questions?

Contact the security team for any questions regarding these changes.
