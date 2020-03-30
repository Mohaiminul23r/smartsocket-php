<?php

namespace App\Http\Middleware;

use Closure;
use SDLCrypt;

class SDLCryptMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(env('SDLCrypt_ENABLE', false) == true){
            $response = $next($request);
            $data = $response->getData();
            $responseCode = $response->status();            
            $data = SDLCrypt::encrypt(json_encode($data),env('SDLCrypt_KEY'));
            return response()->json($data,$responseCode);            
        }
        return $next($request);
    }
}
