<?php

namespace App\Http\Controllers\Listing;

use App\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Area;

class ListingController extends Controller
{
    /**
     * Return the listings for the area's category.
     *
     * @param Area $area
     * @param Category $category
     * @return
     */
    public function index(Area $area, Category $category)
    {
        // get listings for area
        $listings = Listing::with(['user', 'area'])
            ->isLive()
            ->inArea($area)
            ->fromCategory($category)
            ->latestFirst()
            ->paginate(10);

        return view('listings.index')
            ->with('listings', $listings)
            ->with('category', $category);
    }
}
