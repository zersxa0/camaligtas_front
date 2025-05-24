<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Add your authentication logic here
        // For demo, just redirect to admin dashboard
        return redirect()->route('admin.dashboard');
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