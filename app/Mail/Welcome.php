<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;
    
    public $data;

    public function __construct($data)
    {
        $this->data = (object) $data;
    }

    public function build()
    {       
        return $this->view('mail.welcome')
                    ->from($this->data->email, $this->data->name)
                    ->replyTo($this->data->reply_to, $this->data->reply_to_name )
                    ->subject($this->data->subject)
                    ->with([ 'data' => $this->data ]);
    }
}
