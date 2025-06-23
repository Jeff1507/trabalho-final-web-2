<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Facades\Permissions;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('permissions', function()  {
            return new Permissions();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
