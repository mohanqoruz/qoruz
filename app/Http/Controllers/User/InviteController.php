<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout']);
    }

    /**
     * Invite users via email
     * 
     * @param [String] email
     * @return  Mail
     */
    public function sendInvite(Request $request)
    {
        # code...
    }

    /**
     * Accept response  
     * 
     * @param [String] token
     * @return  Mail
     */
    public function acceptInvite(Request $request, $token)
    {
        # code...
    }

    /**
     * Resending Invite email to user
     */
    private function resendInvite()
    {
        # code...
    }
}
