<?php

namespace App\Profiles\Traits;

trait Platformable {
    
    /**
     * Get the twitter record associated with the profile.
     */
    public function twitter()
    {
        return $this->hasOne('App\Profiles\Models\Twitter');
    }

    /**
     * Get the instagram record associated with the profile.
     */
    public function instagram()
    {
        return $this->hasOne('App\Profiles\Models\Instagram');
    }

    /**
     * Get the facebook record associated with the profile.
     */
    public function facebook()
    {
        return $this->hasOne('App\Profiles\Models\Facebook');
    }

    /**
     * Get the youtube record associated with the profile.
     */
    public function youtube()
    {
        return $this->hasOne('App\Profiles\Models\Youtube');
    }

    /**
     * Get the blog record associated with the profile.
     */
    public function blog()
    {
        return $this->hasOne('App\Profiles\Models\Blog');
    }
}