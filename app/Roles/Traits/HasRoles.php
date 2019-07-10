<?php

namespace App\Roles\Traits;

trait HasRoles
{	
    
    /**
     * Get the all role owns the user
     *
     * @return  Roles $roles
     */
    public function roles()
    {
       return $this->belongsToMany(Role::class, 'user_roles');
    }


   /**
    * Check the role contains or not the user
    *
    * @return bool
    */
    public function hasRole($role): bool
    {
      if (is_string($role)) {
            return $this->roles->contains('name', $role);
       }
    }

   /**
    * Assign the role for user
    *
    * @return User $user
    */
    public function assignRole($role)
    {
        $roles = Role::where('name', $role)->first();

        if( ! $roles ){
          // throw RoleDoesNotExist::create($role);
        }

        $this->roles()->attach($roles);
        return $this;
   }

   /**
    * Remove the role for user
    *
    * @return void
    */
   public function removeRole($role)
   {
        $roles = Role::where('name', $role)->first();

        if( ! $roles ){
          // throw RoleDoesNotExist::create($role);
        }

        $this->roles()->detach($roles);
  }

	/**
	 * Checks if User has access to $permissions.
	*/
	public function hasAccess(array $permissions) : bool
	{
	      // check if the permission is available in any role
	      foreach ($this->roles as $role) {
	          if($role->hasAccess($permissions)) {
	              return true;
	          }
	      }
	      return false;
	}	
}