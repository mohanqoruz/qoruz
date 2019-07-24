<?php

namespace App\Http\Controllers\Plan;

use ErrorType;
use Illuminate\Http\Request;

use App\Rules\CheckProfile;

use App\Plans\Models\PlanList as PlanList;
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
     * Create List 
     * @return Array $list 
     */
    public function create(Request $request)
    {
       // Validating user inputs
       $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'label_color' => ['required','max:7'],
        'plan_id' => ['required','integer']
       ]);
    
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }

        $planlist = new PlanList;
        $planlist->name = $request->name;
        $planlist->label_color = $request->label_color;
        $planlist->plan_id = $request->plan_id;  
        $planlist->owner_id = $request->user()->id;    
        $planlist->save();

        return response()->json([
            'ok' => true,
            'planlist' => $planlist
        ], 200);
        

    }

    /**
     * Update List 
     * @return bool
     */
    public function update(Request $request)
    {
        // Validating user inputs
       $validator = Validator::make($request->all(), [
        'list_id'   => 'required',
        'name' => ['required', 'string', 'max:255'],
        'label_color' => ['required','max:10'],
        'plan_id' => 'required|integer',
       ]);
    
        if ($validator->fails()) {            
            return response()->json([
                'ok' => false,
                'error' => ErrorType::VALIDATION_FAILED,
                'validation_errors' => $validator->errors()
            ], 401);
        }

        $planlist = PlanList::find($request->list_id);
        $planlist->name = $request->name;
        $planlist->label_color = $request->label_color;
        $planlist->plan_id = $request->plan_id;  
        $planlist->save();

        return response()->json([
            'ok' => true,
            'planlist' => $planlist
        ], 200);
    }

    /**
     * Add profiles to List
     * @return bool
     */
    public function addProfiles(Request $request)
    {      
        $profileIds[] = $request->profiles;
        $request->merge(['profileIds' => $profileIds]);

       // Validating user inputs
        $validator = Validator::make($request->all(), [
            'list_id'   => 'required',
            'profiles' => 'required',
            'profileIds.*' => 'exists:profiles,id'           
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
        
        return $list_result;

    }

    /**
     * Remove Profiles
     * @return bool
     */
    public function deleteprofile(Request $request)
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

        return $list_result;
        
    }
}
