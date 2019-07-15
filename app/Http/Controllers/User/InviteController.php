<?php

namespace App\Http\Controllers\User;

use App\Mail\SendInvite;
use App\Users\Models\UserInvite; 
use App\Users\Models\User; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
        $this->middleware('auth:api')->only('sendInvite');
        $this->middleware('signed')->only('acceptInvite');
        $this->middleware('throttle:6,1')->only('acceptInvite');
        $this->middleware('verified')->only('sendInvite');
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
            $token = str_random(48);
        }
        while (UserInvite::where('token', $token)->first());

        $user = $request->user();
        $invite = UserInvite::create([
            'inviter_id' => 2,
            'email' => $request->get('email'),
            'token' => $token,
            'status' => 1
        ]);
    
        // send the email
        Mail::to($request->get('email'))->send(new SendInvite($invite));

        return ['status' => 'ok'];

    }

    /**
     * Accept url  
     * 
     * 
     * 
     * @return  Json and Redirect to React App
     */
    public function acceptInvite(Request $request)
    {   
        $invite = UserInvite::where('token', $request->token)->first();
        if (!$invite) {
            return response()->json([
                'ok' => false,
                'error' => 'user_not_found'
            ], 400);
        }

        $username = Str::before($invite->email, '@');
        $request->merge(['email' => $invite->email]);
         // Validating user details
         $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:q2_users']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => $validator->errors()
            ], 400);
        }  
        //redirect them to React UI to show validation errors
        $inviter = User::find($invite->inviter_id);
           
        $user = new User;
        $user->name = $username;
        $user->email = $invite->email;
        $user->account_id =  $inviter->account_id;
        $user->password =  bcrypt('password');
        $user->save();

        //update invite status
        $invite->status = 0;
        $invite->save();

        return response()->json([
            'ok' => true,
            'user' => $user
        ], 200);
        //redirect them to React UI to add password
    }

    /**
     * Resending Invite email to user
     * @return Json
     */
    public function resendInvite(Request $request)
    {   

        $token = str_random(48);
        $invite = UserInvite::where('email', $request->email)
            ->where('status',1)
            ->first();

        if($invite) {
            $invite->token = $token;
            $invite->save();
            //resend Mail
            Mail::to($request->get('email'))->send(new SendInvite($invite));
            return response()->json([
                'status' => 'ok',
                'invite'=> $invite
            ]);
        }else{
            return response()->json([
                'ok' => false,
                'error' => 'user_not_found'
            ], 500);
        }
        

    }
}
