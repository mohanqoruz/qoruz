<?php

namespace App\Profiles\Traits;
use App\Profiles\Models\Profile;


trait Profileable {
  

    /**
     * 
     *
     * @return  Profile Lists 
     */
    public function profileLists()
    {
       return $this->belongsToMany(Profile::class, 'q2_list_profiles');
    } 

    /**
     * 
     *
     * @return  Profiles $profiles
     */
    public function addProfile($profilesIds)
    {   
        
        $p = explode(',',$profilesIds);
        if ($p){
              $this->profileLists()->attach($p, []);
        }
        return  $p;
        
    } 

    public function removeProfiles($profilesIds)
    {
        $p = explode(',',$profilesIds);
        if ($p){
              $this->profileLists()->detach($p, []);
        }
        return  $p;
        
    }

}