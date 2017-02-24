<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Area;
use Symfony\Component\Console\Output\ConsoleOutput;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // On area create
        Area::creating(function ($area) {
            // Init prefix
            $prefix = '';

            // Init parent.
            $parent = $area->parent;

            // Iterate through all parents until root node
            while ($parent) {
                // Prepend to prefix
                $prefix = $parent->name . ' ' . $prefix;

                // Move to next parent
                $parent = $parent->parent;
            }

            // generate slug prefix + area name
            $area->slug = str_slug($prefix . $area->name);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
