<?php

namespace App\Http\Controllers\Auth;

use App\Users\Models\User as User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAuthController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['register', 'login']);
    }

    /**
     *  Create user
     */
    public function register(Request $request)
    {
        return ['register'];
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        return ['login'];
    }

    /**
     * Logout user (Revoke the token)
     * 
     */
    public function logout()
    {
        return ['logout'];
    }

    /**
     *  Get the authenticated User
     */
    public function user(Request $request)
    {
        return ['user'];
    }
}
