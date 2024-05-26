<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ResponseHandlerTrait
{
    use ResponseFormatterTrait;

    public function successResponse(array $data = [], string $message = 'Operation successful'): array
    {
        $responseDetails = [
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'data' => $data,
            'error' => null,
        ];

        return $this->formatResponse($responseDetails);
    }

    public function errorResponse(string $message, int $statusCode = 400, array $errorDetails = null): array
    {
        $responseDetails = [
            'status' => 'error',
            'status_code' => $statusCode,
            'message' => $message,
            'data' => null,
            'error' => $errorDetails,
        ];

        return $this->formatResponse($responseDetails);
    }

    public function validationFailedResponse(array $errorDetails = null): array
    {
        return $this->errorResponse('Validation failed', 422, $errorDetails);
    }
}
