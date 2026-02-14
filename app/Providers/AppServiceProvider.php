<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            // Check if we are on shared hosting with public_html
            // Case 1: repo and public_html are at the same level
            $path1 = realpath(base_path() . '/../public_html');
            // Case 2: repo is in a subfolder (e.g., repositories/) and public_html is at user root
            $path2 = realpath(base_path() . '/../../public_html');
            
            if ($path2 && is_dir($path2)) return $path2;
            if ($path1 && is_dir($path1)) return $path1;
            
            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
