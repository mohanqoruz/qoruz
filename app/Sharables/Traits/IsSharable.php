<?php

namespace App\Sharables\Traits;
use App\Users\Models\User as User;
use Illuminate\Http\Request;
use App\Plan\Models\Plan as Plan;
use App\Sharables\Models\Sharable as Sharable;


trait IsSharable {

   /**
     * Get all of the sharable.
     */
    public function shares()
    {
        return $this->morphMany('App\Sharables\Models\Sharable', 'sharable');
    }
    
    public function shareTo($from, $to, $permisson='')
    {   
        $sharable =  $this->shares()->create([
           'share_to' => $to,
           'share_by' => $from,
           'permissions' => $this->parsePermissions($permisson)
        ]);

        $sharable_url = '';

        $to->sendShareNotification($sharable_url);
    }

    /**
     * Parsing and set permissions
     * @return [array] $permissions
     */
    private function parsePermissions($permission)
    {
       $readonly = true;
       $edit = false;
       $feedback = false;

       if ($permission == 'edit') {
           $edit = true;
           $feedback = true;
       }

       if ($permission == 'feedback') {
            $feedback = true;
       }

       return  [
          'view' => $readonly,
          'edit' => $edit,
          'feedback' => $feedback
       ];
    }

    
}