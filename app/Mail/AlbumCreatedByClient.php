<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\AlbumOrder;
use App\Enums\AlbumOrderFileTypeEnum;
use App\Enums\BookbindingTypeEnum;

class AlbumCreatedByClient extends Mailable
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
        $bookbindingType = $this->order->bookbindingType()->first();
        $album = $this->order->album()->first();
        $client = $this->order->client()->first();
        $deliveryAddress = $this->order->deliveryAddress()->first();
        $texts = [];
        foreach ($this->order->texts()->get() as $textObj)
        {
            $text = [];

            $text['page'] = $textObj->albumPage()->first()->sequence;
            $text['original_text'] = $textObj->albumPageText()->first()->text;
            $text['client_text'] = $textObj->text;

            array_push($texts, $text);
        }
        $figureFiles = $order->files()
        ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Figure)
        ->get();
        $backgroundFiles = $order->files()
        ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Background)
        ->get();

        $isBookbindingByPasting = $bookbindingType->id == BookbindingTypeEnum::Pasting;

        $mail = $this->subject("Album criado pelo cliente - código do pedido $order->id")
            ->view('mail.album-created-by-client',
            compact('order', 'album', 'client', 'deliveryAddress', 'texts', 'figureFiles', 'backgroundFiles', 'bookbindingType', 'isBookbindingByPasting'));

        return $mail;
    }
}
