<?php

namespace App\Http\Controllers;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard');
    }

    public function users()
    {
        // Return users management view
        return view('superadmin.users');
    }
}