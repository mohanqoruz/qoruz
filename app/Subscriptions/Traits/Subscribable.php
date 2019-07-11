<?php

namespace App\Subscriptions\Traits;

trait Subscribable {

	/**
     * Get the all subscriptions owned by account
     *
     * @return  Subscription $subscriptions
     */
    public function subscriptions()
    {
       return $this->hasMany('App\Subscriptions\Models\Subscription');
    } 
    
    /**
     * Get the current active subscription owned by account
     *
     * @return  Subscription $subscription
     */
    public function subscription()
    {
    	return $this->subscriptions()->where('status',1)->first();
    }

    /**
     * Checking current subscription status
     *
     * @return  bool 
     */
     public function isSubscriptionActive() : bool
     {
        return ($this->subscription()) ? true : false ;
     }

     /**
     * Get subscription end date
     *
     * @return  Date $date 
     */
     public function subscriptionEnds() 
     {  
        $subscription = $this->subscription();
        return $subscription->ends_at;
     }

} 