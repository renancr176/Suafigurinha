<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\AlbumOrder;

class AlbumOrderCreatedClientOrientation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AlbumOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $album = $this->order->album()->first();

        return $this->subject('Sua Figurinha - Informações para criação do album.')
        ->view('mail.album-order-created-client-orientation', compact('order', 'album'));
    }
}
