
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
Route::get('/', ['as'=>'home', 'uses'=>'StaticPageController@home']);
Route::get('contact-us',        'StaticPageController@contact');
Route::post('contact-us',       'StaticPageController@postContact');
Route::get('page/{name}',       'StaticPageController@page');
Route::get('blog/{name}',       'StaticPageController@singleBlog');
Route::post('subscribers/subscribe',    'Subscribers@subscribe');
Route::get('subscribers/unsubscribe',   'Subscribers@unsubscribe');
Route::post('subscribers/unsubscribe',  'Subscribers@unsubscribe');



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
    
    Route::get('social/{name}',                 'AccessController@social');
    Route::get('login', ['as'=>'login','uses'=> 'AccessController@login']);
    Route::post('login',                        'AccessController@postLogin');
    Route::get('logout',                        'AccessController@logout');
    
    Route::get('forgot-password',               'AccessController@forgotPassword');
    Route::post('forgot-password',              'AccessController@postForgotPassword');
    
    Route::get('signup', ['as'=>'signup', 'uses'=>  'AccessController@signup']);
    Route::post('signup',                           'AccessController@postSignup');
    
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
    Route::get('permissions/search',        'Permissions@index' );
    Route::get('permissions/auto-update',   'Permissions@index' );
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
    Route::get('socials/search', 'Socials@index' );
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
    Route::get('user-search/{param}', 'Users@ajaxSearch');
    Route::get('users/search', 'Users@index' );
    Route::post('users/search', 'Users@postSearch');
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
    | Static pages
    |-----------------------------------------------------------------------------------
    |
    |   
    */
    Route::post('pages/search', 'Pages@searchIndex');
    Route::get('pages/search', 'Pages@index' );
    Route::resource('pages', 'Pages');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Currencies
    *-------------------------------------------------------------------------------------------
    */
    Route::post('currencies/search', 'Currencies@searchIndex');
    Route::get('currencies/search', 'Currencies@index' );
    Route::resource('currencies', 'Currencies');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Gateways
    *-------------------------------------------------------------------------------------------
    */
    Route::post('gateways/search', 'Gateways@searchIndex');
    Route::get('gateways/search', 'Gateways@index' );
    Route::resource('gateways', 'Gateways');
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > Shippings
    *-------------------------------------------------------------------------------------------
    */
    Route::post('shippings/search', 'Shippings@searchIndex');
    Route::get('shippings/search', 'Shippings@index' );
    Route::resource('shippings', 'Shippings');
    
    
    /*
    |-----------------------------------------------------------------------------------
    |My Profile
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-profile', 'MyProfile@show');
    Route::post('my-profile', 'MyProfile@update');
    Route::get('my-profile/edit', 'MyProfile@edit');
    

    /*
    |-----------------------------------------------------------------------------------
    |Change password
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-profile/change-password', 'MyProfile@changePassword');
    Route::post('my-profile/change-password', 'MyProfile@updatePassword');
    

    /*
    |-----------------------------------------------------------------------------------
    |My Referrals
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-referrals', 'MyProfile@myReferrals');


});












/**
|
|------------------------------------------------------------------------------------
|   Users area
|------------------------------------------------------------------------------------
|
*/



Route::group(['middleware'=>'auth','prefix'=>'user'], function()
{
    
    Route::get('dashboard', 'Dashboard@client');
    
    
    /*
    |-----------------------------------------------------------------------------------
    |My Profile
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-profile', 'Clients@showProfile');
    Route::post('my-profile', 'Clients@updateProfile');
    Route::get('my-profile/edit', 'Clients@editProfile');
    

    /*
    |-----------------------------------------------------------------------------------
    |Change password
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-profile/change-password', 'Clients@changePassword');
    Route::post('my-profile/change-password', 'Clients@updatePassword');
    

    /*
    |-----------------------------------------------------------------------------------
    |My Referrals
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-referrals', 'Clients@myReferrals');

    /*
    |-----------------------------------------------------------------------------------
    |My Orders
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-orders', 'Clients@myOrders');
    Route::get('my-orders/show/{id}', 'Clients@showMyOrder');
    Route::get('my-orders/edit/{id}', 'Clients@editMyOrder');
    

    /*
    |-----------------------------------------------------------------------------------
    |Track Delivery of My Orders
    |-----------------------------------------------------------------------------------
    */
    Route::get('delivery-status-of-my-orders', 'Clients@trackDeliveryOfMyOrders');
    

    /*
    |-----------------------------------------------------------------------------------
    |My Payment History
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-payment-history', 'Clients@myPaymentHistory');
    

    /*
    |-----------------------------------------------------------------------------------
    |My Reward points
    |-----------------------------------------------------------------------------------
    */
    Route::get('my-reward-points', 'Clients@myPoints');
    
    
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
    Route::get('blogs/search', 'Blogs@index');
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
    Route::get('blogslides/search', 'Blogslides@index');
    Route::resource('blogslides', 'Blogslides');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG > Comments
    *-------------------------------------------------------------------------------------------
    */
    Route::post('comments/search', 'Comments@searchIndex');
    Route::get('comments/search', 'Comments@index');
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
    Route::get('blogcategories/search', 'Blogcategories@index' );
    Route::resource('blogcategories', 'Blogcategories');
    
    
    /**
    *-------------------------------------------------------------------------------------------
    *   Application > BLOG Tags
    *-------------------------------------------------------------------------------------------
    */
    Route::get('blogtags/{id}/blogs', 'Blogtags@blogs');
    Route::post('blogtags/search', 'Blogtags@searchIndex');
    Route::get('blogtags/search', 'Blogtags@index');
    Route::resource('blogtags', 'Blogtags');


});



