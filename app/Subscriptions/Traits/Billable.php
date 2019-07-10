<?php

namespace App\Subscriptions\Traits;

trait Billable {

	/**
     * Get the all subscriptions owned by account
     *
     * @return  Subscription $subscriptions
     */
    public function pricings()
    {
       return $this->belongsToMany(Pricing::class,'account_pricings');
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