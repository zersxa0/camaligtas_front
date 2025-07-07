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

// SuperAdmin routes
Route::get('/superadmin/manage_users', function () {
    return view('superadmin.manage_users');
})->name('superadmin.manage_users');

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

// Dashboard routes
Route::get('/admin/dashboard', function () {
    return view('hazard.home');
})->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

// FIXED: Hazard map route - uses existing hazard-map.blade file
Route::get('/hazard-map', function () {
    return view('hazard.hazard-map');
})->name('hazard.map');

Route::get('/sms', function () {
    return view('hazard.sms');
})->name('sms');

Route::get('/contacts', function () {
    return view('hazard.contacts');
})->name('contacts');

Route::get('/evacuation', function () {
    return view('hazard.evacuation');
})->name('evacuation');

// Profile routes
Route::get('/profile', function () {
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

Route::post('/profile', function (Request $request) {
    $photoPath = session('photo', null);
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $photoPath = $file->store('profile_photos', 'public');
    }

    session([
        'full_name' => $request->input('full_name'),
        'position' => $request->input('position'),
        'contact_number' => $request->input('contact_number'),
        'photo' => $photoPath,
    ]);
    return redirect()->route('hazard.profile')->with('success', 'Profile updated!');
})->name('profile.update');

// Barangay routes
Route::get('/ilawod', function () {
    return view('hazard.ilawod-demographic');
})->name('barangay.ilawod');

Route::post('/ilawod/export', function () {
    $data = [
        ['Purok', 'Population', 'Families'],
        ['Purok 1', 473, 142],
        ['Purok 2', 693, 208],
        ['Purok 3', 700, 210],
        ['Purok 4', 645, 194],
        ['Purok 5', 339, 99]
    ];
    
    $filename = 'ilawod_data.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"'
    ];
    
    $callback = function() use ($data) {
        $file = fopen('php://output', 'w');
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
})->name('ilawod.export');

Route::get('/sua', function () {
    return view('hazard.sua');
})->name('barangay.sua');

Route::get('/barangay1', function () {
    return view('hazard.barangay1');
})->name('barangay.barangay1');

Route::get('/barangay2', function () {
    return view('hazard.barangay2');
})->name('barangay.barangay2');

Route::get('/barangay3', function () {
    return view('hazard.barangay3');
})->name('barangay.barangay3');