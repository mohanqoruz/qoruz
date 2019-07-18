<?php

namespace App\Mail;

use App\Users\Models\UserInvite; 

use Illuminate\Support\Facades\URL;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserInvite $invite, $user)
    {
        $this->invite = $invite;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $url = URL::temporarySignedRoute(
            'accept.invite', now()->addMinutes( 24 * 60 ), [
            'token' => $this->invite->token
            ]);

        return $this->markdown('emails.invite',[
            'url' => $url,
            'invite'=> $this->invite,
            'user' => $this->user
        ]);
    }    
}
