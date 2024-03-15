<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('roles', \App\Http\Controllers\RoleController::class);
Route::apiResource('ips', \App\Http\Controllers\IPController::class);
