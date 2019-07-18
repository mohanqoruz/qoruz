<?php

namespace App\Http\Controllers\Api;

use Intervention\Image\ImageManager;
use App\Users\Models\User; 
use App\Constants\Error;

use Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
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
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }  

        $user = $request->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            $user->token()->revoke();
            $token = $user->createToken('qoruz_api')->accessToken;

            return response()->json([
                'ok' => true,
                'token' => $token,
                'stuff' => 'Password changed successfully!'
            ], 200);

        } else {
            return response()->json([
                'ok' => false,
                'error' => Error::OLD_PASSWORD_WRONG
            ], 401);
        }

    }

    /**
     * Update user profile 
     * @param Array $array with the fileds needed to be updated
     * @return bool
     */
    public function updateProfile(Request $request)
    {   
        // Validating user inputs
        $validator = Validator::make($request->all(), [            
            'name' => ['required', 'string','max:250ss'],
            'phone' => ['required', 'integer', 'min:10'],
            'gender' => 'required',
            'profile_image' =>'required|mimes:jpeg,jpg,png,JPG,PNG|max:5120', 
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => $validator->errors()
            ], 401);
        }  

        $user = User::find($request->user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
       
        $user->save();
        return response()->json([
            'ok' => true,
            'stuff' => 'Profile updated successfully!'
        ], 200);

    }

    /**
     * Set User Photo
     * @return bool
     */
    public function setUserPhoto(Request $request)
    {
         // Validating user inputs
         $validator = Validator::make($request->all(), [            
            'profile_image' =>'required|mimes:jpeg,jpg,png,JPG,PNG|max:5120', 
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => $validator->errors()
            ], 400);
        }
        $user = User::find($request->user()->id);
        $photo = $request->profile_image;
        $slug = Str::slug($request->user()->name, '-');
        $imagename = $request->user()->id.'_'.$slug.'.'.$photo->getClientOriginalExtension();
        //if resize is needed it is done in this step
        $image = \Image::make($photo);
        $user->profile_image =  $imagename;
        $picture = (string) $image->encode();
        $local = Storage::disk('local')->put(env('IMAGE_PATH') . $imagename, $picture);

        $user->save();

        return response()->json([
            'ok' => true,
            'stuff' => 'Profile image updated successfully!'
        ], 200);

    }

    /**
     * Create User by Admin
     * @return User $user
     */
    public function createUser(Request $request)
    {
        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:q2_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'unique:q2_users', 'min:10'],
            'gender' => ['required', 'string']
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => $validator->errors()
            ], 400);
        } 
        $account = $request->user()->account; 
        // Creating user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->account_id = $account->id;
        $user->created_by = $request->user()->id;
        $user->save();

        return response()->json([
            'ok' => true,
            'token' => $user
        ], 200);
    }

}
