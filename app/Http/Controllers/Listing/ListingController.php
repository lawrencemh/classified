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
            ->withArea()
            ->withUser()
            ->fromCategory($category)
            ->latestFirst()
            ->paginate(10);

        return view('listings.index')
            ->with('listings', $listings)
            ->with('category', $category);
    }

    /**
     * Show listing in area.
     *
     * @param Request $request
     * @param Area $area
     * @param Listing $listing
     * @return $this|void
     */
    public function show(Request $request, Area $area, Listing $listing)
    {
        // check listing is live
        if ($listing->live() == false) {
            return abort(404);
        }

        // return view
        return view('listings.show')
            ->with('listing', $listing);
    }
}
