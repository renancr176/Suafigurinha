<?php

namespace App\Services;

use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class WixWebHookService
{
    /**
     * Validate Wix request.
     *
     * @param  Request $request
     * @return boolean
     */
    public function isValidRequest(Request $request)
    {
        if($request->hasHeader(env('WIX_REQUEST_HEADER_TOKEN_KEY', 'digest')))
        {
            $token = $request->header(env('WIX_REQUEST_HEADER_TOKEN_KEY', 'digest'));
            if(count(explode($token, '.')) == 3)
            {
                $signer = new Sha256();
                $publicKey = new Key(env('WIX_JWT_PUBLIC_KEY'));

                $token = (new Parser())->parse((string) $token);

                return $token->verify($signer, $publicKey);
            }
        }

        return false;
    }
}
