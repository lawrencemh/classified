<?php

namespace App\Http\Controllers\Listing;

use App\Area;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingFavouriteController extends Controller
{
    /**
     * ListingFavouriteController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all the user's favourited listings.
     *
     * @param \Illuminate\Http\Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        // get all the user's favourite listings
        $listings = $request
            ->user()
            ->favouriteListings()
            ->withUser()
            ->withArea()
            ->orderByPivot('created_at', 'desc')
            ->paginate(10);

        // return view
        return view('user.listings.favourites.index')
            ->with('listings', $listings);
    }

    /**
     * Store a listing into the user's favourite list.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Area $area
     * @param \App\Listing $listing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Area $area, Listing $listing)
    {
        $request->user()
            ->favouriteListings()
            ->syncWithoutDetaching([$listing->id]);

        return back();
    }

    /**
     * Destroy a user's listing from favourites.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Area $area
     * @param \App\Listing $listing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Area $area, Listing $listing)
    {
        // detach association
        $request
            ->user()
            ->favouriteListings()
            ->detach($listing);

        // redirect
        return back();
    }
}
