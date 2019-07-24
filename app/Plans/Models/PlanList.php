<?php

namespace App\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use App\Profiles\Traits\Profileable;

class PlanList extends Model
{
    use Profileable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    
    public function getLabelColorAttribute($value)
    {
        $color = $value;

        if ($value == '') {
            $color = '#' . dechex(mt_rant(0, 16777215));
        }

        return $color;
    }

   
}
