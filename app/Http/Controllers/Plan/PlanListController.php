<?php

namespace App\Http\Controllers\Plan;

use ErrorType;
use Illuminate\Http\Request;

use App\Rules\CheckProfile;

use App\Plans\Models\PlanList as PlanList;
use App\Plans\Models\Plan as Plan;
use App\Plans\Models\ListProfiles as ListProfiles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PlanListController extends Controller
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
     * List of Plans
     * @return Array $lists
     */
    public function planLists(Request $request)
    {      
        // Validating user inputs
       $validator = Validator::make($request->all(), [
        'plan_id' => ['required', 'exists:q2_plans,id']
       ]);
    
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }

        $lists = PlanList::where('plan_id',$request->plan_id)->get();
        return response()->json([
            'ok' => true,
            'lists' => $lists
        ], 200);
    }
    
    /**
     * Create List 
     * @return Array List $list 
     */
    public function createList(Request $request)
    {
       // Validating user inputs
       $validator = Validator::make($request->all(), [
        'plan_id' => ['required', 'exists:q2_plans,id']
       ]);
    
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }
         
        $plan = Plan::find($request->plan_id);
        $list = $plan->createList($request->user());
        return response()->json([
            'ok' => true,
            'list' => $list
        ], 200);
        

    }

    /**
     * Update List 
     * @return List Array 
     */
    public function updateList(Request $request)
    {
        // Validating user inputs
       $validator = Validator::make($request->all(), [
        'list_id'   => 'required',
       ]);
    
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }

        $list = PlanList::find($request->list_id);
        if ($request->has('name')) {
            $list->name = $request->name;
        }
        if ($request->has('label_color')) {
            $list->label_color = $request->label_color;
        }
        $updatedList = $list->save();

        return response()->json([
            'ok' => true,
            'list'=> $list
        ], 200);
    }

    /**
     * Add profiles to List
     * @return List $list
     */
    public function addProfiles(Request $request)
    {      
        $profileIds[] = $request->profiles;
        $request->merge(['profileIds' => $profileIds]);

       // Validating user inputs
        $validator = Validator::make($request->all(), [
            'list_id'   => 'required',
            'profiles' => 'required',
            'profileIds.*' => 'exists:profiles,id',
            'profileIds' => [ new CheckProfile($request->list_id)],          
        ]);
        
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }
        
        $list = PlanList::find($request->list_id);
        $list_result = $list->addProfile($request->profiles);

        return response()->json([
            'ok' => true,
            'planlist' => $list_result
        ], 200);

    }

    /**
     * Remove Profiles
     * @return bool
     */
    public function removeProfile(Request $request)
    {   
        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'list_id'   => 'required',
            'profiles' => 'required',
        ]);
    
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }

        $list = PlanList::find($request->list_id);
        $list_result = $list->removeProfiles($request->profiles);

         return response()->json([
            'ok' => true,
            'planlist' => $list_result
        ], 200);
        
    }
}
