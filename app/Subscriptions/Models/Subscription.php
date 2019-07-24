<?php

namespace App\Subscriptions\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_subscriptions';

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
        'status' => 'boolean',
    ];

    /**
     * Get the subscription's  end_date.
     *
     * @param  string  $value
     * @return string
     */
    public function getEndsAtAttribute($value)
    {
        return Carbon::parse($value);
    }
}
