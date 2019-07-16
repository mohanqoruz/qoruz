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


Route::get('/', function () {
    return [
        "app_name" => "Qoruz API",
        "vesrion" => "v.0.1-beta-1"
    ];
});


/**
 * -------------------------------------------------------------
 * User API auth routes
 * -------------------------------------------------------------
 * @location App\Controller\Auth\ApiAuthController]
 * 
 */
Route::namespace('Api')->group(function () {

    // Login and register
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login'); 

    // User logout 
    Route::get('logout', 'AuthController@logout');

    // // Email Verification
    Route::get('email.verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::get('email.resent', 'VerificationController@resend')->name('verification.resend');    

    // Forget password
    // Route::post('password/email', 'ForgotPasswordController@getResetToken');
    // Route::post('password/reset', 'ResetPasswordController@reset');

    // Change Passowrd
    Route::post('change.password', 'UserProfileController@changePassword');

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
    