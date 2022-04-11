<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $envia,$subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */    
    public function __construct($envia,$subject)
    {
        $this->envia=$envia;
        $this->subject=$subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->envia)
        ->subject($this->subject)
        ->view('mail.EnviaCorreo');
    }
}
