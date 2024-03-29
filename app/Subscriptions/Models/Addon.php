<?php

namespace App\Subscriptions\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_addons';

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
       'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];   
}
