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
        // Demo authentication logic
        $email = $request->input('email');
        $password = $request->input('password');

        // You can replace this with real authentication logic
        if ($email === 'superadmin@gmail.com' && $password === 'superadmin123') {
            return redirect()->route('superadmin.manage_users');
        } elseif ($email === 'admin@gmail.com' && $password === 'admin123') {
            return redirect()->route('admin.dashboard');
        } elseif ($email === 'sarah@gmail.com' && $password === 'sarah123') {
            return redirect()->route('user.dashboard');
        } else {
            // Default: redirect back with error
            return redirect()->back()->withErrors(['Invalid credentials.']);
        }
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
}