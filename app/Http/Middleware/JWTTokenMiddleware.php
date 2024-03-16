<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Enums\Messages;
use App\Traits\ApiResponseFormatTrait;

class JWTTokenMiddleware
{

    use ApiResponseFormatTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->JWTCustomResponse(Messages::INVALID_USER);
            }
        } catch (JWTException $e) {
            return $this->JWTCustomResponse($e->getMessage());
        }

        return $next($request);
    }
}
