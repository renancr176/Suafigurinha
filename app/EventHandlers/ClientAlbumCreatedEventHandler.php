<?php

namespace App\EventHandlers;

use App\Events\ClientAlbumCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailFaild;
use App\Mail\AlbumCreatedByClient;
use App\Mail\AlbumCreatedClientConfirmation;

class ClientAlbumCreatedEventHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClientAlbumCreatedEvent  $event
     * @return void
     */
    public function handle(ClientAlbumCreatedEvent $event)
    {
        $emails = array_filter(array_map(function($value){
            if(filter_var($value, FILTER_VALIDATE_EMAIL))
                return $value;

            return null;
        },
        explode(';', env('STAFF_EMAILS'))));

        if (count($emails) > 0)
        {
            foreach ($emails as $email)
            {
                Mail::to($email)->send(new AlbumCreatedByClient($event->order));
            }

            $event->order->update([
                'album_email_sent' => true
            ]);
        }
        else
        {
            Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
            ->send(new SendMailFaild(['Não está configurado o parâmetro STAFF_EMAILS no arquivo .env ou não há emails definido para esta chave.']));
        }

        Mail::to($event->order->client()->first()->email)
        ->send(new AlbumCreatedClientConfirmation($event->order));

        $event->order->update([
            'confirmation_email_sent' => true
        ]);
    }
}
