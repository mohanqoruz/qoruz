<?php

namespace App\Mail;

use App\Users\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url =  \URL::temporarySignedRoute(
            'reset.password', now()->addMinutes(60 * 24), ['token' => $this->token]
        );

        return $this->markdown('emails.reset_password',[
            'url' => $url,
            'user' =>$this->user
        ]);
    }
}
