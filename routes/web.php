<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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