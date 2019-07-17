<?php

namespace App\Subscriptions\Traits;

use Carbon\Carbon;
use App\Subscriptions\Models\Pricing as Pricing;
use App\Subscriptions\Models\Subscription as Subscription;

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
    public function getSubscriptionAttribute()
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
      * @return Subscription $subscription
      */
     public static function createSubscription($account, $pricing_ids)
     {
        foreach ($pricing_ids as $pricing_id) {
           $pricing = Pricing::find($pricing_id);

           if ($pricing) {
              $subscription = new Subscription;
              $subscription->pricing_id = $pricing->id;
              $subscription->account_id = $account->id;

              $subscription->plans_count = $pricing->plans_count;
              $subscription->reports_count = $pricing->report_count;
              $subscription->brands_count = $pricing->brand_count;
              $subscription->users_count = $pricing->users_count;
              $subscription->profiles_count = $pricing->profile_views;

              $subscription->start_at = Carbon::now();
              $subscription->ends_at = Carbon::now()->addMonths($pricing->data_renewal_frequency);
              $subscription->save();

              return $subscription;
           }
        }
     }

     /**
      * Check SUbscription for ProfileViews
      * @return bool
      */
      public function canViewProfile()
      {
         $subscription = $this->subscription();
         return ($subscription->profiles_count) ? true : false ;
      }

      /**
       * Check Subscription for Report Refresh
       * @return bool
       */
      public function canReportRefresh()
      {
         $subscription = $this->subscription();
         return ($subscription->report_refresh) ? true : false ;
      }

      /**
       * Check Subscription for creating Report
       * @return bool
       */
      public function canCreateReport()
      {
         $subscription = $this->subscription();
         return ($subscription->reports_count) ? true : false ;
      }

      /**
       * Check Subscrition for creating new plan
       * @return bool
       */
      public function canCreatePlan()
      {
         $subscription = $this->subscription();
         return ($subscription->plans_count) ? true : false ;
      }

      /**
       * Check Subscription for creating new User
       * @return bool
       */
      public function canCreateUser()
      {
         $subscription = $this->subscription();
         return ($subscription->users_count) ? true : false ;
      }

      /**
       * Check Subscription for creating new Brand
       * @return bool
       */
      public function canUseBrand()
      {
         $subscription = $this->subscription();
         return ($subscription->brands_count) ? true : false ;
      }

      /**
       * Decrement the Profile View of subscription
       * @return bool
       */
      public function decreaseProfileView($count = 1)
      {
         $subscription = $this->subscription();
         $subscription->decrement('profile_views', $count);
         return $subscription;
      }

      /**
       * Decrement the Report Count of subscription
       * @return bool
       */
      public function decreaseReportCount($count = 1)
      {
         $subscription = $this->subscription();
         $subscription->decrement('reports_count', $count);
         return $subscription;
      }

      /**
       * Decrement the Plan Count of subscription
       * @return bool
       */
      public function decreasePlanCount($count = 1)
      {
         $subscription = $this->subscription();
         $subscription->decrement('plans_count', $count);
         return $subscription;
      }

      /**
       * Decrement the Brand Count of subscription
       * @return bool
       */
      public function decreaseBrandCount($count = 1)
      {
         $subscription = $this->subscription();
         $subscription->decrement('brands_count', $count);
         return $subscription;
      }

      /**
       * Decrement the User Count of subscription
       * @return bool
       */
      public function decreaseUserCount($count = 1)
      {
         $subscription = $this->subscription();
         $subscription->decrement('users_count', $count);
         return $subscription;
      }
}