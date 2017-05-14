<?php

namespace App\Http\Controllers\Listing;

use App\Http\Requests\StoreListingFormRequest;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Area;
use App\Jobs\UserViewedListing;

class ListingController extends Controller
{
    /**
     * Return the listings for the area's category.
     *
     * @param \App\Area $area
     * @param \App\Category $category
     * @return \Illuminate\View\View
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Area $area
     * @param \App\Listing $listing
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Area $area, Listing $listing)
    {
        // check listing is live
        if ($listing->live() == false) {
            return abort(404);
        }

        // dispatch userViewedListing job
        if ($request->user()) {
            dispatch(new UserViewedListing($request->user(), $listing));
        }

        // return view
        return view('listings.show')
            ->with('listing', $listing);
    }

    /**
     * Show the form to create a new listing.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('listings.create');
    }


    /**
     * Store the submitted listing.
     *
     * @param \App\Http\Requests\StoreListingFormRequest $request
     * @param \App\Area $area
     * @return \Illuminate\Routing\Redirector
     */
    public function store(StoreListingFormRequest $request, Area $area)
    {
        $listing = new Listing;
        $listing->title = $request->get('title');
        $listing->body = $request->get('body');
        $listing->category_id = $request->get('category_id');
        $listing->area_id = $request->get('area_id');
        $listing->user()->associate($request->user());

        $listing->save();

        return redirect()->route('listings.edit', [$area, $listing]);
    }

    /**
     * Edit an existing listing.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Area $area
     * @param \App\Listing $listing
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, Area $area, Listing $listing)
    {
        $this->authorize('edit', [$listing]);

        return view('listings.edit')->with('listing', $listing);
    }

    /**
     * @param \App\Http\Requests\StoreListingFormRequest $request
     * @param \App\Area $area
     * @param \App\Listing $listing
     * @return \Illuminate\Routing\Redirector
     */
    public function update(StoreListingFormRequest $request, Area $area, Listing $listing)
    {
        $this->authorize('update', [$listing]);

        $listing->title = $request->get('title');
        $listing->body = $request->get('body');

        if (!$listing->live()) {
            $listing->category_id = $request->get('category_id');
        }

        $listing->area_id = $request->get('area_id');

        $listing->save();

        // @todo check if payment button was clicked

        return back()->withSuccess('Listing successfully updated.');
    }
}
