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
 * @location App\Controller\Auth\ApiAuthController
 * 
 */
Route::namespace('Api')->group(function () {

    // Login and register
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login'); 

    // User logout 
    Route::get('logout', 'AuthController@logout');

    // // Email Verification
    Route::get('email.verify', 'VerificationController@verify')->name('verification.verify');
    Route::get('email.resent', 'VerificationController@resend')->name('verification.resend?');    

    // Forget password
    Route::post('forgot.password', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('reset.password', 'ResetPasswordController@reset')->name('reset.password');

    // Change Passowrd
    Route::post('change.password', 'UserProfileController@changePassword');

    // User Profile
    Route::post('users.profile.update', 'UserProfileController@updateProfile');
    Route::post('users.setPhoto', 'UserProfileController@setUserPhoto');
    
    //Create User By Admin
    Route::post('users.create', 'UserProfileController@createUser');
});

/**
 * -------------------------------------------------------------
 * User Details routes
 * -------------------------------------------------------------
 * @location App\Controller\User\UserDetailsController
 * @location App\Controller\User\PlanDetailsController
 * 
 */
Route::namespace('User')->group(function () {

    // User details
    Route::get('users.info', 'UserDetailsController@getUserDetails');

    // User invites
    Route::post('send.invite', 'InviteController@sendInvite');
    Route::get('accept.invite', 'InviteController@acceptInvite')->name('accept.invite');

    //User Plans/Report Sharable
    Route::post('sharePlan','SharableController@sharePlan');
    Route::get('users.sharedwithme','UserDetailsController@sharedWithMe');
    Route::get('users.sharedby','UserDetailsController@sharedBy');
    // User plans
    Route::get('users.plans', 'UserDetailsController@getUserPlanDetails');
    
});  

/**
 * -------------------------------------------------------------
 * Account Details routes
 * -------------------------------------------------------------
 * @location App\Controllers\Account\AccountController
 */
Route::namespace('Account')->group(function () {

    Route::get('accounts.info', 'AccountController@getAccountDetails');

    //  Account Pricings
    Route::post('accounts.addPrcing', 'AccountController@addPricing');
    Route::post('accounts.pricing.addAddons', 'AccountController@addAddon');
    Route::get('accounts.pricings', 'AccountController@getAccountPricings');
    Route::get('accounts.activePricing', 'AccountController@getAccountActivePricing');

    // Account Subscriptions
    Route::get('accounts.subscriptions', 'AccountController@getAccountSubscriptions');
    Route::get('accounts.activeSubscription', 'AccountController@getAccountActiveSubscription');
    Route::get('accounts.users.list','AccountController@accountUsersList');

});

/**
 * -------------------------------------------------------------
 * Plan Details routes
 * -------------------------------------------------------------
 * @location App\Controllers\PlanDetailsController
 */
Route::namespace('Plan')->group(function () {

    Route::post('plans.create', 'PlanDetailsController@create');
    Route::post('lists.create', 'PlanListController@create'); 
    Route::post('lists.update', 'PlanListController@update'); 
    Route::post('lists.addprofile', 'PlanListController@addProfiles'); 
    Route::post('lists.removeprofile', 'PlanListController@removeProfile'); 

});


/**
 * -------------------------------------------------------------
 * Profiles Details routes
 * -------------------------------------------------------------
 * @location App\Controllers\Profile\ProfileDetailsController
 */
Route::namespace('Profile')->group(function () {
   //
});

