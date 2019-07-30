<?php

namespace App\Plans\Traits;

use App\Users\Models\User as User;
use App\Profiles\Models\Profile;

trait Listable {

    /**
     * Get the all list owns the plan
     */
    public function lists()
    {
        return $this->hasMany('App\Plans\Models\PlanList');
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

}