<?php

namespace App\Sharables\Traits;

trait IsSharable {

	 /**
     * Get the sharable record associated with the user.
     */
    public function sharable()
    {
        return $this->morphTo();
    }
    
 }