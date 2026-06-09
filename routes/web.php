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

        Route::redirect('/tenant', '/tenants');

        Route::get('/tenants', [App\Http\Controllers\TenantController::class, 'indexView'])
            ->name('tenants.index');

        Route::get('/tenants/create', [App\Http\Controllers\TenantController::class, 'createView'])
            ->name('tenants.create');

        Route::post('/tenants', [App\Http\Controllers\TenantController::class, 'store'])
            ->name('tenants.store');

        Route::get('/tenants/{tenant}', [App\Http\Controllers\TenantController::class, 'showView'])
            ->name('tenants.show');

        Route::get('/tenants/{tenant}/edit', [App\Http\Controllers\TenantController::class, 'editView'])
            ->name('tenants.edit');

        Route::put('/tenants/{tenant}', [App\Http\Controllers\TenantController::class, 'update'])
            ->name('tenants.update');

        Route::delete('/tenants/{tenant}', [App\Http\Controllers\TenantController::class, 'destroy'])
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



        Route::get('/room-tenant', [App\Http\Controllers\RoomTenantController::class, 'indexView'])
            ->name('room-tenants.index');

        Route::get('/room-tenant/create', [App\Http\Controllers\RoomTenantController::class, 'createView'])
            ->name('room-tenants.create');

        Route::post('/room-tenant', [App\Http\Controllers\RoomTenantController::class, 'store'])
            ->name('room-tenants.store');

        Route::get('/room-tenant/{roomTenant}/edit', [App\Http\Controllers\RoomTenantController::class, 'editView'])
            ->name('room-tenants.edit');

        Route::put('/room-tenant/{roomTenant}', [App\Http\Controllers\RoomTenantController::class, 'update'])
            ->name('room-tenants.update');

        Route::delete('/room-tenant/{roomTenant}', [App\Http\Controllers\RoomTenantController::class, 'destroy'])
            ->name('room-tenants.destroy');



        Route::get('/bill', [App\Http\Controllers\BillController::class, 'indexView'])
            ->name('bills.index');

        Route::get('/room-bill/create', [App\Http\Controllers\BillController::class, 'createView'])
            ->name('bills.create');

        Route::post('/room-bill', [App\Http\Controllers\BillController::class, 'store'])
            ->name('bills.store');

        Route::get('/room-bill/{bill}/edit', [App\Http\Controllers\BillController::class, 'editView'])
            ->name('bills.edit');

        Route::put('/room-bill/{bill}', [App\Http\Controllers\BillController::class, 'update'])
            ->name('bills.update');

        Route::delete('/room-bill/{bill}', [App\Http\Controllers\BillController::class, 'destroy'])
            ->name('bills.destroy');

        
    
        Route::view('/payment', 'admin.payment.index')
            ->name('payment');

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

Route::redirect('/tenants', '/admin/tenants');

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