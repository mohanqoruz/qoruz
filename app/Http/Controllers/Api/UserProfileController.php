<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('verified');
    }
    
    public function changePassword(Request $request)
    {
        // Validating user inputs
        $validator = Validator::make($request->all(), [            
            'old_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => $validator->errors()
            ], 200);
        }  

        $user = $request->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'ok' => true,
                'stuff' => 'Password changed successfully!'
            ], 200);

        } else {
            return response()->json([
                'ok' => false,
                'error' => 'old_password_wrong'
            ], 200);
        }

    }

}
