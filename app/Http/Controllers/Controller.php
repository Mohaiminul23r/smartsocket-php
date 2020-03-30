<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getMessage(\Exception $e, $msg = null){
    	
        if(env('APP_ENV') == 'local'){
            return $e->getLine().': '.$e->getFile().' '.$e->getMessage();
        }else{
            return is_null($msg) ? 'Oops, operation failed please try again' : $msg;
        }
    }

    public function sendJson($statusCode = 200, $success = true, $code = 'A01', $payload = 'Successfull!', $type = 'success', $fade = false)
    {
        return response()->json([
                                    'success' => $success,
                                    'code'    => $code,
                                    'payload' => $payload,
                                    'type'    => $type,
                                    'fade'    => $fade 
                                ], $statusCode);
    }

    public function encrypt_aes256($clear_text, $key, $iv) {
        $iv = str_pad($iv, 16, "\0");
        $encrypt_text = openssl_encrypt($clear_text, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $data = base64_encode($encrypt_text);
        return $data;
    }
    public function decrypt_aes256($data, $key, $iv) {
        $iv = str_pad($iv, 16, "\0");
        $encrypt_text = base64_decode($data);
        $clear_text = openssl_decrypt($encrypt_text, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        return $clear_text;
    }

}
