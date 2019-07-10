<?php

namespace App\Subscriptions\Traits;

use App\Subscriptions\Models\Pricing;
use App\Subscriptions\Models\Addon;

trait Priceable {

	/**
     * Get the all subscriptions owned by account
     *
     * @return  Subscription $subscriptions
     */
    public function pricings()
    {
       return $this->belongsToMany(Pricing::class, 'q2_account_pricings');
    } 


    /**
     * Get the all subscriptions owned by account
     *
     * @return  Subscription $subscriptions
     */
    public function pricing()
    {
       return $this->pricings()->where('status',1)->first();
    } 

	/**
     * Get the all subscriptions owned by account
     *
     * @return  Subscription $subscriptions
     */
    public function addons()
    {
       return $this->belongsToMany(Addon::class,'account_pricings');
    } 
    
 }