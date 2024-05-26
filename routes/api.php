<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IPController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

# All Authentication Routes
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    route::post('/register', [AuthController::class, 'storeUser']);
});

# All services api routes
Route::group(['middleware' => ['ip-whitelist','api','jwt-verify'],'prefix' => 'v1'], function ($router) {

    Route::apiResource('roles', RoleController::class);
    Route::apiResource('ips', IPController::class);
    
});