<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;
use App\Enums\ApiStatus;
use App\Enums\Messages;
use Carbon\Carbon;

class APIResponse
{
    private static function prepareResponseFormat($status, $statusCode, $message)
    {
        $response = [
            'response' => [
                'status'      => $status,
                'status_code' => $statusCode,
                'error'       => [
                    'message'   => $message,
                    'timestamp' => Carbon::now(),
                ],
            ]
        ];

        return response()->json($response, $statusCode);
    }

    public static function showNotFoundResponse()
    {
        return self::prepareResponseFormat(ApiStatus::ERROR, Response::HTTP_NOT_FOUND, Messages::RESOURCE_NOT_FOUND);
    }

    public static function showMethodNotAllowedResponse()
    {
        return self::prepareResponseFormat(ApiStatus::ERROR, Response::HTTP_METHOD_NOT_ALLOWED, Messages::METHOD_NOT_ALLOWED_MSG);
    }

    public static function showInternalServerErrorResponse()
    {
        return self::prepareResponseFormat(ApiStatus::ERROR, Response::HTTP_INTERNAL_SERVER_ERROR, Messages::INTERNAL_SERVER_ERROR_MESSAGE);
    }

    public static function showQueryExceptionResponse()
    {
        return self::prepareResponseFormat(ApiStatus::ERROR, Response::HTTP_INTERNAL_SERVER_ERROR, "Database query error");
    }
}
