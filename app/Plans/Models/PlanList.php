<?php

namespace App\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use App\Plans\Traits\Listable;

class PlanList extends Model
{
    use Listable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label_color','owner_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];   
}
