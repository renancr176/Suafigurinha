<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AlbumOrderRequest;
use App\Album;
use App\AlbumOrder;
use App\Mail\SendMailFaild;
use App\Mail\AlbumOrderCreationFailed;
use App\Mail\AlbumOrderCreatedClientOrientation;
use Exception;

class AlbumOrderController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumOrderRequest $request)
    {
        Album::where('id', $request->album_id)->firstOrFail();

        if(!array_key_exists('client_email', $request->all()))
        {
            $message = 'Erro ao receber a requisição de criação de pedido após o pedido de compra, o e-mail do cliente não foi informado.';

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
                    Mail::to($email)->send(new AlbumOrderCreationFailed($message, $request->all()));
                }
            }
            else
            {
                Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
                ->send(new SendMailFaild([
                    'Não está configurado o parâmetro ALBUM_MAIL_TEAM no arquivo .env ou não há emails definido para esta chave.',
                    $message,
                    $request->all()
                ]));
            }

            return response(null, 400);
        }

        $transactionId = Uuid::uuid1()->toString();

        if(array_key_exists('transaction_id', $request->all()))
            $transactionId = $request->transaction_id;

        $order = AlbumOrder::create([
            'transaction_id' => $transactionId,
            'album_id' => $request->album_id
        ]);

        try
        {
            Mail::to($request->client_email)
            ->send(new AlbumOrderCreatedClientOrientation($order));
        }
        catch (Exception $e)
        {
            if(count(Mail::failures()) > 0)
            {
                Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
                ->send(new SendMailFaild([
                    'Falha ao enviar o e-mail de orientação ao cliente após receber o pedido de compra.',
                    "E-mail do cliente: $request->client_email",
                    "Código de integração: $transactionId",
                    $request->all()
                ]));
            }

            return response(null, 400);
        }

        return ['transaction_id' => $transactionId];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
