<?php

namespace App\Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
     use IsSharable;

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
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

   
}
