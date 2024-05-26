<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\LoginResource;
use App\Traits\ApiResponseFormatTrait;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    use ApiResponseFormatTrait;

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();
            if (!$token = auth()->attempt($credentials)) {
                return $this->unauthorizedResponse();
            }
            return new LoginResource($token);
        } catch (QueryException $queryException) {
            return $this->queryExceptionResponse($queryException);
        } catch (Exception $exception) {
            $this->recordException($exception);
            return $this->serverErrorResponse($exception);
        }
    }

    public function storeUser(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return (new UserResource($user))->additional($this->preparedResponse('store'));
        } catch (QueryException $queryException) {
            return $this->queryExceptionResponse($queryException);
        }
    }
}
