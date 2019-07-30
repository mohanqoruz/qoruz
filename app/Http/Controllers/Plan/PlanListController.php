<?php

namespace App\Http\Controllers\Plan;

use ErrorType;
use Illuminate\Http\Request;

use App\Profiles\Models\Profile as Profile;
use App\Plans\Models\PlanList as PlanList;
use App\Plans\Models\Plan as Plan;
use App\Plans\Models\ListProfile as ListProfile;
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
        'list_id'   => ['required','exists:q2_lists,id'],
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
        
        // Validating user inputs
        $validator = Validator::make($request->all(), [
            'list_id'   => 'required',
            'profiles' => 'required'
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }
        
        $profiles = trim($request->profiles, ',');
        $profiles = explode(',',$profiles);
        
        $notfound_profile_ids = [];
        foreach($profiles as $profile) {
            $profile_exits = Profile::find($profile);

            if ($profile_exits) {
                $list_profile = ListProfile::where('profile_id',$profile)
                ->where('list_id',$request->list_id)
                ->first();
                
                if(!$list_profile){
                    $list = PlanList::find($request->list_id);
                    $list_result = $list->addProfile($profile,$request);
                }     
            }  else {
                array_push($notfound_profile_ids, $profile);
            }                   
        }

        if (count($notfound_profile_ids) != 0) {
            return response()->json([
                'ok' => true,
                'warning' => 'profile_not_found',
                'not_found_profiles' => $notfound_profile_ids
            ], 200); 
        }
        
        return response()->json([
            'ok' => true,
            'stuff' => 'Added Successfully'
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
