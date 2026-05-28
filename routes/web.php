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