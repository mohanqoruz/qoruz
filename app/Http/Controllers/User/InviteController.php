<?php

namespace App\Http\Controllers\User;

use App\Mail\SendInvite;
use App\Users\Models\UserInvite; 

use Illuminate\Support\Facades\Mail;
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
        do {
            $token = str_random();
        }
        while (UserInvite::where('token', $token)->first());

        $user = $request->user();
    
        $invite = UserInvite::create([
            'inviter_id' => 1,
            'email' => $request->get('email'),
            'token' => $token
        ]);
    
        // send the email
        Mail::to($request->get('email'))->send(new SendInvite($invite));

        return ['status' => 'ok'];

    }

    /**
     * Accept response  
     * 
     * @param [String] token
     * @return  Mail
     */
    public function acceptInvite(Request $request, $token)
    {
        if (!$invite = UserInvite::where('token', $token)->first()) {
            abort(404);
        }

        // User::create(['email' => $invite->email]);

        return 'Good job! Invite accepted!';
    }

    /**
     * Resending Invite email to user
     */
    private function resendInvite()
    {
        # code...
    }
}
