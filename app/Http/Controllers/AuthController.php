<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponseFormatTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
class AuthController extends Controller
{
    use ApiResponseFormatTrait;

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (!$token = auth()->attempt($credentials)) {
            return $this->unauthorizedResponse();
        }
        return new LoginResource($token);
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $item = User::create($request->all());
            return (new UserResource($item))->additional($this->preparedResponse('store'));
        } catch (QueryException $queryException) {
            return $this->queryExceptionResponse($queryException);
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->logoutResponse();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return new LoginResource(auth()->refresh());
    }
}
