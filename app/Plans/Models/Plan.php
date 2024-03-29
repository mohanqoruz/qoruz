<?php

namespace App\Plans\Models;

use App\Sharables\Models\Sharable as Sharable;
use Illuminate\Database\Eloquent\Model;
use App\Sharables\Traits\IsSharable;
use App\Plans\Traits\Listable;
use App\Plans\Traits\HasProfile;

class Plan extends Model
{
     use IsSharable, Listable, HasProfile;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_plans';

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
        'platforms' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Users\Models\User', 'owner_id');
    }
}
