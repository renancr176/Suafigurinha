<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AlbumOrderRequest;
use App\Album;
use App\AlbumOrder;
use App\Services\SendEmailToStaffService;
use App\Enums\BookbindingTypeEnum;
use App\Mail\SendMailFaild;
use App\Mail\AlbumOrderCreationFailed;
use App\Mail\AlbumOrderCreatedClientOrientation;
use Exception;

class AlbumOrderController extends Controller
{
    private $sendEmailToStaffService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(SendEmailToStaffService $sendEmailToStaffService)
    {
        $this->sendEmailToStaffService = $sendEmailToStaffService;
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
        $album = Album::where('id', $request->album_id)->firstOrFail();

        if ($album->have_bookbinding_options && $request->bookbinding_type_id == null)
        {
            $this->SendEmailToStaff(new SendMailFaild([
                'Erro ao receber a requisição de criação de pedido após o pedido de compra.',
                'Tipo de encardenação não informado.',
                $request->all()
            ], 'Erro no cadastro de pedido'));

            return response("bookbinding_type_id is required.", 400);
        }

        if(!array_key_exists('client_email', $request->all()))
        {
            $message = 'Erro ao receber a requisição de criação de pedido após o pedido de compra, o e-mail do cliente não foi informado.';

            $mail = new AlbumOrderCreationFailed($message, $request->all());

            if (!$this->sendEmailToStaffService->send($mail))
            {
                $this->sendEmailToStaffService->send(
                    new SendMailFaild([
                    'Não há nenhum emails ativo cadastrado na tabela staff_emails.',
                    $message,
                    $request->all()
                    ], 'Erro no cadastro de pedido')
                );
            }

            return response(null, 400);
        }

        $transactionId = Uuid::uuid1()->toString();

        if(array_key_exists('transaction_id', $request->all()))
            $transactionId = $request->transaction_id;

        $order = AlbumOrder::create([
            'transaction_id' => $transactionId,
            'album_id' => $request->album_id,
            'bookbinding_type_id' => (($album->have_bookbinding_options)? $request->bookbinding_type_id:BookbindingTypeEnum::SaddleStitching)
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
                $this->sendEmailToStaffService->send(new SendMailFaild([
                    'Falha ao enviar o e-mail de orientação ao cliente após receber o pedido de compra.',
                    "E-mail do cliente: $request->client_email",
                    "Código de integração: $transactionId",
                    $request->all()
                ], 'Falha ao enviar o e-mail de orientação ao cliente'));
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
