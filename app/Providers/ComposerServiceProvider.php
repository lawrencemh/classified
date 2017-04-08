<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\AreaComposer;
use App\Http\ViewComposers\ListingFormAreaComposer;
use App\Http\ViewComposers\ListingFormCategoryComposer;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // share area with all views
        View::composer('*', AreaComposer::class);

        // share all areas with listing creation areas partial
        View::composer('listings.partials.forms._areas', ListingFormAreaComposer::class);

        // share all areas with listing creation categories partial
        View::composer('listings.partials.forms._categories', ListingFormCategoryComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // register as singleton to prevent areaComposer being re-run for every single view
        $this->app->singleton(AreaComposer::class);
    }
}
