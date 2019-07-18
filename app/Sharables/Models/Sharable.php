<?php

namespace App\Sharables\Models;

use Illuminate\Database\Eloquent\Model;

class Sharable extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_sharables';

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
        'permissions' => 'array',
    ];

    /**
     * Get the owning commentable model.
     */
    public function sharable()
    {
        return $this->morphTo();
    }
   
}