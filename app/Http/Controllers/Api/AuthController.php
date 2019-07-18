<?php

namespace App\Http\Controllers\Api;

use App\Users\Models\User as User;
use App\Accounts\Models\Account as Account;
use Carbon\Carbon;
use App\Constants\Error;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:q2_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'unique:q2_users', 'min:10'],
            'gender' => ['required', 'string'],
            'account_type' => 'required|string',
            'account_name' => 'required|string'
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 400);
        }  

        // Creating account
        $account = new Account;
        $account->name = $request->account_name;
        $account->type = $request->account_type;
        $account->status = 'trialing';
        $account->save();
 
        // Creating user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->account_id = $account->id;
        $user->is_admin = 1;
        $user->email_token = str_random(60);
        $user->created_by = env('QORUZ_BOT_USER_ID');
        $user->save();

        // Assign Role
        $user->assignRole('admin');

        // Send the email verification notification.
        $user->sendEmailVerificationNotification();
 
        // Auth token
        $token = $user->createToken('qoruz_api')->accessToken;
 
        return response()->json([
            'ok' => true,
            'token' => $token
        ], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 200);
        }  

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 0
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('qoruz_api')->accessToken;

            return response()->json([
                'ok' => true,
                'token' => $token,
            ], 200);

        } else {
            return response()->json([
                'ok' => false,
                'error' => Error::WRONG_CREDENTIALS
            ], 401);
        }
    }

    /**
     * Logout user (Revoke the token)
     * 
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'ok' => true
        ]);
    }
}
