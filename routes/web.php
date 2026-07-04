<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTenantController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::view('/', 'welcome');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('auth')
    ->middleware('guest')
    ->group(function () {

        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login']);

        Route::get('/register', [AuthController::class, 'showRegister'])
            ->name('register');

        Route::post('/register', [AuthController::class, 'register'])
            ->name('register.post');

        Route::view('/forgot-password', 'auth.forgot-password')
            ->name('password.request');

        Route::view('/reset-password', 'auth.reset-password')
            ->name('password.reset');

        Route::view('/verify-email', 'auth.verify-email')
            ->name('verification.notice');
    });

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::redirect('/tenant', '/admin/tenants');

        /*
        |--------------------------------------------------------------------------
        | Tenant
        |--------------------------------------------------------------------------
        */

        Route::get('/tenants', [TenantController::class, 'indexView'])->name('tenants.index');
        Route::get('/tenants/create', [TenantController::class, 'createView'])->name('tenants.create');
        Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
        Route::get('/tenants/{tenant}/edit', [TenantController::class, 'editView'])->name('tenants.edit');
        Route::put('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
        Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');

        /*
        |--------------------------------------------------------------------------
        | Room
        |--------------------------------------------------------------------------
        */

        Route::get('/rooms', [RoomController::class, 'indexView'])->name('rooms.index');
        Route::get('/rooms/create', [RoomController::class, 'createView'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'editView'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

        /*
        |--------------------------------------------------------------------------
        | Room Tenant
        |--------------------------------------------------------------------------
        */

        Route::get('/room-tenant', [RoomTenantController::class, 'indexView'])->name('room-tenants.index');
        Route::get('/room-tenant/create', [RoomTenantController::class, 'createView'])->name('room-tenants.create');
        Route::post('/room-tenant', [RoomTenantController::class, 'store'])->name('room-tenants.store');
        Route::get('/room-tenant/{roomTenant}/edit', [RoomTenantController::class, 'editView'])->name('room-tenants.edit');
        Route::put('/room-tenant/{roomTenant}', [RoomTenantController::class, 'update'])->name('room-tenants.update');
        Route::delete('/room-tenant/{roomTenant}', [RoomTenantController::class, 'destroy'])->name('room-tenants.destroy');

        /*
        |--------------------------------------------------------------------------
        | Bills
        |--------------------------------------------------------------------------
        */

        Route::get('/bill', [BillController::class, 'indexView'])->name('bills.index');
        Route::get('/room-bill/create', [BillController::class, 'createView'])->name('bills.create');
        Route::post('/room-bill', [BillController::class, 'store'])->name('bills.store');
        Route::get('/room-bill/{bill}/edit', [BillController::class, 'editView'])->name('bills.edit');
        Route::put('/room-bill/{bill}', [BillController::class, 'update'])->name('bills.update');
        Route::delete('/room-bill/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');

        /*
        |--------------------------------------------------------------------------
        | Payments
        |--------------------------------------------------------------------------
        */

        Route::get('/payments', [PaymentController::class, 'indexView'])->name('payments.index');
        Route::get('/payments/create', [PaymentController::class, 'createView'])->name('payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/payments/{id}/edit', [PaymentController::class, 'editView'])->name('payments.edit');
        Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
        Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

        /*
        |--------------------------------------------------------------------------
        | Report & Activity
        |--------------------------------------------------------------------------
        */

        Route::view('/report', 'admin.report.index')->name('report');

        Route::get('/activity-log', [ActivityLogController::class, 'indexView'])->name('activity-log');
        Route::get('/activity-log/{activity_log}', [ActivityLogController::class, 'showView'])->name('activity-logs.show');

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        Route::get('/user', [UserController::class, 'indexView'])->name('user.index');
        Route::view('/user/create', 'admin.user.create')->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{user}/edit', [UserController::class, 'editView'])->name('user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::view('/profile/change-password', 'admin.profile.change-password')->name('profile.change-password');

        Route::view('/settings', 'admin.settings.index')->name('settings');
    });

/*
|--------------------------------------------------------------------------
| Tenant
|--------------------------------------------------------------------------
*/

Route::prefix('tenant')
    ->middleware(['auth', 'role:tenant'])
    ->name('tenant.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('tenant.dashboard.index');
        })->name('dashboard');

        Route::get('/rooms', [RoomController::class, 'tenantIndex'])->name('rooms.index');
        Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

        Route::get('/billing', fn() => view('tenant.billing.index'))->name('billing.index');
        Route::get('/billing/{id}', fn() => view('tenant.billing.show'))->name('billing.show');

        Route::get('/payment/create', fn() => view('tenant.payment.create'))->name('payment.create');
        Route::get('/payment/history', fn() => view('tenant.payment.history'))->name('payment.history');
        Route::get('/payment/{id}', fn() => view('tenant.payment.show'))->name('payment.show');

        Route::get('/announcement', fn() => view('tenant.announcement.index'))->name('announcement.index');
        Route::get('/announcement/{id}', fn() => view('tenant.announcement.show'))->name('announcement.show');

        Route::get('/profile', fn() => view('tenant.profile.index'))->name('profile.index');
    });