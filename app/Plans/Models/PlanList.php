<?php

namespace App\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use App\Profiles\Traits\Profileable;

class PlanList extends Model
{
    use Profileable;
    
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
        'name','label_color','plan_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

   
}
