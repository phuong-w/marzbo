<?php

namespace App\Providers;

use App\Http\ViewComposers\SidebarComposer;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
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
        view()->composer('admin.layouts.partials.sidebar', SidebarComposer::class);
    }
}
