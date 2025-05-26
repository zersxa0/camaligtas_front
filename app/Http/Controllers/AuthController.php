<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $role = $request->input('role');
    $username = $request->input('username');
    $password = $request->input('password');

    // Superadmin
    if ($role === 'superadmin' && $username === 'superadmin@gmail.com' && $password === 'superadmin123') {
        return redirect()->route('superadmin.manage_users');
    }
    // Admin
    if ($role === 'admin' && $username === 'admin@gmail.com' && $password === 'admin123') {
        return redirect()->route('admin.dashboard');
    }
    // User (passcode-based demo)
    if ($role === 'user') {
        $user = session('registered_user');
        if ($user && $username === $user['name'] && $password === $user['passcode']) {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->back()->withErrors(['Invalid credentials.']);
}

    public function logout(Request $request)
    {
        // Add your logout logic here
        // For demo, just redirect to login
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Add your registration logic here
        return redirect()->route('login');
    }
    // app/Http/Controllers/AuthController.php

public function showRegisterForm()
{
    return view('auth.register'); // Make sure this Blade file exists in resources/views/auth/register.blade.php
}

}