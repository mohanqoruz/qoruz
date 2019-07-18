<?php
namespace App\Notifications;

use App\Mail\EmailVerified as Mailable;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;

class VerifyEmailNotification extends VerifyEmailBase
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new Mailable($notifiable))->to($notifiable->email);
    }
}