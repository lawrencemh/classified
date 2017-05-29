<?php

namespace App\Http\Controllers\Listing;

use App\Area;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    
    public function show(Area $area, Listing $listing)
    {
        $this->authorize('touch', $listing);
        
        // check if listing live
        if ($listing->live()) {
            return back();
        }
        
        return view('listings.payment.show')
            ->with('listing', $listing);
        
    }
    
    public function store(Request $request, Area $area, Listing $listing)
    {
        // authorize
        $this->authorize('touch', $listing);
        
        // check if listing live
    }
}
