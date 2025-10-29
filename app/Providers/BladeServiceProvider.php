<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
  public function boot(): void
{
    Blade::directive('fieldshow', function ($input) {

        // Remove quotes from the directive input
        $input = str_replace(['"', "'"], '', $input);

        // Split into page and field keys
        $parts = explode('-', $input);
        $page = $parts[0] ?? null;
        $field = $parts[1] ?? null;

        return "<?php 
            \$field_array = config('admin.fields.{$page}') ?? [];
            if (in_array('{$field}', \$field_array)) : 
        ?>";
    });

    Blade::directive('endfieldshow', function () {
        return "<?php endif; ?>";
    });
}


    
}
