<?php

namespace App\Utils;

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
}
