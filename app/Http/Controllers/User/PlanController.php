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
     * Handles Plan create Request
     * @param  $request  planning details
     * @return Plan $plan
     */

    public function create(Request $request){

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
        if ($user->createPlan($request)) {
            return response()->json([
                'ok' => true,
                'plans' => $user->plans
            ], 200);
        }
    }

    /**
     * 
     */
    public function getPlanSharables(Request $request)
    {
       $plans =  Plan::where('slug',$request->plan)->first();
       return $plans->shares;
    }
    
}
