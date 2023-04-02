<?php

namespace App\Http\Middleware;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Carbon;
use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class TrustToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->hasParameter("token")) {
            $token = PersonalAccessToken::findToken($request->route()->token);
            if ($token && optional($token)->expires_at > now()) {

                return $next($request);

            }

        }
        return response()->json([['error'=>' ',"Message"=>"token non valide" ,'status'=>'failed']]);


    }
}
