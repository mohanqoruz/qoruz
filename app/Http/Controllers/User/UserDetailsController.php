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
     * Get  all the documnets shared with me
     */
    public function sharedWithMe(Request $request)
    {
        return response()->json([
            'ok' => true,
            'sharedwithme' => $request->user()->sharedWithMe
        ], 200);
    }

    /**
     * Get all documents shared by me
     */
    public function sharedBy(Request $request)
    {
        return response()->json([
            'ok' => true,
            'sharedby' => $request->user()->sharedBy
        ], 200);
    }
    
}
