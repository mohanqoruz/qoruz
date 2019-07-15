<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
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

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return ['ok' => true, 'msg' =>'already_verified'];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return ['ok' => true, 'msg' => 'verified successfully'];


    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ['ok' => true, 'msg' =>'already_verified'];
        }

        $request->user()->sendEmailVerificationNotification();

        return ['ok' => true, 'msg' => 'please check your mail'];

    }
}
