<?php

namespace App\Http\Controllers\Api;
use Intervention\Image\ImageManager;
use App\Users\Models\User; 
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

    /**
     * Update user profile 
     * @para Array $array with the fileds needed to be updated
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
            ], 200);
        }  

        $user = User::find($request->user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        if($request->profile_image){

           $photo = $request->profile_image;
           $slug = Str::slug($request->user()->name, '-');
           $imagename = $request->user()->id.'_'.$slug.'.'.$photo->getClientOriginalExtension();
           //if resize is needed it is done in this step
           $image = \Image::make($photo);
           $user->profile_image =  $imagename;
           $picture = (string) $image->encode();
           $local = Storage::disk('local')->put(env('IMAGE_PATH') . $imagename, $picture);

        }
        $user->save();
        return response()->json([
            'ok' => true,
            'stuff' => 'Profile updated successfully!'
        ], 400);

    }

}
