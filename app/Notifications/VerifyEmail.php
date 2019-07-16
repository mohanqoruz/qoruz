<?php
namespace App\Notifications;

use App\Mail\EmailVerified as Mailable;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;

class VerifyEmail extends VerifyEmailBase
{
    use Queueable;

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $temporarySignedURL = \URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );

        return $temporarySignedURL;
    }


    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new Mailable($notifiable))->to($notifiable->email);
    }
}