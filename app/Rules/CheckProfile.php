<?php

namespace App\Rules;

use App\Plans\Models\ListProfile as ListProfile;

use Illuminate\Contracts\Validation\Rule;

class CheckProfile implements Rule
{   
    protected $extraParam;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->extraParam = $param;
    }
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $list_id = $this->extraParam;
        $result = ListProfile::where('list_id',$list_id)
                    ->whereIn('profile_id',$value)
                    ->get();
                    
        if(!$result){
            return $result;
        };

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute are already present in the List';
    }
}
