<?php

namespace App\Http\Controllers\Api;

use ErrorType;
use App\Users\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Notifications\EmailVerifiedNotification;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    use VerifiesEmails;
    
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        // $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {        
        // if ($request->route('id') != $request->user()->getKey()) {
        //     throw new AuthorizationException;
        // }

         // Validating user inputs
        $validator = Validator::make($request->all(), [
            'token' => ['required']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 400);
        }  

        $user = User::where('email_token', $request->token)->first();
        if (! $user) {
            return response()->json([
                'ok' => false,
                'error' => ErrorType::INVALID_TOKEN
            ], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'ok' => false,
                'stuff' => 'User already have verified email!',
                'error' => ErrorType::ALREADY_VERIFIED
            ], 422);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'ok' => true,
            'stuff' => 'Verified Successfully!'
        ], 200);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'ok' => false,
                'stuff' => 'User already have verified email!',
                'error' => ErrorType::ALREADY_VERIFIED
            ], 422);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'ok' => true,
            'stuff' => 'The notification has been resubmitted!'
        ], 200);

    }
}
