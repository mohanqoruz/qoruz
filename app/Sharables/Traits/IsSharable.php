<?php

namespace App\Sharables\Traits;
use App\Users\Models\User as User;
use Illuminate\Http\Request;
use App\Plan\Models\Plan as Plan;
use App\Sharables\Models\Sharable as Sharable;


trait IsSharable {

	 /**
     * Get the sharable record associated with the user.
     */
    public function sharable()
    {
        return $this->morphTo();
    }
    

    /**
     * Get users list for Shared document
     * @return Users $users
     */
    public function getPlanSharables($plan)
    {
       $plans =  Plan::where('slug',$plan)->first();
       $users = array();
       foreach($plans->shares as $share){
        $users[] = $share->share_to;
       }
       $users =  User::whereIn('id', $users)->get();
       return $users;
    }

   
    
 }