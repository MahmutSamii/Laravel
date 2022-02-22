<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TestMail extends Mailable
{


    use Queueable, SerializesModels;

    public $usermail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usermail)
    {
       $this->usermail = $usermail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('back.auth.email');
    }
}
