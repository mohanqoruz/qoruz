<?php

namespace App\Http\Controllers\Api;

use App\Notifications\EmailVerifiedNotification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
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
        $this->middleware('auth:api');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     */
    public function show()
    {
        //
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'ok' => true,
                'stuff' => 'User already have verified email!',
                'warning' => 'already_verified'
            ], 422);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'ok' => true,
            'stuff' => 'Verified Successfully!',
            'warning' => 'email_verified'
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
                'ok' => true,
                'stuff' => 'User already have verified email!',
                'warning' => 'already_verified'
            ], 422);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'ok' => true,
            'stuff' => 'The notification has been resubmitted!',
            'warning' => 'email_resent'
        ], 200);

    }
}
