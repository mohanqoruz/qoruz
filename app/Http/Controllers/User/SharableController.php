<?php

namespace App\Http\Controllers\User;

use App\Sharables\Models\Sharable;
use App\Plans\Models\Plan;
use App\Users\Models\User;
use App\Constants\Error;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SharableController extends Controller
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

     /**
     *  Create a new Sharable Plan
     *  @return Json Account $account
     */
    public function sharePlan(Request $request)
    {   
        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'sharable_id' => 'required','exists:q2_plans,id',
            'share_to' => 'required|exists:q2_users,email', // validating user,
            'permission' => 'string'
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }

        $plan = Plan::find($request->sharable_id);
        $user = User::where('email',$request->share_to)->first();
        $plan->shareTo($request->user(), $user, $request->permission);

        return response()->json([
            'ok' => true,
        ], 200);
    }

    

}
