<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user_welcome_email')
            ->cc('hr@natuf.ps');
        // return $this->markdown('emails.user_welcome_email')
        //     ->from('info@natuf.com', 'Natuf Project');
        // return $this->markdown(
        //     'emails.user_welcome_email',
        //     ['user' => $this->user]
        // )->with('user', $this->user);
    }
}
