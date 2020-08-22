<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarCampanaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $url_imagen, $tipo;
    
    public function __construct($data, $url_imagen, $tipo)
    {
        $this->data = $data;
        $this->url_imagen = $url_imagen;
        $this->tipo = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      //return $this->subject($this->request->asunto)->markdown('mails.enviarCampana');
        return $this->subject($this->data->asunto)->view('mails.enviarCampana')->attach($this->url_imagen);
    }
}
