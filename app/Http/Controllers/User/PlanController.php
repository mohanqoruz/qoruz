<?php

namespace App\Http\Controllers\User;

use App\Plan\Models\Plan as Plan;
use App\Sharables\Models\Sharable as Sharable;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                'error' => $validator->errors()
            ], 404);
        }

        $user =  $request->user();
        $plan = $user->createPlan($request);
        if ($plan) {
            return response()->json([
                'ok' => true,
                'plans' => $plan
            ], 200);
        }
    }

    /**
     * Get users list for Shared document
     * @param plan slug in Request
     * @return Users $users
     */
    public function getPlanSharables(Request $request)
    {   
       $plan =  Plan::where('slug',$request->plan)->first();
       return response()->json([
            'ok' => true,
            'users' => $plan->getPlanSharables($request->plan)
        ], 200);
        
    }
    
}
