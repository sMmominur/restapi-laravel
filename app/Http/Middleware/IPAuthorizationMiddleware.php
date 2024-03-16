<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponseFormatTrait;
use App\Enums\ApiStatus;
use App\Enums\Messages;
use Carbon\Carbon;

class IPAuthorizationMiddleware
{
    use ApiResponseFormatTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // TODO: Allowed Ips will be fetch from database and cache the result
        $allowedIPs = ['127.0.0.1', '192.168.0.102','localhost'];

        if (!in_array($request->ip(), $allowedIPs)) {

            return response([
                'response' => [
                    'status'      => ApiStatus::ERROR,
                    'status_code' => Response::HTTP_UNAUTHORIZED,
                    'error'     => [
                        'message'   => Messages::UNAUTHORIZED_DOMAIN_OR_IP,
                        'timestamp' => Carbon::now(),
                    ],
                ]
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
