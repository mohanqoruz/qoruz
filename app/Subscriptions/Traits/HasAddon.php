<?php

namespace App\Subscriptions\Traits;

use App\Subscriptions\Models\Addon;

trait HasAddon {

	/**
     * Get the all addons for the pricing owned by account
     *
     * @return  Addons $addons
     */
    public function addons()
    {
       return $this->belongsToMany(Addon::class,'q2_pricing_addons');
    } 

    /**
     * Add the addons for the active pricing
     *
     * @return  Addons $addons
     */
    public function addAddons($addon_name)
    {   
         if (is_string($addon_name)) {
            $addon = Addon::where('slug', $addon_name)->first();
        }
        
        $this->addons()->attach($addon,[
            'added_by' => 11
        ]);
          
        return $addon;     
        
    } 

    

    
 }