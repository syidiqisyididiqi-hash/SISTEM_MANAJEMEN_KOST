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

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (BISA DILIHAT TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Landing page
Route::view('/', 'welcome');

// Public tenant room (lihat kamar)
Route::get('/tenant/rooms', [RoomController::class, 'tenantIndex'])
    ->name('tenant.rooms.index');

Route::get('/tenant/rooms/{room}', [RoomController::class, 'show'])
    ->name('tenant.rooms.show');

// Public announcement
Route::get('/tenant/announcement', fn() => view('tenant.announcement.index'))
    ->name('tenant.announcement.index');

Route::get('/tenant/announcement/{id}', fn() => view('tenant.announcement.show'))
    ->name('tenant.announcement.show');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
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
    });

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN (HARUS LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Tenant management
        Route::get('/tenants', [TenantController::class, 'indexView'])->name('tenants.index');
        Route::get('/tenants/create', [TenantController::class, 'createView'])->name('tenants.create');
        Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
        Route::get('/tenants/{tenant}/edit', [TenantController::class, 'editView'])->name('tenants.edit');
        Route::put('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
        Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');

        // Rooms
        Route::get('/rooms', [RoomController::class, 'indexView'])->name('rooms.index');
        Route::get('/rooms/create', [RoomController::class, 'createView'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'editView'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

        // Payments
        Route::get('/payments', [PaymentController::class, 'indexView'])->name('payments.index');
        Route::get('/payments/create', [PaymentController::class, 'createView'])->name('payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/payments/{id}/edit', [PaymentController::class, 'editView'])->name('payments.edit');
        Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
        Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });


/*
|--------------------------------------------------------------------------
| TENANT (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::prefix('tenant')
    ->middleware(['auth', 'role:tenant'])
    ->name('tenant.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', fn() => view('tenant.dashboard.index'))
            ->name('dashboard');

        // Booking / payment (HARUS LOGIN)
        Route::get('/payment/create', fn() => view('tenant.payment.create'))
            ->name('payment.create');

        Route::get('/payment/history', fn() => view('tenant.payment.history'))
            ->name('payment.history');

        Route::get('/payment/{id}', fn() => view('tenant.payment.show'))
            ->name('payment.show');

        // Profile (HARUS LOGIN)
        Route::get('/profile', fn() => view('tenant.profile.index'))
            ->name('profile.index');

        // Billing (login only)
        Route::get('/billing', fn() => view('tenant.billing.index'))
            ->name('billing.index');

        Route::get('/billing/{id}', fn() => view('tenant.billing.show'))
            ->name('billing.show');
    });