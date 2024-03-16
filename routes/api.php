<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IPController;


Route::group(['middleware' => ['ipwhitelist','api'],'prefix' => 'v1'], function ($router) {

    Route::apiResource('roles', RoleController::class);
    Route::apiResource('ips', IPController::class);
    
});