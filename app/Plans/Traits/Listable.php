<?php

namespace App\Plans\Traits;

trait Listable {

    public function lists()
    {
        return $this->hasMany('App\Plans\Models\PlanList');
    }

    public function createList()
    {
        $list_name = 'Untitled List ' . ( $this->lists->count() + 1 );
        return $this->lists()->create(['name' => $list_name]);
    }
}