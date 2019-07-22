<?php

namespace App\Http\Controllers\User;

use App\Constants\Error;
use Illuminate\Http\Request;

use App\Plans\Models\Plan as Plan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Sharables\Models\Sharable as Sharable;

class PlanController extends Controller
{
   
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('subscription:create_plan')->only('create');
    }

    /**
     * Get all plans for user
     * @return Plan $plans
     */
    public function getUserDetails(Request $request)
    {
        return response()->json([
            'ok' => true,
            'plans' => $request->user()->plans
        ], 200);
    }

    /**
     * Handles Plan create Request
     * @param  $request  planning details
     * @return Plan $plan
     */

    public function create(Request $request)
    {
         $this->authorize('plans.create', User::class);
         
         // Validating user inputs
         $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'brand_id' => 'required',
            'type' => 'required',
            'platforms' => 'required',
            'plan_optimizer' => 'required|string',
            'optimizer_value' => 'required|integer'
        ]);
        
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => Error::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 404);
        }

        $user =  $request->user();
        $plan = $user->createPlan($request);
        if ($plan) {
            $request->user()->account->decreasePlanCount();
            return response()->json([
                'ok' => true,
                'plans' => $plan
            ], 200);
        }
    }

  
    
}
