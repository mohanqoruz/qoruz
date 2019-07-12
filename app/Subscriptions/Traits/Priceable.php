<?php

namespace App\Subscriptions\Traits;

use App\Subscriptions\Models\Pricing;

trait Priceable {

	/**
     * Get the all subscriptions owned by account
     *
     * @return  Pricings $pricings
     */
    public function pricings()
    {
       return $this->belongsToMany(Pricing::class, 'q2_account_pricings');
    } 


    /**
     * Get active pricing owned by account
     *
     * @return  Pricing $pricing
     */
    public function pricing() 
    {
       return $this->pricings()->where('status',1)->first();
    } 

    /**
     * Add the pricing for current logged in account
     *
     * @return  Account $account
     */
    public function addPricing($price)
    {   
        if (is_string($price)) {
            $price = Pricing::where('slug', $price)->first();

            if ($price) {                
                $this->pricings()->attach($price, [
                    'status' => 1
                ]);
            }
        }
        return $price;
    } 

    /**
     * Checking current pricing status is autorenewal 
     *
     * @return  bool 
     */
     public function isAutoRenewal() : bool
     {          
        $active_pricing = $this->pricing();
        return ($active_pricing->auto_renewal) ? true : false ;
     }

     /**
      * Checking if current pricing enabled for audience search 
      * @return bool
     */
     public function isAudienceSearchsble() : bool
     { 

        $active_pricing = $this->pricing();
        return ($active_pricing->price_audience_searchable) ? true : false ;

     }

     /**
       * Checking if current pricing enabled for registerd users 
       * @return  bool 
     */
     public function isRegisteredInfluencers() : bool
     {
        $active_pricing = $this->pricing();
        return ($active_pricing->is_access_registered_influencers) ? true : false ;
     }

     /**
      * Checking if current pricing has insights
      * @return  bool 
      */
      public function isInsightsEnabled() : bool
      {
        $active_pricing = $this->pricing();
        return ($active_pricing->is_view_insights) ? true : false ;
      }

      /**
       * Checking if pricing has filter enabled
       * @return  bool 
       */
      public function isFilterEnabled() : bool 
      {
        $active_pricing = $this->pricing();
        return ($active_pricing->is_filterable) ? true : false ;
      }

      /**
       * Checking if pricing has Competation Check
       * @return  bool 
       */
      public function isCompetationCheck() : bool 
      {
        $active_pricing = $this->pricing();
        return ($active_pricing->is_competation_check) ? true : false ;
      }

      /**
       * Checking if pricing has ReportRefresh enabled
       * @return  bool 
       */
      public function isReportRefresh() : bool 
      {
        $active_pricing = $this->pricing();
        return ($active_pricing->report_refresh) ? true : false ;
      }

    
 }