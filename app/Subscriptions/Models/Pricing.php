<?php

namespace App\Subscriptions\Models;

use App\Subscriptions\Traits\HasAddon;
use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasAddon, HasBelongsToManyEvents;
    
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
       'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Pricing addons pivot relation event observer
     * Here fired belogns to many attaching events 
     * Adding addons booster
     */
    protected static function boot()
    {
        parent::boot();

        static::belongsToManyAttaching(function ($relation, $parent, $ids) {
            \Log::info('_____________________(*_*)________________________');
            \Log::info("Attaching addon to pricing {$parent->name}.");

        });

        static::belongsToManyAttached(function ($relation, $parent, $ids) {
            self::addAddonBooster($parent, $ids);
            \Log::info("Addon has been attached to pricing {$parent->name}.");
        });
    }

}
