<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $seeker;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seeker)
    {
        $this->seeker = $seeker;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from("noreply@fratres.net","Fratres")
            ->view('frontend.emails.test');

    }
}
