<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::prefix('auth')->group(function () {

    Route::view('/login', 'auth.login')
        ->name('login');

    Route::view('/register', 'auth.register')
        ->name('register');

    Route::view('/forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Route::view('/reset-password', 'auth.reset-password')
        ->name('password.reset');

    Route::view('/verify-email', 'auth.verify-email')
        ->name('verification.notice');

});

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard.index')
            ->name('dashboard');



        Route::get('/tenant', [App\Http\Controllers\TenantController::class, 'indexView'])
            ->name('tenants.index');

        Route::get('/tenant/create', [App\Http\Controllers\TenantController::class, 'createView'])
            ->name('tenants.create');

        Route::post('/tenant', [App\Http\Controllers\TenantController::class, 'store'])
            ->name('tenants.store');

        Route::get('/tenant/{tenant}', [App\Http\Controllers\TenantController::class, 'showView'])
            ->name('tenants.show');

        Route::get('/tenant/{tenant}/edit', [App\Http\Controllers\TenantController::class, 'editView'])
            ->name('tenants.edit');

        Route::put('/tenant/{tenant}', [App\Http\Controllers\TenantController::class, 'update'])
            ->name('tenants.update');

        Route::delete('/tenant/{tenant}', [App\Http\Controllers\TenantController::class, 'destroy'])
            ->name('tenants.destroy');



        Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'indexView'])
            ->name('rooms.index');

        Route::get('/rooms/create', [App\Http\Controllers\RoomController::class, 'createView'])
            ->name('rooms.create');

        Route::post('/rooms', [App\Http\Controllers\RoomController::class, 'store'])
            ->name('rooms.store');

        Route::get('/rooms/{room}', [App\Http\Controllers\RoomController::class, 'showView'])
            ->name('rooms.show');

        Route::get('/rooms/{room}/edit', [App\Http\Controllers\RoomController::class, 'editView'])
            ->name('rooms.edit');

        Route::put('/rooms/{room}', [App\Http\Controllers\RoomController::class, 'update'])
            ->name('rooms.update');

        Route::delete('/rooms/{room}', [App\Http\Controllers\RoomController::class, 'destroy'])
            ->name('rooms.destroy');



        Route::view('/room-tenant', 'admin.room-tenant.index')
            ->name('room-tenant');

        Route::view('/payment', 'admin.payment.index')
            ->name('payment');

        Route::view('/bill', 'admin.bill.index')
            ->name('bill');

        Route::view('/report', 'admin.report.index')
            ->name('report');

        Route::view('/activity-log', 'admin.activity-log.index')
            ->name('activity-log');



        Route::get('/user', [App\Http\Controllers\UserController::class, 'indexView'])
            ->name('user.index');

        Route::view('/user/create', 'admin.user.create')
            ->name('user.create');

        Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])
            ->name('user.store');

        Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])
            ->name('user.show');

        Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'editView'])
            ->name('user.edit');

        Route::put('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])
            ->name('user.update');

        Route::delete('/user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('user.destroy');



        Route::view('/settings', 'admin.settings.index')
            ->name('settings');

    });

Route::prefix('tenant')->name('tenant.')->group(function () {

    Route::view('/dashboard', 'tenant.dashboard.index')
        ->name('dashboard');

    Route::view('/room', 'tenant.room.index')
        ->name('room');

    Route::view('/room/detail', 'tenant.room.detail')
        ->name('room.detail');

    Route::view('/payment', 'tenant.payment.index')
        ->name('payment');

});