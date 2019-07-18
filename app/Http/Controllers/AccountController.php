<?php

namespace App\Http\Controllers;

use App\Accounts\Models\Account as Account;

use Illuminate\Http\Request;

class AccountController extends Controller
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
     *  Get the Account Details
     *  @return Json Account $account
     */
    public function getAccountDetails(Request $request)
    {

        $account = $request->user()->account;
        return response()->json([
            'ok' => true,
            'account' => $account
        ], 200);
    }

    /**
     * Create Pricing for Account
     * @return Pricing $pricing
     */
    public function addPricing(Request $request)
    {   
        $account = $request->user()->account;
        $pricing = $account->addPricing($request->pricing_name);
        return response()->json([
            'ok' => true,
            'pricings' => $pricing
         ], 200);
    }

     /**
     * Create Addon for Pricing
     * @return Addon
     */
    public function addAddon(Request $request)
    {   
        $account = $request->user()->account;
        $pricing = $account->pricing;
        // return $pricing;
        $addon = $pricing->addAddons('reportaddon20');
        return response()->json([
            'ok' => true,
            'addon' => $addon
         ], 200);

    }

    /**
     * Get the All Pricings details the account
     * @return Pricing $pricing with addons
     */
    public function getAccountPricings(Request $request)
    {
        $account =  $request->user()->account;
        return response()->json([
            'ok' => true,
            'pricings' => $account->getAllPricingsWithAddons()
         ], 200);
    }

    /**
     * Get Active Pricing for Account with addons
     * @return Account $account
     */
    public function getAccountActivePricing(Request $request)
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
    public function getAccountSubscriptions(Request $request)
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
    public function getAccountActiveSubscription(Request $request)
    {
       $account =  $request->user()->account;
       return response()->json([
            'ok' => true,
            'subscription' => $account->subscription,
        ], 200);
    }

    /**
     * Get Account Related Users
     * @return Users $users
     */
    public function accountUsers(Request $request)
    {   
        return response()->json([
            'ok' => true,
            'users' => Account::find($request->user()->account_id)->users()->get()
        ], 200);
        
    }

}

