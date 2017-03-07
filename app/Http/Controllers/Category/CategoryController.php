<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Area;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Show a list of categories.
     *
     * @return Illuminate\Http\Request
     */
    public function index(Area $area)
    {
        // get list of categories
        // @todo eager load in listings
        $categories = Category::withListingsInArea($area)->get()->toTree();

        return view('categories.index')
            ->with('categories', $categories);
    }
}
