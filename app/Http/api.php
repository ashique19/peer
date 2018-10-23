<?php
/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
*/
use Illuminate\Http\Request;

Route::group([ 'prefix'=>'api/v1'], function()
{
    // Auth
    Route::post('signup', 'AccessController@postAjaxSignup');
    Route::post('login', 'LoginController@login')->name('api-login');

    // Product search
    Route::get('products/search', 'EbayController@search')->name('api-products');
    Route::get('/user', ['middleware' => 'api'], function (Request $request) { return \App\User::where('api_token', $request->request->get('token'))->get(); });


    Route::group(['middleware'=> ['api']], function()
    {
        // Cart
        Route::get('cart', 'CartController@get')->name('api-cart');
        Route::post('cart', 'CartController@add')->name('api-add-to-cart');
        Route::delete('cart/{id}', 'CartController@delete')->name('api-delete-cart');
        // Add product as a buyer
        Route::post('buyer/store', 'Buyers@storeNew')->name('api-buyer-store');

        // Traveller route
        Route::post('travel', 'Travels@storeNew')->name('api-travel-store');
        Route::delete('travel/{id}', 'Travels@destroy')->name('api-travel-delete');

        // traveller cart
        Route::get('traveller-cart', 'TravellerCartController@get')->name('api-traveler-cart');
        Route::post('traveller-cart', 'TravellerCartController@add')->name('api-traveller-add-to-cart');
        Route::delete('traveller-cart/{id}', 'TravellerCartController@delete')->name('api-traveller-delete-cart');

        //Buyer search
        Route::get('travel/{id}/buyer', 'Buyers@searchByTravel')->name('api-buyer-search-by-travel');

        //Airport
        Route::get('airport-search/{param}',       'StaticPageController@airportSearch');
    });
});
