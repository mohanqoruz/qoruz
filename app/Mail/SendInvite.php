<?php

namespace App\Mail;

use App\Users\Models\UserInvite; 
use App\Users\Models\User; 

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
    public function __construct(UserInvite $invite)
    {
        $this->invite = $invite;
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
            'user' => User::find($this->invite->inviter_id)
        ]);
    }
}
