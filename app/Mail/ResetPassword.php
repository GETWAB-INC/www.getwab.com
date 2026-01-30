<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $url;

    public function __construct(User $user, string $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function build()
    {
        return $this
            ->subject('Reset Password Notification')
            ->view('emails.reset-password')
            ->with([
                'notifiable' => $this->user,
                'url' => $this->url,
            ]);
    }
}
