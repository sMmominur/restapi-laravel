<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;
use App\Enums\ApiStatus;
use App\Enums\Messages;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class APIResponse
{
    private const DEFAULT_ERROR_STATUS = ApiStatus::ERROR;

    private static $errorMessages = [
        Response::HTTP_NOT_FOUND => Messages::RESOURCE_NOT_FOUND,
        Response::HTTP_METHOD_NOT_ALLOWED => Messages::METHOD_NOT_ALLOWED_MSG,
        Response::HTTP_INTERNAL_SERVER_ERROR => Messages::INTERNAL_SERVER_ERROR_MESSAGE,
        Response::HTTP_NOT_ACCEPTABLE => Messages::NOT_ACCEPTABLE_MSG,
        Response::HTTP_TOO_MANY_REQUESTS => Messages::TOO_MANY_ATTEMPT,
    ];

    /**
     * Convert the default Laravel web response to a formatted API response.
     * Handles HTTP error status codes such as 404, 405, 406, 500, 429, etc.
     * 
     */
    private static function prepareErrorResponse(int $statusCode): JsonResponse
    {
        $message = self::$errorMessages[$statusCode] ?? 'Unknown Error';

        $response = [
            'response' => [
                'status'      => self::DEFAULT_ERROR_STATUS,
                'status_code' => $statusCode,
                'error'       => [
                    'message'   => $message,
                    'timestamp' => Carbon::now(),
                ],
            ]
        ];

        return new JsonResponse($response, $statusCode);
    }

    /**
     * Show an error response for the given HTTP status code and message.
     *
     */
    public static function showErrorResponse(int $statusCode): JsonResponse
    {
        return self::prepareErrorResponse($statusCode);
    }
}
