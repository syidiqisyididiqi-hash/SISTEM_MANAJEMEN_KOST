<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (Auth::check()) {

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'tenant') {
            return redirect()->route('tenant.dashboard');
        }

    }

    return view('tenant.home.index');

})->name('home');



/*
|--------------------------------------------------------------------------
| PUBLIC TENANT
|--------------------------------------------------------------------------
*/

Route::prefix('tenant')
    ->name('tenant.')
    ->group(function () {


        // Melihat daftar kamar (publik)
        Route::get('/rooms', [RoomController::class, 'tenantIndex'])
            ->name('rooms.index');


        // Detail kamar
        Route::get('/rooms/{room}', [RoomController::class, 'show'])
            ->name('rooms.show');


        // Pengumuman
        Route::view('/announcement', 'tenant.announcement.index')
            ->name('announcement.index');


        Route::view('/announcement/{id}', 'tenant.announcement.show')
            ->name('announcement.show');

    });



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('auth')
    ->middleware('guest')
    ->group(function () {


        // Login
        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');


        Route::post('/login', [AuthController::class, 'login']);



        // Register
        Route::get('/register', [AuthController::class, 'showRegister'])
            ->name('register');


        Route::post('/register', [AuthController::class, 'register'])
            ->name('register.post');



        // Forgot password
        Route::view('/forgot-password', 'auth.forgot-password')
            ->name('password.request');



        // Reset password
        Route::view('/reset-password', 'auth.reset-password')
            ->name('password.reset');

    });



/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');





/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {


        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');



        // Tenant Management
        Route::resource('tenants', TenantController::class)
            ->except(['show']);



        // Room Management
        Route::resource('rooms', RoomController::class)
            ->except(['show']);



        // Payment Management
        Route::resource('payments', PaymentController::class)
            ->except(['show']);



        // Profile Admin
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile.index');


        Route::get('/profile/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');


        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');


    });






/*
|--------------------------------------------------------------------------
| TENANT
|--------------------------------------------------------------------------
*/

Route::prefix('tenant')
    ->middleware(['auth', 'role:tenant'])
    ->name('tenant.')
    ->group(function () {



        // Dashboard Tenant
        Route::view('/dashboard', 'tenant.dashboard.index')
            ->name('dashboard');



        // Payment
        Route::view('/payment/create', 'tenant.payment.create')
            ->name('payment.create');


        Route::view('/payment/history', 'tenant.payment.history')
            ->name('payment.history');


        Route::view('/payment/{id}', 'tenant.payment.show')
            ->name('payment.show');



        // Billing
        Route::view('/billing', 'tenant.billing.index')
            ->name('billing.index');


        Route::view('/billing/{id}', 'tenant.billing.show')
            ->name('billing.show');



        // Profile
        Route::view('/profile', 'tenant.profile.index')
            ->name('profile.index');


    });