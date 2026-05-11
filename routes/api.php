<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTenantController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('users', UserController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('tenants', TenantController::class);
Route::apiResource('room-tenants', RoomTenantController::class);
Route::apiResource('bills', BillController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('activity-logs', ActivityLogController::class)->only(['index', 'store']);