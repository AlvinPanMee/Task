<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthApi
{
    public function handle (Request $request, Closure $next): Response
    {
        if (!$request->header('auth_token')) return api_error('Token required');
        
        $request_token = $request->header('auth_token');
        $auth_token = env('AUTH_TOKEN');

        try {
            Hash::check($auth_token, $request_token);
        } catch (Exception $e) {
            return api_error('Invalid Token');
        } 

        return $next($request);
    }
}