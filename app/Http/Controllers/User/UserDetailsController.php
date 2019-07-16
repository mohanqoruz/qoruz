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

        $user = $request->user();
         return [
             'roles' => $user->roles,
             'plan' => $user->hasRole('plan'),
             'report' => $user->hasRole('report'),
             'addons' => $user->hasRole('addon'),
         ];

        return response()->json([
            'ok' => true,
            'user' => $request->user()
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
}
