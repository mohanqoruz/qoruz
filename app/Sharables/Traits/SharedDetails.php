<?php

namespace App\Sharables\Traits;

use App\Sharables\Models\Sharable as Sharable;


trait SharedDetails {

    
    public function sharedWithMe()
    {
       return $this->hasMany(Sharable::class, 'share_to');
    }

    public function sharedBy()
    {
        return $this->hasMany(Sharable::class,'share_by');
    }

    public function sharedPlans()
    {
        return $this->sharedBy()->where('sharable_type','App\Plans\Models\Plan')->get();
    }

}