<?php

namespace App\Providers;

use App\Models\SocialMediaCredential;
use App\Observers\SocialMediaCredentialObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        SocialMediaCredential::observe(SocialMediaCredentialObserver::class);
    }
}
