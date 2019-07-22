<?php

namespace App\Profiles\Models;

use App\Profiles\Traits\Profileable;
use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    use Profileable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'facebook';

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
