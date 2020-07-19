<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class AlbumOrderCreationFailed extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $inputs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $message, array $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->message;
        $inputs = $this->inputs;

        return $this->subject('Falha ao tentar registrar novo pedido de album.')
        ->view('mail.album-order-creation-failed', compact('message', 'inputs'));
    }
}
