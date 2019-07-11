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
    public function pricing() : Pricing
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
               // \Log::info('************************ok****************');
                
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
        $price_auto_renewal = $this->pricings()->where('auto_renewal',1)->first();
        return ($price_auto_renewal) ? true : false ;
     }

    
 }