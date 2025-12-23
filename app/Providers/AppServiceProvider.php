<?php

namespace App\Providers;

use App\Services\VersionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register VersionService as singleton
        $this->app->singleton(VersionService::class, function ($app) {
            return new VersionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bind version to config for easy access
        $this->app->booted(function () {
            $versionService = $this->app->make(VersionService::class);
            config(['app.version' => $versionService->getVersion()]);
            config(['app.version_info' => $versionService->getVersionInfo()]);
        });
    }
}
