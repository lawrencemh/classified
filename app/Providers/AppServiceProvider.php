<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Area;
use App\Category;

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

        // On Category create
        Category::creating(function ($category) {
            // Init prefix
            $prefix = '';

            // Init parent.
            $parent = $category->parent;

            // Iterate through all parents until root node
            while ($parent) {
                // Prepend to prefix
                $prefix = $parent->name . ' ' . $prefix;

                // Move to next parent
                $parent = $parent->parent;
            }

            // generate slug prefix + area name
            $category->slug = str_slug($prefix . $category->name);
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
