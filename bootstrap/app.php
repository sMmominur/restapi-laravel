<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use App\Http\Middleware\IPAuthorizationMiddleware;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
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

        # Handles cases where a requested resource is not found.
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::showErrorResponse(Response::HTTP_NOT_FOUND);
            }
        });

        # Handles instances where the request method is not allowed for the specified route.
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::showErrorResponse(Response::HTTP_METHOD_NOT_ALLOWED);
            }
        });

        # Catches general HTTP-related exceptions
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::showErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        # Captures exceptions related to database queries
        $exceptions->render(function (QueryException $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::showErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        # Custom handling for NotAcceptableHttpException rendering.
        $exceptions->render(function (NotAcceptableHttpException  $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::showErrorResponse(Response::HTTP_NOT_ACCEPTABLE);
            }
        });

        # Customizes the rendering of TooManyRequestsHttpException.
        $exceptions->render(function (TooManyRequestsHttpException  $e, Request $request) {
            if ($request->is('api/*')) {
                return APIResponse::showErrorResponse(Response::HTTP_TOO_MANY_REQUESTS);
            }
        });
    })->create();
