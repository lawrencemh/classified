<?php

namespace App\Http\Controllers\Listing;

use App\Area;
use App\Http\Requests\StoreListingContactFormRequest;
use App\Listing;
use App\Http\Controllers\Controller;
use App\Mail\ListingContactCreated;
use Mail;

class ListingContactController extends Controller
{
    /**
     * ListingContactController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Process the message to be sent to the listing owner.
     *
     * @param \App\Http\Requests\StoreListingContactFormRequest $request
     * @param \App\Area $area
     * @param \App\Listing $listing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreListingContactFormRequest $request, Area $area, Listing $listing)
    {
        // queue email to be sent to listing owner
        Mail::to($listing->user)->queue(
            new ListingContactCreated($listing, $request->user(), $request->get('message'))
        );

        // redirect back
        return redirect()->back()->with('success', "Successfully sent message to {$listing->user->name}.");
    }
}
