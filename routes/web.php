<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Authentication routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password route
Route::get('/forgot_password', function () {
    return view('auth.forgot_password');
})->name('forgot_password');

Route::get('/home', function () {
    return view('hazard.home');
})->name('home');

// Fixed SuperAdmin Access (superadmin@gmail.com / superadmin123)
Route::get('/superadmin/manage_users', function () {
    return view('superadmin.manage_users');
})->name('superadmin.manage_users');

// SuperAdmin user management actions
Route::post('/superadmin/users/{id}/approve', function ($id) {
    return response()->json(['success' => true, 'message' => 'User account approved successfully!']);
})->name('superadmin.approve_user');

Route::post('/superadmin/users/{id}/reject', function ($id) {
    return response()->json(['success' => true, 'message' => 'User account rejected successfully!']);
})->name('superadmin.reject_user');

Route::post('/superadmin/users/{id}/suspend', function ($id) {
    return response()->json(['success' => true, 'message' => 'User account suspended successfully!']);
})->name('superadmin.suspend_user');

Route::post('/superadmin/users/{id}/activate', function ($id) {
    return response()->json(['success' => true, 'message' => 'User account activated successfully!']);
})->name('superadmin.activate_user');

Route::delete('/superadmin/users/{id}', function ($id) {
    return response()->json(['success' => true, 'message' => 'User account deleted successfully!']);
})->name('superadmin.delete_user');

// Admin dashboard (admin@gmail.com / admin123)
Route::get('/admin/dashboard', function () {
    return view('hazard.home');
})->name('admin.dashboard');

// User dashboard (sarah@gmail.com / sarah123)
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

// Optionally, keep this for generic dashboard if needed
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

// Hazard map route for navbar links
Route::get('/hazard-map', function () {
    return view('hazard.index');
})->name('hazard.map');

Route::get('/risk_analysis', function () {
    return view('hazard.risk_analysis');
})->name('risk.analysis');

Route::get('/alerts', function () {
    return view('hazard.alerts');
})->name('alerts');

Route::get('/sms', function () {
    return view('hazard.sms');
})->name('sms');

Route::get('/contacts', function () {
    return view('hazard.contacts');
})->name('contacts');

Route::get('/evacuation', function () {
    return view('hazard.evacuation');
})->name('evacuation');

// --- PROFILE DEMO ROUTES ---

// Show profile (view or edit)
Route::get('/profile', function () {
    // Use session data if available, else use fake user
    $fakeUser = (object)[
        'full_name' => session('full_name', 'Admin User'),
        'position' => session('position', 'Administrator'),
        'contact_number' => session('contact_number', '09123456789'),
        'photo' => session('photo', null),
        'email' => 'admin@gmail.com'
    ];
    $edit = request('edit', false);
    return view('hazard.manage_profile', ['fakeUser' => $fakeUser, 'edit' => $edit]);
})->name('hazard.profile');

// Handle profile update (with photo upload)
Route::post('/profile', function (Request $request) {
    // Handle photo upload for demo
    $photoPath = session('photo', null);
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $photoPath = $file->store('profile_photos', 'public');
    }

    // Store updated info in session
    session([
        'full_name' => $request->input('full_name'),
        'position' => $request->input('position'),
        'contact_number' => $request->input('contact_number'),
        'photo' => $photoPath,
    ]);
    return redirect()->route('hazard.profile')->with('success', 'Profile updated!');
})->name('profile.update');