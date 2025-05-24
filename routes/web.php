<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HazardController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration (if needed)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Home route for navbar and landing page
Route::get('/home', function () {
    return view('hazard.home');
})->name('home');

// Main hazard map (public access)
Route::get('/', [HazardController::class, 'index'])->name('hazard.map');

// Other public pages
Route::get('/alerts', [AlertController::class, 'index'])->name('alerts');
Route::get('/hazard-map', [HazardController::class, 'index'])->name('hazard.map');
Route::get('/risk-analysis', function () {
    return view('hazard.risk_analysis');
})->name('risk.analysis');
Route::get('/sms', function () {
    return view('hazard.sms');
})->name('sms');
Route::get('/contacts', function () {
    return view('hazard.contacts');
})->name('contacts');
Route::get('/evacuation', function () {
    return view('hazard.evacuation');
})->name('evacuation');

// Role-based dashboards
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/user/tickets', [UserDashboardController::class, 'submitTicket'])->name('user.tickets.submit');
    // If you want /user/user-dashboard as a separate URL, you can add:
    // Route::get('/user/user-dashboard', [UserDashboardController::class, 'index'])->name('user.user-dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
    Route::post('/admin/notifications', [AdminController::class, 'sendNotification'])->name('admin.notifications.send');
    // admin routes here
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
});

// Hazard home route for admin/superadmin redirect
Route::get('/hazard/home', function () {
    return view('hazard.home');
})->name('hazard.home');

Route::get('/user/user-dashboard', [UserDashboardController::class, 'index'])->name('user.user-dashboard');