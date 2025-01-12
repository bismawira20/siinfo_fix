<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek status admin
        if (Auth::user()->is_admin) {
            // Jika admin, redirect ke dashboard admin
            return view('dashboard.admin.index');
        } else {
            // Jika user biasa, redirect ke dashboard user
            return view('dashboard.user.index');
        }
    }
}