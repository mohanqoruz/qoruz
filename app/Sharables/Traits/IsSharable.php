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
    
    public function shareTo($sender, $receiver, $permisson='')
    {   
        $token = \Str::random(60).time();
        
        $sharable =  $this->shares()->create([
           'share_to' => $receiver->id,
           'share_by' => $sender->id,
           'permissions' => $this->parsePermissions($permisson),
           'token' => $token
        ]);

        $sharable_url = $this->buildUrl($sharable->token);
        $receiver->sendShareNotification($sender, $sharable_url);
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

    /**
     * Generate URL
     */
    private function buildUrl($token)
    {
        $baseUrl = env('APP_URL').'/api/shared/';
        return url($baseUrl.$token);
    }

    
}