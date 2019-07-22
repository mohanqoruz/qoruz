<?php

namespace App\Roles\Traits;

// use App\Role\Exceptions\RoleDoesNotExist as RoleDoesNotExist;
use App\Roles\Models\Role;

trait HasRoles
{	
    
    /**
     * Get the all role owns the user
     *
     * @return  Roles $roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'q2_user_roles');
    }

   /**
    * Check the role contains or not the user
    *
    * @return bool
    */
    public function hasRole($role): bool
    {
      if (is_string($role)) {
          return $this->roles->contains('slug', $role);
       }
    }

   /**
    * Assign the role for user
    *
    * @return User $user
    */
    public function assignRole($role)
    {
        $roles = Role::where('slug', $role)->first();

        if( ! $roles ){
          // throw RoleDoesNotExist::create($role);
        }

        $this->roles()->attach($roles, ['account_id' => $this->account_id]);
        return $this;
   }

   /**
    * Remove the role for user
    *
    * @return void
    */
   public function removeRole($role)
   {
        $roles = Role::where('slug', $role)->first();

        if( ! $roles ){
          // throw RoleDoesNotExist::create($role);
        }

        $this->roles()->detach($roles);
  }
  
}