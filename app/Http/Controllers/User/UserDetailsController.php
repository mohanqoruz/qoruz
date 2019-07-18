<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDetailsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('verified');
    }


    /**
     *  Get the authenticated User
     */
    public function getUserDetails(Request $request)
    {
        return response()->json([
            'ok' => true,
            'user' => $request->user()->load('roles')
        ], 200);
    }

    /**
     * Get users account deatils
     * 
     * @return Account $account
     */
    public function getAccountDetails(Request $request)
    {
       return response()->json([
            'ok' => true,
            'account' => $request->user()->account
        ], 200);
    }

    /**
     * Get User Pricings details
     * @return Pricing $pricing with addons
     */
    public function getAllPricingDetails(Request $request)
    {
        $account =  $request->user()->account;
        return response()->json([
            'ok' => true,
            'pricings' => $account->getAllPricingsWithAddons()
         ], 200);
    }

    /**
     * Get Active Pricing details
     * 
     * @return Pricing $pricing with addons
     */
    public function getActivePricingDetails(Request $request)
    {

       $account =  $request->user()->account;
       return response()->json([
            'ok' => true,
            'pricing' => $account->pricing,
            'addons' => $account->pricing->addons
        ], 200);
         
    }

    /**
     * Get All Subscriptions belonging to account
     * @return Subscription $subscriptions
     */
    public function getAllSubscriptionDetails(Request $request)
    {

       $account =  $request->user()->account;
       return response()->json([
            'ok' => true,
            'subscriptions' => $account->subscriptions,
        ], 200);

    }

    /**
     * Get Active Subscription belonging to account
     * @return Subscription $subscription
     */
    public function getActiveSubscriptionDetails(Request $request)
    {
       $account =  $request->user()->account;
       return response()->json([
            'ok' => true,
            'subscription' => $account->subscription,
        ], 200);
    }
}
