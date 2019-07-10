<?php

namespace App\Http\Controllers\Auth;

use App\Users\Models\User as User;
use App\Accounts\Models\Account as Account;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAuthController extends Controller
{

    private $ok = true;
    private $message = '';
    private $errors = [];

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
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
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
            $this->ok = false;
            $this->errors = $validator->errors();
            $this->message = 'Validation Error !';
            return response()->json([
                'ok' => $this->ok,
                'message' => $this->message,
                'errors' => $this->errors 
            ], 200);
        }  
        
        $account = new Account;
        $account->name = $request->account_name;
        $account->type = $request->account_type;
        $account->status = 'trialing';
        $account->save();
 
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->account_id = $account->id;
        $user->save();

        $user->assignRole('plan');

 
        $token = $user->createToken('qoruz_api')->accessToken;
 
        return response()->json([
            'ok' => $this->ok,
            'message' => 'Registered Successully...',
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
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('qoruz_api')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
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
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     *  Get the authenticated User
     */
    public function user(Request $request)
    {

        $user = $request->user();
         return [
             'roles' => $user->roles,
             'plan' => $user->hasRole('plan'),
             'report' => $user->hasRole('report'),
             'addons' => $user->hasRole('addon'),
         ];

        return response()->json(['user' => $request->user()], 200);
    }
}
