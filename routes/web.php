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

        Route::view('/tenant', 'admin.tenant.index')
            ->name('tenant');

        Route::view('/room', 'admin.room.index')
            ->name('room');

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
            ->name('user');

        Route::view('/user/create', 'admin.user.create')
            ->name('user.create');

        Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'editView'])
            ->name('user.edit');

        Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])
            ->name('user.store');

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