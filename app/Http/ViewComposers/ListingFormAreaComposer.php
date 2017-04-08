<?php

namespace app\Http\ViewComposers;

use Illuminate\View\View;
use App\Area;

class ListingFormAreaComposer
{
    /**
     * Get All the areas to share with the Listing Form Area Partial.
     *
     * @param View $view
     * @return \Illuminate\View\View
     */
    public function compose(View $view)
    {
        // Get all areas
        $areas = Area::get()->toTree();

        // return view with areas
        return $view->with('areas', $areas);
    }
}