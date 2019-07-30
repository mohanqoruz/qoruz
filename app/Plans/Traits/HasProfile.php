<?php

namespace App\Plans\Traits;

use App\Plans\Models\ListProfile;

trait HasProfile {

    /**
     * Get the all influencers owns plan/list
     */
    public function influencers()
    {
        $class_ids = [
            'Plan' => 'plan_id',
            'PlanList' => 'list_id'
        ];

        $id = $class_ids[class_basename($this)];        
        return $this->hasMany(ListProfile::class, $id);
    }

    /**
     * Get the all influencers total count plan/list
     */
    public function getTotalInfluencerAttribute()
    {
        return $this->influencers->count();
    }

    /**
     * Get the all deliverables total count plan/list
     */
    public function getDeliverablesAttribute()
    {
        # code...
    }
}