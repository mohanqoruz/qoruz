<?php

namespace App\Plan\Traits;

use Illuminate\Support\Str;

use App\Plan\Models\Plan;

trait Plannable {

	/**
     * Get the all plans owned by user
     *
     * @return  Plan $plan
     */
    public function plans()
    {
       return $this->hasMany('App\Plan\Models\Plan','user_id','owner_id');
    } 

    /**
     * Get the all plan owned by user
     *
     * @return  Plan $plan
     */
    public function plan()
    {
       return $this->plans()->where('status',1)->first();
    }

    /**
     * Get Plan Details
     */
    public function getPlan($planName)
    {  
       $plan =  Plan::where('slug', $planName)->first();
       if(!$plan){
          throw PlanDoesNotExist::create($planName);
       }
       return $plan;
    }
    
    /**
     * Create new plan for user
     * @param Request $request as $plan_detail
     * @return  Plan $plan
     */
    public function createPlan($plan_detail)
    {   
        $owner_id = $this->id;
        $account = $this->account;
        $pricing = $this->account->pricing();

        $plan = new Plan;
        $plan->name = $plan_detail->name;
        $plan->brand_id = $plan_detail->brand_id;
        $plan->account_id = $account->id;
        $plan->owner_id = $owner_id;
        $plan->pricing_id = $pricing->id;
        $plan->type = $plan_detail->type;
        $plan->platforms = $plan_detail->platforms;
        $plan->plan_optimizer = $plan_detail->plan_optimizer;
        $plan->optimizer_value = $plan_detail->optimizer_value;
        $plan->status = 'active';
        $plan->save();
        
        $slug = Str::slug($plan->name, '-');
        $plan->slug = $slug . '-' . $plan->id;
        $plan->save();

        return true;

    }
    
 }