<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\ApiStatus;
use App\Enums\Messages;
use Carbon\Carbon;

class APIResponse
{
    public static function notFound()
    {
        return response()->json([
            'response' => [
                'status' => ApiStatus::ERROR,
                'status_code' => Response::HTTP_NOT_FOUND,
                'error' => [
                    'message' => Messages::RESOURCE_NOT_FOUND,
                    'timestamp' => Carbon::now(),
                ],
            ],
        ], Response::HTTP_NOT_FOUND);
    }

    public static function methodNotAllowed(Request $request)
    {
        return response()->json([
            'response' => [
                'status' => ApiStatus::ERROR,
                'status_code' => Response::HTTP_METHOD_NOT_ALLOWED,
                'error' => [
                    'message' => "Method '{$request->method()}' is not allowed for this endpoint.",
                    'timestamp' => Carbon::now(),
                ],
            ],
        ], Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public static function internalServerError()
    {
        return response()->json([
            'response' => [
                'status' => ApiStatus::ERROR,
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => [
                    'message' => Messages::INTERNAL_SERVER_ERROR_MESSAGE,
                    'timestamp' => Carbon::now(),
                ],
            ],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public static function queryException()
    {
        return response()->json([
            'response' => [
                'status' => ApiStatus::ERROR,
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => [
                    'message' => "Database query error",
                    'timestamp' => Carbon::now(),
                ],
            ],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
