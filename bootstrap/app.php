<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IPAuthorizationMiddleware;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

use App\Utils\APIResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('ip-whitelist', [IPAuthorizationMiddleware::class,]);
        $middleware->appendToGroup('jwt-verify', [JWTTokenMiddleware::class,]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Overwrite the default behavior of NotFoundHttpException for API requests
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::notFound();
            }
        });

        // Overwrite the default behavior of MethodNotAllowedHttpException for API requests
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::methodNotAllowed($request);
            }
        });

        // Overwrite the default behavior of Internal Server Error for API requests
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::internalServerError();
            }
        });

    })->create();
