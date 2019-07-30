<?php

namespace App\Plans\Traits;

trait Listable {

    /**
     * Get the all list owns the plan
     */
    public function lists()
    {
        return $this->hasMany('App\Plans\Models\PlanList');
    }

     /**
     * Creating new empty list 
     */
    public function createList()
    {
        $list_name = 'Untitled List ' . ( $this->lists->count() + 1 );
        return $this->lists()->create(['name' => $list_name]);
    }
    
}