<?php

use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\RoomTenantController;
use App\Http\Controllers\TenantRentalController;
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

        Route::post('/rooms/{room}/rent', [TenantRentalController::class, 'store'])
            ->middleware(['auth', 'role:tenant'])
            ->name('rooms.rent');


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

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Laporan
        Route::view('/report', 'admin.report.index')
            ->name('report');

        // Tenant
        Route::resource('tenants', TenantController::class)
            ->except(['show']);

        // Room
        Route::resource('rooms', RoomController::class)
            ->except(['show']);

        // Room Tenant
        Route::resource('room-tenants', RoomTenantController::class)
            ->except(['show']);

        // Bill
        Route::resource('bills', BillController::class)
            ->except(['show']);

        // Payment
        Route::resource('payments', PaymentController::class)
            ->except(['show']);

        // User Management
        Route::resource('users', UserController::class)
            ->except(['show']);

        // Activity Log
        // Route::resource('/activity-log', ActivityLogController::class)
        //     ->except(['show']);

        Route::get('/activity-log', [ActivityLogController::class, 'index'])
            ->name('activity-log.index');

        Route::delete('/activity-log/clear', [ActivityLogController::class, 'clear'])
            ->name('activity-log.clear');

        // Settings
        Route::view('/settings', 'admin.settings.index')
            ->name('settings');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::get('/profile/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])
            ->name('profile.change-password');

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
        Route::get('/dashboard', [DashboardController::class, 'tenantIndex'])
            ->name('dashboard');



        // Payment
        Route::view('/payment/create', 'tenant.payment.create')
            ->name('payment.create');


        Route::get('/payment/history', [PaymentController::class, 'tenantHistory'])
            ->name('payment.history');


        Route::view('/payment/{id}', 'tenant.payment.show')
            ->name('payment.show');



        // Billing
        Route::get('/billing', [BillController::class, 'tenantIndex'])
            ->name('bills.index');


        Route::get('/billing/{id}', [BillController::class, 'tenantShow'])
            ->name('bills.show');

        Route::post('/billing/{id}/pay', [TenantRentalController::class, 'pay'])
            ->name('bills.pay');



        // Profile
        Route::view('/profile', 'tenant.profile.index')
            ->name('profile.index');

        Route::get('/profile/edit', [ProfileController::class, 'tenantEdit'])
            ->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'tenantUpdate'])
            ->name('profile.update');


    });

