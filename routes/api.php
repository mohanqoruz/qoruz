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
     * 
     * Register user via signup form => @return API Token
     * Login user using email and password  => @return API Token
     * 
     */
    Route::post('register', 'Auth\ApiAuthController@register');
    Route::post('login', 'Auth\ApiAuthController@login');  
    Route::get('logout', 'Auth\ApiAuthController@logout');
    Route::get('user', 'Auth\ApiAuthController@user');

});