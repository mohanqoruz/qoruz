<?php

namespace App\Plan\Traits;

use App\Plan\Models\Plan;

trait Plannable {

	/**
     * Get the all plans owned by user
     *
     * @return  Plan $plan
     */
    public function plans()
    {
       return $this->belongsToMany(Plan::class, 'q2_user_plans');
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
     * Create new plan for user
     *
     * @return  Plan $plan
     */
    public function createPlan($plan_name)
    {

    }
    
 }