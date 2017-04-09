<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', function() {
    return redirect()->route('index');
});

Auth::routes();

Route::get('/user/area/{area}', 'User\AreaController@store')
    ->name('user.area.store');

Route::group(['prefix' => '/{area}'], function() {
    /**
     * Category.
     */
    Route::group(['prefix' => '/categories'], function() {
        Route::get('/', 'Category\CategoryController@index')
            ->name('category.index');

        Route::group(['prefix' => '/{category}'], function() {
            Route::get('/listings', 'Listing\ListingController@index')
                ->name('category.listings.index');
        });
    });

    /**
     * Listing.
     */
    Route::group(['prefix' => '/listings', 'namespace' => 'Listing'], function() {
        Route::get('/favourites', 'ListingFavouriteController@index')
            ->name('listings.favourites.index');
        Route::post('/{listing}/favourites', 'ListingFavouriteController@store')
            ->name('listing.favourites.store');
        Route::delete('/{listing}/favourites', 'ListingFavouriteController@destroy')
            ->name('listing.favourites.destroy');
        Route::get('/viewed', 'ListingViewedController@index')
            ->name('listings.viewed.index');
        Route::post('{listing}/contact', 'ListingContactController@store')
            ->name('listings.contact.store');

        Route::group(['middleware' => 'auth'], function() {
            Route::get('/create', 'ListingController@create')
                ->name('listings.create');
            Route::post('/create', 'ListingController@store')
                ->name('listings.store');
            Route::get('/{listing}/edit', 'ListingController@edit')
                ->name('listings.edit');
            Route::patch('/{listing}/edit', 'ListingController@update')
                ->name('listings.update');
        });
    });

    Route::get('/{listing}', 'Listing\ListingController@show')
        ->name('listings.show');
});
