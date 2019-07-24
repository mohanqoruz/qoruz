<?php

namespace App\Profiles\Traits;
use App\Profiles\Models\Profile;


trait Profileable 
{
  
    /**
     * Get the profile record associated with the platforms.
     */
    public function profile()
    {
        return $this->belongsTo('App\Profiles\Models\Profile');
    }

}