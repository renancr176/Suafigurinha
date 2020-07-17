<?php

namespace App\EventHandlers;

use App\Events\AlbumCreatedByClientEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailFaild;
use App\Mail\AlbumCreatedByClient;
use App\Mail\AlbumCreatedClientConfirmation;

class AlbumCreatedByClientEventHandler implements ShouldQueue
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
     * @param  AlbumCreatedByClientEvent  $event
     * @return void
     */
    public function handle(AlbumCreatedByClientEvent $event)
    {
        $emails = array_filter(array_map(function($value){
            if(filter_var($value, FILTER_VALIDATE_EMAIL))
                return $value;

            return null;
        },
        explode(';', env('ALBUM_MAIL_TEAM'))));

        if (count($emails) > 0)
        {
            foreach ($emails as $email)
            {
                Mail::to($email)->send(new AlbumCreatedByClient($event->order));
            }
        }
        else
        {
            Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
            ->send(new SendMailFaild(['Não está configurado o parâmetro ALBUM_MAIL_TEAM no arquivo .env ou não há emails definido para esta chave.']));
        }

        Mail::to($event->order->client()->first()->email)
        ->send(new AlbumCreatedClientConfirmation($event->order));
    }
}
