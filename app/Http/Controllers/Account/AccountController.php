<?php

namespace App\Http\Controllers\Account;

use App\Constants\Error;
use Illuminate\Http\Request;
use App\Users\Models\User as User;

use Illuminate\Support\Facades\Validator;
use App\Accounts\Models\Account as Account;
use App\Http\Controllers\Controller;


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
        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'pricing_name' => ['required', 'string']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 400);
        }  

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
         // Validating user inputs
         $validator = Validator::make($request->all(), [
            'addons_name' => ['required', 'string']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 400);
        }  

        $account = $request->user()->account;
        $pricing = $account->pricing;
        $addon = $pricing->addAddons($request->user(), $request->addons_name);
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
    public function accountUsersList(Request $request)
    {   
        $users = $request->user()->account->users()->with('roles')->get();
        return response()->json([
            'ok' => true,
            'users' => $users
        ], 200);
        
    }
}

