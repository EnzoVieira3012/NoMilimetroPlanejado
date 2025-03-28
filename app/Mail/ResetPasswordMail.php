<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo; // Código para redefinição de senha

    /**
     * Cria uma nova instância do e-mail.
     */
    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Constrói o e-mail.
     */
    public function build()
    {
        return $this->subject('Seu Código de Redefinição de Senha')
                    ->view('emails.reset-password')
                    ->with(['codigo' => $this->codigo]);
    }
}
