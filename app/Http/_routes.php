
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/






/**
|
|------------------------------------------------------------------------------------
|   Public routes start here
|------------------------------------------------------------------------------------
|
*/


/**
|
|------------------------------------------------------------------------------------
|   Static general purpose public routes
|------------------------------------------------------------------------------------
|
*/


/**
 * 
 * General purpose public pages
 * 
 */
// Route::get('/', ['as'=>'home', 'uses'=>'StaticPageController@home']);
Route::get('/', ['as'=>'home', 'uses'=>'UserAccounts@dashboard']);
Route::get('login', ['as'=>'login','uses'=> 'ProductController@index']);
//Route::get('login', ['as'=>'login','uses'=> 'AccessController@login']);
Route::get('contact-us',                'StaticPageController@contact');
Route::post('contact-us',               'StaticPageController@postContact');
Route::get('how-it-works',              'StaticPageController@howItWorks');
Route::get('how-it-works-for-travelers','StaticPageController@howItWorksTravelers');
Route::get('how-it-works-for-buyers',   'StaticPageController@howItWorksBuyers');
Route::get('how-it-works-airexpress',   'StaticPageController@howItWorksAirexpress');
Route::get('about-us',                  'StaticPageController@aboutUs');
Route::get('faq',                       'StaticPageController@faq');
Route::get('page/{name}',               'StaticPageController@page');
Route::get('privacy-policy',            'StaticPageController@privacyPolicy');
Route::get('terms',                     'StaticPageController@terms');
Route::post('subscribers/subscribe',    'Subscribers@subscribe');
Route::get('subscribers/unsubscribe',   'Subscribers@unsubscribe');
Route::post('subscribers/unsubscribe',  'Subscribers@unsubscribe');
Route::get('airport-search/{param}',       'StaticPageController@airportSearch');




/*
|
|-----------------------------------------------------------------------------------
|User Login, Logout
|-----------------------------------------------------------------------------------    
|
|   3 sets of Routes:
|           - GET   - login landing page
|           - POST  - login form post route
|           - GET   - logout through get
|
|           - GET   - forgot password landing page
|           - POST  - forgot password form post route
|
|           - GET   - Signup landing page
|           - POST  - Signup form post route
|
*/



Route::group(['prefix'=>'auth'], function(){
    
    Route::get('social/{social}',               'AccessController@social');
    Route::get('login',                         'ProductController@index');
    Route::post('login',                        'AccessController@postLogin');
    Route::post('ajax-login',                   'AccessController@postAjaxLogin');
    Route::get('logout',                        'AccessController@logout')->name('logout');
    Route::post('deactivate',                   'AccessController@deactivateMyAccount');
    
    Route::get('forgot-password',               'AccessController@forgotPassword');
    Route::post('forgot-password',              'AccessController@postForgotPassword');
    
    Route::get('signup', ['as'=>'signup', 'uses'=>  'AccessController@signup']);
    Route::post('signup',                           'AccessController@postSignup');
    Route::post('ajax-signup',                      'AccessController@postAjaxSignup');
    
});



Route::group(['prefix'=>'blog'], function()
{

    /** Blog Public Routes **/
    Route::get('/',                 ['as'=> 'blogs',            'uses'=> 'BlogPublic@blogs']);
    Route::get('{name}',            ['as'=> 'singleBlog',       'uses'=> 'BlogPublic@singleBlog']);
    Route::post('{id}/comment',     ['as'=> 'storeBlogComment', 'uses'=> 'BlogPublic@storeComment']);
    Route::get('category/{link}',   ['as'=> 'blogCategory',     'uses'=> 'BlogPublic@blogCategory']);
    Route::get('tag/{link}',        ['as'=> 'blogTag',          'uses'=> 'BlogPublic@blogTag']);

});





/**
|
|------------------------------------------------------------------------------------
|   Admin area
|------------------------------------------------------------------------------------
|
*/



Route::group(['middleware' => ['auth','permission'], 'prefix' => 'admin'], function() use ($router)
{
    
    /*
    |
    |-----------------------------------------------------------------------------------
    |Admin Dashboard
    |-----------------------------------------------------------------------------------    
    |
    |   COMMON DASHBOARD for all types of admin
    |   
    |
    */
    
    Route::get('dashboard', ['as'=>'dashboard','uses'=>'Dashboard@index']);


    
    /*
    |
    |-----------------------------------------------------------------------------------
    |User Roles
    |-----------------------------------------------------------------------------------    |
    |
    |   CRUD is done through resource route
    |
    |   Individual ROLE permission is managed through GET and POST request
    |   
    |
    */
    Route::get('roles/{id}/navs', 'Roles@navs');
    Route::post('roles/navs', 'Roles@postNavs');
    Route::get('roles/{id}/permissions', 'Roles@permissions');
    Route::post('roles/permissions', 'Roles@postPermissions');
    Route::resource('roles', 'Roles');







    /*
    |
    |-----------------------------------------------------------------------------------
    |Application Navs
    |-----------------------------------------------------------------------------------
    |
    |   CRUD is done through resource route
    |   
    |   Create, Read, Update only
    |
    */
    Route::resource('navs','Navs', ['except' => ['show', 'destroy', 'edit'] ] );



    /*
    |
    |-----------------------------------------------------------------------------------
    |Application Permission at each Action
    |-----------------------------------------------------------------------------------
    |
    |   CRUD is done through resource route
    |   
    |   Create, Read, Update only
    |
    */
    Route::post('permissions/search',       'Permissions@searchIndex');
    // Route::get('permissions/search',        function(){ return redirect()->action('Permissions@index'); });
    // Route::get('permissions/auto-update',   function(){ return redirect()->action('Permissions@index'); });
    Route::post('permissions/auto-update',  'Permissions@autoUpdate');
    Route::resource('permissions', 'Permissions');






    /*
    |
    |-----------------------------------------------------------------------------------
    | Social media >> Default->Internal
    |-----------------------------------------------------------------------------------
    |
    |   CRUD is done through resource route
    |   
    */
    Route::post('socials/search', 'Socials@searchIndex');
    // Route::get('socials/search', function(){ return redirect()->action('Socials@index'); });
    Route::resource('socials', 'Socials');
    



    /*
    |
    |-----------------------------------------------------------------------------------
    |Application Users
    |-----------------------------------------------------------------------------------
    |
    |   CRUD is done through resource route
    |   
    */
    Route::get('users/buyers-travelers/create', 'Users@createBuyersTravelers');
    Route::get('users/buyers-travelers', 'Users@buyersTravelers');
    Route::get('users/admins/create', 'Users@createAdmins');
    Route::get('users/admins', 'Users@viewAdmins');
    // Route::get('users/search', function(){return redirect()->action('Users@index');});
    Route::get('user-search/{param}', 'Users@ajaxSearch');
    Route::post('users/search', 'Users@postSearch');
    Route::get('users/export', 'Users@getExport');
    Route::post('users/export', 'Users@postExport');
    Route::resource('users','Users');
    
    

    /*
    |
    |-----------------------------------------------------------------------------------
    |Change Password
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::get('change-password', 'AccessController@changePassword');
    Route::post('change-password', 'AccessController@postChangePassword');
    
    
    /*
    |
    |-----------------------------------------------------------------------------------
    | Application settings
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::resource('settings', 'Settings', ['only'=> ['show', 'edit', 'update']]);
    
    
    /*
    |
    |-----------------------------------------------------------------------------------
    | Backup
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::get('backup/make/database',  'Backup@database');
    Route::get('backup/status', 'Backup@getStatus');    

    
    /*
    |
    |-----------------------------------------------------------------------------------
    | Static pages
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::post('pages/search', 'Pages@searchIndex');
    // Route::get('pages/search', function(){ return redirect()->action('Pages@index'); });
    Route::resource('pages', 'Pages');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Currencies
    *-------------------------------------------------------------------------------------------
    */
    Route::post('currencies/search', 'Currencies@searchIndex');
    // Route::get('currencies/search', function(){ return redirect()->action('Currencies@index'); });
    Route::resource('currencies', 'Currencies');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Gateways
    *-------------------------------------------------------------------------------------------
    */
    Route::post('gateways/search', 'Gateways@searchIndex');
    // Route::get('gateways/search', function(){ return redirect()->action('Gateways@index'); });
    Route::resource('gateways', 'Gateways');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Shippings
    *-------------------------------------------------------------------------------------------
    */
    Route::post('shippings/search', 'Shippings@searchIndex');
    // Route::get('shippings/search', function(){ return redirect()->action('Shippings@index'); });
    Route::resource('shippings', 'Shippings');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Travels
    *-------------------------------------------------------------------------------------------
    */
    Route::post('travels/search', 'Travels@searchIndex');
    // Route::get('travels/search', function(){ return redirect()->action('Travels@index'); });
    Route::resource('travels', 'Travels');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Buyers
    *-------------------------------------------------------------------------------------------
    */
    Route::post('buyers/search', 'Buyers@searchIndex');
    // Route::get('buyers/search', function(){ return redirect()->action('Buyers@index'); });
    Route::resource('buyers', 'Buyers');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Messages
    *-------------------------------------------------------------------------------------------
    */
    Route::post('messages/search', 'Messages@searchIndex');
    // Route::get('messages/search', function(){ return redirect()->action('Messages@index'); });
    Route::resource('messages', 'Messages');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > COUNTRIES
    *-------------------------------------------------------------------------------------------
    */
    Route::resource('countries', 'Countries');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > CITIES
    *-------------------------------------------------------------------------------------------
    */
    Route::post('cities/search', 'Cities@searchIndex');
    // Route::get('cities/search', function(){ return redirect()->action('Cities@index'); });
    Route::resource('cities', 'Cities');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Airports
    *-------------------------------------------------------------------------------------------
    */
    Route::resource('airports', 'Airports');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Categories
    *-------------------------------------------------------------------------------------------
    */
    Route::post('categories/search', 'Categories@searchIndex');
    // Route::get('categories/search', function(){ return redirect()->action('Categories@index'); });
    Route::resource('categories', 'Categories');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Offers
    *-------------------------------------------------------------------------------------------
    */
    Route::post('offers/search', 'Offers@searchIndex');
    // Route::get('offers/search', function(){ return redirect()->action('Offers@index'); });
    Route::resource('offers', 'Offers');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Payments
    *-------------------------------------------------------------------------------------------
    */
    Route::post('payments/search', 'Payments@searchIndex');
    // Route::get('payments/search', function(){ return redirect()->action('Payments@index'); });
    Route::resource('payments', 'Payments');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   NewsLetter & Subscribers
    *-------------------------------------------------------------------------------------------
    */
    
    Route::post('newsletters/search', 'Newsletters@searchIndex');
    // Route::get('newsletters/search', function(){ return redirect()->action('Newsletters@index'); });
    Route::resource('newsletters', 'Newsletters');
    
    Route::post('subscribers/search', 'Subscribers@searchIndex');
    // Route::get('subscribers/search', function(){ return redirect()->action('Subscribers@index'); });
    Route::resource('subscribers', 'Subscribers');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Favorite Items
    *-------------------------------------------------------------------------------------------
    */
    Route::resource('favorite_products', 'Favorite_products');
    Route::resource('favorite_buyers', 'Favorite_buyers');
    Route::resource('favorite_travellers', 'Favorite_travellers');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Sliders
    *-------------------------------------------------------------------------------------------
    */
    Route::resource('sliders', 'Sliders');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Slides
    *-------------------------------------------------------------------------------------------
    */
    Route::resource('slides', 'Slides');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Chat
    *-------------------------------------------------------------------------------------------
    */
    Route::post('chats/search', 'Chats@searchIndex');
    // Route::get('chats/search', function(){ return redirect()->action('Chats@index'); });
    Route::resource('chats', 'Chats');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Labels
    *-------------------------------------------------------------------------------------------
    */
    Route::post('order-label/{id}', 'Labels@updateOrderLabel');
    Route::post('labels/search', 'Labels@searchIndex');
    // Route::get('labels/search', function(){ return redirect()->action('Labels@index'); });
    Route::resource('labels', 'Labels');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Label > Products
    *-------------------------------------------------------------------------------------------
    */
    Route::post('label_products/search', 'Label_products@searchIndex');
    // Route::get('label_products/search', function(){ return redirect()->action('Label_products@index'); });
    Route::resource('label_products', 'Label_products');
    
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Orders
    *-------------------------------------------------------------------------------------------
    */
    Route::post('order-status/update', 'Orders@updateStatus');
    Route::post('orders/search', 'Orders@searchIndex');
    // Route::get('orders/search', function(){ return redirect()->action('Orders@index'); });
    Route::get('orders/{id}/order_products','Orders@order_products');   
    Route::get('orders/{id}/order_products/create','Orders@order_productsCreate');  
    Route::post('orders/{id}/order_products/create','Orders@order_productsStore');
    Route::get('orders/{id}/order_logs','Orders@order_logs');   
    Route::get('orders/{id}/order_logs/create','Orders@order_logsCreate');  
    Route::post('orders/{id}/order_logs/create','Orders@order_logsStore');
    Route::resource('orders', 'Orders');
    
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Order Products
    *-------------------------------------------------------------------------------------------
    */
    Route::post('order_products/search', 'Order_products@searchIndex');
    // Route::get('order_products/search', function(){ return redirect()->action('Order_products@index'); });
    Route::resource('order_products', 'Order_products');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Order Products
    *-------------------------------------------------------------------------------------------
    */
    Route::post('order_logs/search', 'Order_logs@searchIndex');
    // Route::get('order_logs/search', function(){ return redirect()->action('Order_logs@index'); });
    Route::resource('order_logs', 'Order_logs');
    
    
    Route::post('get-shipping-rate', 'Shippings@returnAllPitneybowesRates');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Notifications
    *-------------------------------------------------------------------------------------------
    */
    Route::get('notifications/sent', 'Notifications@sent');
    Route::get('notifications/received', 'Notifications@received');
    Route::get('notifications/undelivered', 'Notifications@undelivered');
    Route::get('notifications/user/{user_id}', 'Notifications@byUser');
    Route::post('notifications/search', 'Notifications@search');
    Route::resource('notifications', 'Notifications');
    
});





    Route::get('products/search/test', 'Amazons@productSearch1');

/**
|
|------------------------------------------------------------------------------------
|   Users area
|------------------------------------------------------------------------------------
|
*/
Route::get('products', 'ProductController@index')->name('product-lists');
Route::get('products/search/ebay', 'EbayController@search');
//Route::post('login/new', 'AccessController@postAjaxLogin')->name('login-new');
Route::post('login/new', 'LoginController@login')->name('login-new');
Route::get('dashboard', 'UserAccounts@dashboard')->name('home');
Route::group(['middleware'=> ['auth'],'prefix'=>'user'], function()
{
    
    /*
    |
    |-----------------------------------------------------------------------------------
    |My Profile
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::get('my-profile', 'MyProfile@show');
    Route::post('my-profile', 'MyProfile@update');
    Route::get('my-profile/edit', 'MyProfile@edit');
    
    
    Route::get('account/modify', 'UserAccounts@modify');
    Route::get('account/modify-password', 'UserAccounts@modifyPassword');
    Route::get('account/modify-payout-preference', 'UserAccounts@modifyPayoutPreference');
    Route::get('account/delete-account', 'UserAccounts@deleteAccount');
    Route::get('account/profile', 'UserAccounts@profile');
    Route::post('account/profile/update-profile-photo', 'UserAccounts@replaceProfileImage');
    
    // Route::get('profile/{id}', 'UserProfiles@show');
    



    /*
    |
    |-----------------------------------------------------------------------------------
    |Change password
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::get('my-profile/change-password', 'MyProfile@changePassword');
    Route::post('my-profile/change-password', 'MyProfile@updatePassword');
    
    /*
    |
    |-----------------------------------------------------------------------------------
    |User Dashboard
    |-----------------------------------------------------------------------------------    
    |
    |   DASHBOARD for User and Traveller
    |   
    |
    */
    
    Route::get('dashboard', ['as'=>'userDashboard','uses'=>'Dashboard@index']);
    
    
    /*
    |
    |-----------------------------------------------------------------------------------
    | Order for Label
    |-----------------------------------------------------------------------------------    
    |
    |   Ship with DHL, FedEx, UPS and More for upto 50% less
    |   
    |
    */
    
    Route::get('shipping-label', 'Shippings@getLabel' );
    Route::post('shipping-label', 'Shippings@postLabel' );
    Route::post('shipping-label-draft', 'Shippings@draftLabel' );
    Route::post('shipping-label-buy', 'Shippings@buyLabel' );
    Route::get('label/from-session/edit-by-user', 'Labels@sessionEditByUser');
    Route::get('label/{id}/edit-by-user', 'Labels@editByUser');
    Route::get('label/{id}/delete-by-user', 'Labels@deleteByUser');
    Route::get('labels', 'Labels@showLabelToUser');
    
    
    
    /*
    |
    |-----------------------------------------------------------------------------------
    |SET USER TYPE - BUYER or TRAVELLER
    |-----------------------------------------------------------------------------------    
    |
    |   Store user_type at session
    |   
    |
    */
    
    Route::get('set-user-type-to-buyer',        'Dashboard@setUserTypeToBuyer');
    Route::get('set-user-type-to-traveller',    'Dashboard@setUserTypeToTraveller');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Favorite Items
    *-------------------------------------------------------------------------------------------
    */
    Route::resource('favorite_products', 'Favorite_products');
    Route::resource('favorite_buyers', 'Favorite_buyers');
    Route::resource('favorite_travellers', 'Favorite_travellers');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Wishlist
    *-------------------------------------------------------------------------------------------
    */
    Route::get('my-wishlist', 'Wishlist@myWishlist');
    
    Route::get('wishlist/products', 'Wishlist@getProducts');
    Route::get('wishlist/products/{id}/remove', 'Wishlist@deleteProducts');
    Route::get('wishlist/products/store', 'Wishlist@storeProducts');
    
    Route::get('wishlist/buyers', 'Wishlist@getBuyers');
    Route::get('wishlist/buyers/{id}/remove', 'Wishlist@deleteBuyers');
    Route::get('wishlist/buyers/store', 'Wishlist@storeBuyers');
    
    Route::get('wishlist/travellers', 'Wishlist@getTravellers');
    Route::get('wishlist/travellers/{id}/remove', 'Wishlist@deleteTravellers');
    Route::get('wishlist/travellers/store', 'Wishlist@storeTravellers');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Travels
    *-------------------------------------------------------------------------------------------
    */
    Route::get('my-travel-info', 'Travels@myTravels');
    Route::get('my-active-travels', 'Travels@myActiveTravels');
    Route::post('my-travel-info','Travels@storeMyTravel');
    Route::post('my-travel/{id}/deactivate','Travels@deactivateTravel');
    Route::post('my-travel/{id}/activate','Travels@activateTravel');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Buyers
    *-------------------------------------------------------------------------------------------
    */
    Route::get('add-to-my-buy',             'Buyers@addToMyBuy');
    Route::get('my-old-buy-posts',          'Buyers@oldBuyPosts');
    Route::get('my-buy-info',               'Buyers@myBuys');
    Route::post('my-buy-info',              'Buyers@storeMyBuys');
    Route::post('my-buy-info/{id}/remove',  'Buyers@removeMyPost');
    Route::post('buyer/store',              'Buyers@storeNew')->name('buyer-store');

    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Travels > Search
    *-------------------------------------------------------------------------------------------
    */
    Route::get('traveller/{id}/details', 'Travels@travellerDetails' );
    Route::get('travels/search','Travels@travellerSearchByBuyer');
    Route::post('travels/search','Travels@postTravellerSearchByBuyer');
    Route::post('travels/country/{id}','Travels@postTravellerSearchByCountryByBuyer');
    Route::get('travels/country/{id}','Travels@travellerSearchByCountryByBuyer');
    Route::resource('travels', 'Travels');
    
    
    Route::post('traveller/{id}/review', 'Travels@travellerReview' )->name('traveller-review-add');
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Message box
    *-------------------------------------------------------------------------------------------
    */
    Route::get('my-messages', 'Messages@myMessages');
    Route::get('my-messages/{id}', 'Messages@myMessageItem');
    Route::post('my-messages/{id}', 'Messages@replyMessageItem');
    Route::post('message-to-traveller', 'Messages@messageToTraveller');
    Route::post('message-to-buyer', 'Messages@messageToBuyer');
    Route::resource('messages', 'Messages');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Products
    *-------------------------------------------------------------------------------------------
    */
    Route::get('products/search', 'Amazons@productSearch');
    Route::post('products/search', 'Amazons@postProductSearch');
    Route::get('products/search/new', 'Amazons@productSearchNew');
    Route::get('products/proxy', 'Amazons@proxy');
    Route::get('products', 'ProductController@index')->name('product-lists');
    Route::get('product/details', 'ProductController@details')->name('product-details');
    Route::get('travel/add', 'Travels@add')->name('travel-add');
    Route::get('buyer/search/new', 'Buyers@search')->name('buyer-search');
    Route::get('payment/new', 'Payments@add1')->name('payment-new');
    Route::get('payment/confirmation', 'Payments@confirmation')->name('payment-confirmation');
    Route::get('travel/{id}/buyer', 'Buyers@searchByTravel')->name('buyer-search-by-travel');
    Route::get('profile', 'UserProfiles@profile')->name('user-settings');
    Route::get('my-travels', 'UserProfiles@travels')->name('my-travels');
    Route::get('my-upcoming-travels', 'UserProfiles@upcomingTravels')->name('my-upcoming-travels');
    Route::get('payout', 'UserProfiles@payout')->name('payout');
    Route::get('withdraw', 'UserProfiles@withdraw')->name('withdraw-payment');
    Route::post('withdraw', 'UserProfiles@postWithdraw')->name('post-withdraw-money');

    // Cart
    Route::get('checkout', 'CartController@checkout')->name('checkout');
    Route::get('cart', 'CartController@get')->name('cart');
    Route::post('cart', 'CartController@add')->name('add-to-cart');
    Route::delete('cart/{id}', 'CartController@delete')->name('delete-cart');
    Route::get('checkout-address', 'CartController@checkoutAddress')->name('checkout-address');
    // traveller cart
    Route::get('traveller-checkout', 'TravellerCartController@checkout')->name('traveller-checkout');
    Route::get('traveller-cart', 'TravellerCartController@get')->name('traveler-cart');
    Route::post('traveller-cart', 'TravellerCartController@add')->name('traveller-add-to-cart');
    Route::delete('traveller-cart/{id}', 'TravellerCartController@delete')->name('traveller-delete-cart');
    Route::get('traveller-checkout-address', 'TravellerCartController@checkoutAddress')->name('traveller-checkout-address');


    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Search for Buyer
    *-------------------------------------------------------------------------------------------
    */
    Route::get('buyer/{id}/details', 'Buyers@details');
    Route::get('buyer/search', 'Buyers@buyerSearchByTraveller');
    Route::post('buyer/search', 'Buyers@postBuyerSearchByTraveller');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Offer
    *-------------------------------------------------------------------------------------------
    */
    // Route::get('reject/', function(){ return redirect()->action('Travels@travellerSearchByBuyer'); } );
    Route::post('reject/', 'Offers@rejectOffer');
    // Route::get('offer-from-traveller-search', function(){ return redirect()->action('Travels@travellerSearchByBuyer'); } );
    Route::post('offer-from-traveller-search', 'Offers@postOfferFromBuyer');
    // Route::get('offer-from-product-search', function(){ return redirect()->action('Amazons@productSearch'); } );
    Route::post('offer-from-product-search', 'Offers@postOfferFromProductSearch');
    // Route::get('offer-from-buyer-search', function(){ return redirect()->action('Buyers@buyerSearchByTraveller'); } );
    Route::post('offer-from-buyer-search', 'Offers@postOfferFromBuyerSearch');
    
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Offer From Buyer
    *-------------------------------------------------------------------------------------------
    */
    Route::get('offer-from-buyer', 'Offers@offerFromBuyer');
    Route::get('offer-from-buyer/rejected', 'Offers@offerFromBuyerRejected');
    Route::get('offer-from-buyer/accepted', 'Offers@offerFromBuyerAccepted');
    Route::post('offer-made-by-traveller', 'Offers@offerUpdateByTraveller');
    Route::get('offer-accepted-by-traveller/{id}', 'Offers@offerAcceptedByTraveller');
    
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Offer To Traveller
    *-------------------------------------------------------------------------------------------
    */
    Route::get('offer-to-traveller', 'Offers@offerFromTraveller');
    Route::get('offer-to-traveller/rejected', 'Offers@offerFromTravellerRejected');
    Route::get('offer-to-traveller/accepted', 'Offers@offerFromTravellerAccepted');
    Route::post('offer-made-by-buyer', 'Offers@offerUpdateByBuyer');
    Route::get('offer-accepted-by-buyer/{id}', 'Offers@offerAcceptedByBuyer');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *  Offers and Inbox
    *-------------------------------------------------------------------------------------------
    */
    
    Route::get('chat-with/{id}/is-read', 'UserChats@markRead');
    Route::get('chats', 'UserChats@indexAndOffers');
    
    Route::get('chats/inbox/update/{traveler}/{time}', 'UserChats@getChatUpdates');
    Route::get('chats/offer/update/{traveler}/{time}', 'UserChats@getOfferUpdates');
    
    Route::post('chats/store/{id}', 'UserChats@store');
    Route::get('chats/contact-update', 'UserChats@getContactUpdates');
    
    Route::post('buy-offers/{travelerId}/{offerId}', 'BuyerOffers@storeCounter');
    Route::post('trip-offers/{buyerId}/{offerId}', 'TravelerOffers@storeCounter');
    
    Route::post('buyer/reject-offers/{travelerId}', 'BuyerOffers@reject');
    Route::post('traveler/reject-offers/{buyerId}', 'TravelerOffers@reject');
    
    Route::get('traveler/accept-offer/{buyerId}', 'TravelerOffers@accept');
    Route::get('buyer/accept-offer/{travelerId}', 'BuyerOffers@accept');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Payments
    *-------------------------------------------------------------------------------------------
    */
    Route::get('payments/buyer', 'Payments@buyer');
    Route::get('payments/buyer/paid', 'Payments@paidByBuyer');
    Route::get('payments/buyer/unpaid', 'Payments@unpaidByBuyer');
    Route::get('payments/traveller/gave-product-to-buyer/{id}', 'Payments@TravellerGaveProductToBuyer');
    Route::get('payments/buyer/buyer-received-product-from-traveller/{id}', 'Payments@buyerReceivedProductFromTraveller');
    Route::get('payments/traveller/earning-history', 'Payments@earningHistory');
    Route::get('payments/buyer/pay-now/{id}', 'Payments@payNowPaypal');
    Route::get('paypal/complete', 'Payments@getDone');
    Route::get('paypal/cancel', 'Payments@getCancel');
    Route::get('payza/complete/{paymentID}', 'Payments@payzaSuccess');
    Route::get('payza/cancel', 'Payments@getCancel');
    Route::get('payments/traveller', 'Payments@traveller');
    Route::get('payments/traveller/paid', 'Payments@paidForTraveller');
    Route::get('payments/traveller/unpaid', 'Payments@unpaidForTraveller');
    Route::get('payments/{id}/accept-payment-with-stripe', 'Payments@stripePaymentPage');
    
    
    Route::get('fetch-image-from-url/{asin}', 'Amazons@getProductThumbnail');
    
    Route::get('fetch-cities-for-country/{countryId}', 'StaticPageController@getCitiesForCountry');
    
    Route::post('stripe/{payment_id}', 'Stripes@index');
    
    Route::post('pitneybowes-rates', 'Shippings@returnPitneybowesRates');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Orders
    *-------------------------------------------------------------------------------------------
    */
    Route::get('new-order', 'BuyOrders@newOrder');
    Route::post('new-order', 'BuyOrders@postNewOrder');
    Route::get('order-history', 'BuyOrders@history');
    Route::get('order-summary/{id}', 'BuyOrders@orderSummary');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Notifications
    *-------------------------------------------------------------------------------------------
    */
    Route::get('notification', 'Notifications@userView');
    Route::get('notifications/mark-read', 'Notifications@markRead');
    
});




/**
*
* Blog admin routes
* 
*/
Route::group(['middleware'=>['auth','permission'],'prefix'=>'admin'], function()
{

    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG (Has Many - Slides, Comments)
    *-------------------------------------------------------------------------------------------
    */
    Route::get('blog-search/{param}', 'Blogs@ajaxSearch');
    Route::post('blogs/search',  'Blogs@searchIndex');
    // Route::get('blogs/search', function(){ return redirect()->action('Blogs@index'); });
    Route::get('blogs/{id}/comments-create', 'Blogs@commentsCreate');   
    Route::get('blogs/{id}/comments', 'Blogs@comments');   
    Route::post('blogs/{id}/comment', 'Blogs@commentStore');   
    Route::post('blogs/{id}/comment/{comment}', 'Blogs@commentReplyStore');
    Route::get('blog/{id}/remove-related-blog/{related}', 'Blogs@removeRelatedBlog');
    Route::resource('blogs', 'Blogs');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG > Slides
    *-------------------------------------------------------------------------------------------
    */
    Route::post('blogslides/search', 'Blogslides@searchIndex');
    // Route::get('blogslides/search', function(){ return redirect()->action('Blogslides@index'); });
    Route::resource('blogslides', 'Blogslides');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG > Comments
    *-------------------------------------------------------------------------------------------
    */
    Route::post('comments/search', 'Comments@searchIndex');
    // Route::get('comments/search', function(){ return redirect()->action('Comments@index'); });
    Route::get('comments/{id}/publish', 'Comments@publish');
    Route::get('comments/{id}/unpublish', 'Comments@unpublish');
    Route::resource('comments', 'Comments');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG CATEGORIES
    *-------------------------------------------------------------------------------------------
    */
    Route::get('blogcategories/{id}/blogs', 'Blogcategories@blogs');
    Route::post('blogcategories/search', 'Blogcategories@searchIndex');
    // Route::get('blogcategories/search', function(){ return redirect()->action('Blogcategories@index'); });
    Route::resource('blogcategories', 'Blogcategories');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG Tags
    *-------------------------------------------------------------------------------------------
    */
    Route::get('blogtags/{id}/blogs', 'Blogtags@blogs');
    Route::post('blogtags/search', 'Blogtags@searchIndex');
    // Route::get('blogtags/search', function(){ return redirect()->action('Blogtags@index'); });
    Route::resource('blogtags', 'Blogtags');
    
    
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Graphs
    *-------------------------------------------------------------------------------------------
    */
    Route::get('user-signup-last-week', 'Graphs@userSignupLastWeek');
    Route::get('user-signup-last-month', 'Graphs@userSignupLastMonth');
    Route::get('user-signup-last-year', 'Graphs@userSignupLastYear');
    
    Route::get('buys-year-graph', 'Graphs@buypostLastYear');
    Route::get('travel-year-graph', 'Graphs@travelpostLastYear');
    
    Route::get('offers-last-week', 'Graphs@offersLastWeek');
    Route::get('offers-last-month', 'Graphs@offersLastMonth');
    
    Route::get('chat-last-month', 'Graphs@chatLastMonth');
    Route::get('user-by-country', 'Graphs@userByCountry');
    Route::get('travel-by-country', 'Graphs@travelByCountry');
    Route::get('buy-by-country', 'Graphs@buyByCountry');
    
    
    


});

