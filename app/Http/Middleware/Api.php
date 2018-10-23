<?php

namespace App\Http\Middleware;

use Closure;

class Api
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
        if($request->request->has('token') && $request->request->get('token')) {
            $tokenUser = \App\User::where('api_token', $request->request->get('token'))->first();

            if($tokenUser) {
                return $next($request);
//                return $tokenUser;
            } else {
                return \GuzzleHttp\json_encode(['status' => 400, 'message' => 'Token is Invalid']);
            }
        } else {
            return \GuzzleHttp\json_encode(['status' => 400, 'message' => 'API token is missing']);
        }

        return $next($request);
    }
}
