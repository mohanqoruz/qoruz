<?php

namespace App\Users\Models;

use App\Plan\Traits\Plannable;
use App\Roles\Traits\HasRoles;
use App\Accounts\Traits\Accountable;
use Laravel\Passport\HasApiTokens;
use App\Sharables\Traits\IsSharable;

use App\Notifications\VerifyEmailNotification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\ShareNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasRoles, Accountable, Plannable,IsSharable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

     /**
     * Get the user's  name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }    

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

     /**
     * Send the plan/report shared notification.
     *
     * @param  string  
     * @return void
     */
    public function sendShareNotification()
    {
        $this->notify(new ShareNotification);
    }
}


