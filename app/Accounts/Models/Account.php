<?php

namespace App\Accounts\Models;

use App\Subscriptions\Traits\Subscribable as Subscribable;
use App\Subscriptions\Traits\Priceable as Priceable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Subscribable, Priceable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_accounts';

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
