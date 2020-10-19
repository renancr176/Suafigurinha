<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SendEmailToStaffService;
use App\Services\WixWebHookService;
use App\Mail\NewWixOrderReceived;

class WixOrderWebHooksController extends Controller
{
    private $sendEmailToStaffService;
    private $wixWebHookService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(SendEmailToStaffService $sendEmailToStaffService, WixWebHookService $wixWebHookService)
    {
        $this->sendEmailToStaffService = $sendEmailToStaffService;
        $this->wixWebHookService = $wixWebHookService;
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
    public function store(Request $request)
    {
        $header = (array) $request->header();
        $body = (array) $request->all();
        $data = json_encode([
            'header'=>$header,
            'body'=>$body,
            'validRequest'=>$this->wixWebHookService()->isValidRequest($request)
        ]);
        return $this->sendEmailToStaffService->send(new NewWixOrderReceived($data));
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
