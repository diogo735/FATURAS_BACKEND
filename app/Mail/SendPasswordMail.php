<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $email;
    public $nome;

   public function __construct($password, $email, $nome)
    {
        $this->password = $password;
        $this->email = $email;
        $this->nome = $nome;
    }

    public function build()
    {
        return $this->subject('Novo dados de login !')
            ->view('emails.send-password')
            ->with([
                'password' => $this->password,
                'email' => $this->email,
                'nome' => $this->nome,
            ]);
    }
}
