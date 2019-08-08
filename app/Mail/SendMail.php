<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Fornecedor;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo, int $tipo)
    {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // E-mail de cadastramento
        if ($this->tipo == 1) {
            return $this->subject($this->titulo)
                ->with([
                    'cabecalho' => 'Usuário cadastrado com sucesso.',
                    'texto' => 'Prezado, recebemos seu pedido de registro como Fornecedor da nossa loja virtual. Assim que seu cadastro for aprovado você receberá um e-mail com token para acesso à API de serviços MultiTools.'
                ])
                ->markdown('emails.fornecedor-markdown');
        // E-mail de usuário bloqueado
        } elseif ($this->tipo == 2) {
            return $this->subject($this->titulo)
                ->with(['cabecalho' => 'Usuário bloqueado pelo Administrador.',
                'texto' => 'Prezado, seu usuário foi bloqueado pelo Administrador do Sistema.'])
                ->markdown('emails.fornecedor-markdown');
        // E-mail de usuário liberado
        } elseif ($this->tipo == 3) {
            return $this->subject($this->titulo)
                ->with(['cabecalho' => 'Usuário liberado pelo Administrador.',
                'texto' => 'Prezado, seu usuário foi liberado pelo Administrador do Sistema.'])
                ->markdown('emails.fornecedor-markdown');
         // E-mail de usuário removido
        } elseif ($this->tipo == 4) {
            return $this->subject($this->titulo)
                ->with(['cabecalho' => 'Usuário removido pelo Administrador.',
                'texto' => 'Prezado, seu usuário foi removido pelo Administrador do Sistema. Em caso de dúvidas, favor entrar em contato com nossa Central de Atendimento.'])
                ->markdown('emails.fornecedor-markdown');
        }
    }
}
