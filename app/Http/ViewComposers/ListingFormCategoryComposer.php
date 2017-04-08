<?php

namespace app\Http\ViewComposers;

use Illuminate\View\View;
use App\Category;

class ListingFormCategoryComposer
{
    /**
     * Get All the categories to share with the Listing Form categories Partial.
     *
     * @param View $view
     * @return \Illuminate\View\View
     */
    public function compose(View $view)
    {
        // Get all areas
        $categories = Category::get()->toTree();

        // return view with areas
        return $view->with('categories', $categories);
    }
}