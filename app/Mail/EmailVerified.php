<?php

namespace App\Mail;

use App\Users\Models\User as User; 
use Illuminate\Support\Facades\URL;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerified extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url =  URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60 * 24), ['id' => $this->user->id]
        );

        return $this->view('emails.verify')->with([
            'url' => $url
        ]);
    }
}
