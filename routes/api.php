<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {

    /**
     * -------------------------------------------------------------
     * User API auth routes
     * -------------------------------------------------------------
     * @location App\Controller\Auth\ApiAuthController]
     * 
     */
    Route::namespace('Auth')->group(function () {

        // Login and register
        Route::post('register', 'ApiAuthController@register');
        Route::post('login', 'ApiAuthController@login');  

        // User logout 
        Route::get('logout', 'ApiAuthController@logout');
    });
    
    /**
     * -------------------------------------------------------------
     * User Details routes
     * -------------------------------------------------------------
     * @location App\Controller\User\UserDetailsController
     * @location App\Controller\User\PlanController
     * 
     */
    Route::namespace('User')->group(function () {

        // User details
        Route::get('user.deatils', 'UserDetailsController@getUserDetails');
        Route::get('user.account', 'UserDetailsController@getAccountDetails');

        // User invites
        Route::post('send.invite', 'InviteController@sendInvite');
        Route::get('accept.invite', 'InviteController@AcceptInvite');

        // User plans
        Route::get('user.plans', 'PlanController@getUserDetails');
        Route::post('plans.store', 'PlanController@store');
    });  
    

});