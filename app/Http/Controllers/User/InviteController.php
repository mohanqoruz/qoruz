<?php

namespace App\Http\Controllers\User;

use App\Mail\SendInvite;
use App\Users\Models\UserInvite; 
use App\Users\Models\User; 
use App\Constants\Error;

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
        // $this->middleware('signed')->only('acceptInvite');
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
        // Validating user details
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:q2_users']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 400);
        }  

        do {
            $token = str_random(60);
        }
        while (UserInvite::where('token', $token)->first());
        
        $invite = UserInvite::where('email', $request->email)->first();
        if (! $invite) {
            $invite = UserInvite::create([
                'inviter_id' => 2,
                'email' => $request->email,
                'token' => $token,
                'status' => 0
            ]);
        } else {
            $invite->token = $token;
            $invite->save();
        }
    
        $invite->sendInviteNotification($request->user());
      
        return ['status' => 'ok'];

    }

    /**
     * Accept url  
     
     * @return  Json and Redirect to React App
     */
    public function acceptInvite(Request $request)
    {  
        // Validating user inputs
        $validator = Validator::make($request->all(), [   
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'token' => ['required']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' =>Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 400);
        }  

        $invite = UserInvite::where('token', $request->token)->first();
        if (!$invite) {
            return response()->json([
                'ok' => false,
                'error' => Error::INVALID_TOKEN
            ], 400);
        }

        $username = Str::before($invite->email, '@');

        $inviter = User::find($invite->inviter_id);
           
        $user = new User;
        $user->name = ucwords($username);
        $user->email = $invite->email;
        $user->account_id =  $inviter->account_id;
        $user->password =  bcrypt($request->password);
        $user->created_by =  $inviter->id;
        $user->save();

        // Update invite status
        $invite->status = 1;
        $invite->save();

        return response()->json([
            'ok' => true,
            'user' => $user
        ], 200);
    }
}
