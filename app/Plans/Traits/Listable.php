<?php

namespace App\Plans\Traits;

use App\Users\Models\User as User;
use App\Profiles\Models\Profile;

trait Listable {

    public function lists()
    {
        return $this->hasMany('App\Plans\Models\PlanList');
    }

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
     * Create List 
     * @return List $list
     */
    public function createList(User $user)
    {
        $list_name = 'Untitled List ' . ( $this->lists->count() + 1 );
         
        return $this->lists()->create([
            'name' => $list_name,
            'label_color' => '#' . dechex(mt_rand(0, 16777215)),
            'owner_id' => $user->id
            ]);
    }

    /**
     * Add Profiles to List
     *
     * @return  Profiles $profiles
     */
    public function addProfile($profilesIds)
    {   
        
        $profiles = explode(',',$profilesIds);
        if ($profiles){
              $this->profileLists()->attach($profiles, []);
        }
        return  $profiles;
        
    } 

    /**
     * Remove Profiles from List
     * @return  Profiles $profiles
     */
    public function removeProfiles($profilesIds)
    {
        $profiles = explode(',',$profilesIds);
        if ($profiles){
              $this->profileLists()->detach($profiles, []);
        }
        return  $profiles;
        
    }
}