<?php

namespace App\Subscriptions\Traits;

use App\Subscriptions\Models\Subscription as Subscription;
use App\Subscriptions\Models\Pricing as Pricing;
use Carbon\Carbon;

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

     /**
      * Subscrbing the pricing related to account
      * @param [Account] $account
      * @param [Array] $pricing_ids
      * @return Subscriptions $subscriptions
      */
     public static function createSubscription($account, $pricing_ids)
     {
        foreach ($pricing_ids as $pricing_id) {
           $pricing = Pricing::find($pricing_id);

           if ($pricing) {
              $subscription = new Subscription;
              $subscription->plan_id = $pricing->id;
              $subscription->account_id = $account->id;

              $subscription->plans_count = $pricing->plans_count;
              $subscription->report_count = $pricing->report_count;
              $subscription->brand_count = $pricing->brand_count;
              $subscription->users_count = $pricing->users_count;
              $subscription->profile_views = $pricing->profile_views;

              $subscription->start_at = Carbon::now();
              $subscription->ends_at = Carbon::now()->addMonths($pricing->data_renewal_frequency);
              $subscription->save();
           }
        }
     }
}