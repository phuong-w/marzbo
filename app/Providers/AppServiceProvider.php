<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Vite::macro('image', fn (string $asset) => $this->asset("resources/images/{$asset}"));

        if (app()->environment('remote')) {
            URL::forceScheme('https');
        }
    }
}
