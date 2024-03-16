<?php

namespace App\Traits;

use App\Enums\ApiStatus;
use App\Enums\Messages;
use App\Enums\MySQLError;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

trait ApiResponseFormatTrait
{
    private function jsonResponse($status, $statusCode, $message, $data = null)
    {
        $response = [
            'response' => [
                'status'      => $status,
                'status_code' => $statusCode,
                'message'     => $message,
            ]
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    private function validationFailedResponse($errorDetails = null)
    {
        $response = [
            'response' => [
                'status'      => ApiStatus::ERROR,
                'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'error'     => [
                    'message'   => Messages::VALIDATION_FAILED,
                    'timestamp' => Carbon::now(),
                ],
            ]
        ];
        if ($errorDetails !== null) {
            $response['response']['error']['details'] = $errorDetails;
        }
        return $response;
    }

    private function errorResponse($status, $statusCode, $message, $errorDetails = null)
    {
        $response = [
            'response' => [
                'status'      => $status,
                'status_code' => $statusCode,
                'error'     => [
                    'message'   => $message,
                    'timestamp' => Carbon::now(),
                ],
            ]
        ];
        if ($errorDetails !== null) {
            $response['response']['error']['details'] = $errorDetails;
        }
        return $response;
    }


    private function recordNotFoundResponse($exception)
    {
        return $this->errorResponse(ApiStatus::ERROR, Response::HTTP_NOT_FOUND, Messages::NO_QUERY_RESULTS, 'Record id ' . $exception->getIds()[0] . ' is invalid');
    }

    private function serverErrorResponse()
    {
        return $this->errorResponse(ApiStatus::ERROR, Response::HTTP_INTERNAL_SERVER_ERROR, Messages::INTERNAL_SERVER_ERROR_MESSAGE);
    }

    private function invalidIdDataTypeResponse()
    {
        return $this->errorResponse(ApiStatus::ERROR, Response::HTTP_BAD_REQUEST, Messages::NON_NUMERIC_ID, 'Please provide a numeric id');
    }

    private function queryExceptionResponse($exception)
    {
        $errorCode = $exception->errorInfo[1];
        if ($errorCode == MySQLError::ER_DUP_ENTRY) {
            return $this->jsonResponse(ApiStatus::ERROR, Response::HTTP_INTERNAL_SERVER_ERROR, $exception->errorInfo[2]);
        }
    }

    private function forbiddenAccessResponse()
    {
        return $this->errorResponse(ApiStatus::ERROR, Response::HTTP_FORBIDDEN, Messages::FORBIDDEN);
    }

    private function unauthorizedResponse()
    {
        return $this->errorResponse(ApiStatus::ERROR, Response::HTTP_UNAUTHORIZED, Messages::UNAUTHORIZED);
    }

    private function logoutResponse()
    {
        return $this->jsonResponse(ApiStatus::SUCCESS, Response::HTTP_OK, Messages::LOGGED_OUT_SUCCESSFULLY);
    }

    private function preparedResponse($actionName)
    {
        $actions = [
            'index'   => [ApiStatus::SUCCESS, Response::HTTP_OK, Messages::RETRIEVED_SUCCESSFULLY],
            'store'   => [ApiStatus::SUCCESS, Response::HTTP_CREATED, Messages::CREATED_SUCCESSFULLY],
            'show'    => [ApiStatus::SUCCESS, Response::HTTP_OK, Messages::FETCHED_SUCCESSFULLY],
            'update'  => [ApiStatus::SUCCESS, Response::HTTP_OK, Messages::UPDATED_SUCCESSFULLY],
            'destroy' => [ApiStatus::SUCCESS, Response::HTTP_OK, Messages::TRASHED_SUCCESSFULLY]
        ];

        if (array_key_exists($actionName, $actions)) {
            return [
                'response' => [
                    'status'      => $actions[$actionName][0],
                    'status_code' => $actions[$actionName][1],
                    'message'     => $actions[$actionName][2]
                ]
            ];
        }
    }

    private function recordException($e)
    {
        Log::error($e->getMessage() . ' in file ' . $e->getFile() . ' at line ' . $e->getLine());
    }

    private function JWTCustomResponse($message)
    {
        $response = [
            'response' => [
                'status'      => ApiStatus::ERROR,
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error'     => [
                    'message'   => $message,
                    'timestamp' => Carbon::now(),
                ],
            ]
        ];

        return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
