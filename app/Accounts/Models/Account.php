<?php

namespace App\Accounts\Models;

use App\Subscriptions\Traits\Subscribable as Subscribable;
use App\Subscriptions\Traits\Priceable as Priceable;
use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{   

    use Subscribable, Priceable, HasBelongsToManyEvents;

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

     /**
     * Get the user's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Relationship for Account and Users
     */
    public function users()
    {
        return $this->hasMany('App\Users\Models\User');
    }
    

    /**
     * Account pricing pivot relation event observer
     * Here fired belogns to many attaching events 
     * Creating subscriptions
     */
    protected static function boot()
    {
        parent::boot();

        static::belongsToManyAttaching(function ($relation, $parent, $ids) {
            \Log::info('_____________________(*_*)________________________');
            \Log::info("Attaching pricing to account {$parent->name}.");

        });

        static::belongsToManyAttached(function ($relation, $parent, $ids) {
            self::createSubscription($parent, $ids);
            \Log::info("Pricing has been attached to account {$parent->name}.");
        });
    }
    
}
