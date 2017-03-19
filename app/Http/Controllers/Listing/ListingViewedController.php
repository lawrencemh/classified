<?php

namespace App\Http\Controllers\Listing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingViewedController extends Controller
{
	/**
	 * Define the maximum results to show to the user.
	 *
	 * @const int
	 */
	CONST INDEX_LIMIT = 10;

	public function __construct()
	{
		$this->middleware(['auth']);
	}

    public function index(Request $request)
    {
    	$listings = $request->user()
    		->viewedListings()
    		->withArea()
    		->withUser()
    		->orderByPivot('updated_at', 'desc')
    		->isLive()
    		->take(self::INDEX_LIMIT)
    		->get();

    	return view('user.listings.viewed.index')
    		->with('listings', $listings)
    		->with('indexLimit', self::INDEX_LIMIT);
    }
}
