<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSend extends Mailable
{
    use Queueable, SerializesModels;
   
   public $data, $user;

    public function __construct($data, $user)
    {     
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->subject($this->data->asunto)                
                    ->markdown('mails.sendMessage');
    }
}
