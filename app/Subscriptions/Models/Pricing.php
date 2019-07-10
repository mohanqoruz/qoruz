<?php

namespace App\Subscriptions\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_pricing';

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];
}