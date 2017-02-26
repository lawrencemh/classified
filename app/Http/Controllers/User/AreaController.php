<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Area;

class AreaController extends Controller
{
    /**
     * Store the passed area to session.
     *
     * @param App\Area $area
     * @return
     */
    public function store(Area $area)
    {
        // put the area slug into the user's session
        session()->put('area', $area->slug);

        // redirect to the category index
        return redirect()->route('category.index', [$area]);
    }
}
