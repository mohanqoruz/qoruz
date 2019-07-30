<?php

namespace App\Plans\Traits;

trait HasProfile {

    /**
     * Get the all influencers owns plan/list
     */
    public function influencers()
    {
        return $this->belongsToMany('App\Plans\Models\PlanList');
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