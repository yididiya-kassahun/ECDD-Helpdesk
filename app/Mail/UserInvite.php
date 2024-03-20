<?php

namespace App\Mail;

use App\Option;
use Illuminate\Mail\Mailable;

class UserInvite extends Mailable
{
    /**
     * User to whom invitation is sent.
     */
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
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
        \MailHelper::prepareMailable($this);
        
        $message = $this->subject(__('Welcome to :company_name!', ['company_name' => Option::getCompanyName()]))
                    ->view('emails/user/user_invite')
                    ->text('emails/user/user_invite_text');

        return $message;
    }
}
