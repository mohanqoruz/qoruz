<?php

namespace App\Accounts\Traits;

trait Accountable {
   
    /**
     * Get the all user owns the account
     *
     * @return  Account $account
     */
    public function account()
    {
       return $this->belongsTo('App\Accounts\Models\Account');
    } 

    /**
     * Checking weather this account is trail or not
     *
     * @return  bool
     */
    public function isTrailAccount() : bool
    {
      	return $this->account->status == 'trialing';
    } 

    /**
     * Checking weather this account is active or not
     *
     * @return  bool
     */
    public function isActiveAccount() : bool
    {
      	return $this->account->status == 'active';
    }  

    /**
     * Checking weather this account is suspended or not
     *
     * @return  bool
     */
    public function isAccountSuspended() : bool
    {
      	return $this->account->status == 'suspended';
    } 
} 