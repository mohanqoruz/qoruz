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
    
    /**
     * Add the addons for the active subscriptyion
     *
     * @return  Addons $addons
     */
    public static function addAddonBooster($pricing, $addons_ids)
    {
        foreach ($addons_ids as $addons_id) {
            $addons = Addon::find($addons_id);
            $subscription = $pricing->subscription();
            
            if ($addons && $subscription) {
                $booster = $addon->type . '_count';
                $subscription->increment($booster, $addons->limit);
            }
        }
    }
    
 }