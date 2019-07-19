<?php

namespace App\Http\Controllers\User;

use App\Sharables\Models\Sharable;
use App\Plan\Models\Plan;
use App\Users\Models\User;

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
     *  Create a new Sharable
     *  @return Json Account $account
     */
    public function createSharable(Request $request, Plan $plan)
    {

        $plan = Plan::find($request->plan_id);
        $user = User::where('email',$request->share_to)->first();
        $plan->shareTo($request->user(), $user, $permisions);

        return response()->json([
            'ok' => true,
            'sharable' => $sharable_details
        ], 200);
    }

}
