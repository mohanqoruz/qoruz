<?php

namespace App\Plan\Models;

use App\Sharables\Traits\IsSharable;
use App\Sharables\Models\Sharable as Sharable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    // use IsSharable;
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

    /**
     * Get the sharable record associated with the user.
     */
    public function shares()
    {
        return $this->morphMany(Sharable::class, 'sharable');
    }
}
