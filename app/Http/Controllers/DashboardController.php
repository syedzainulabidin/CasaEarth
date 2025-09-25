<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            return view('dashboard.user');
        } elseif ($role == 'admin') {
            return view('dashboard.admin');
        }
    }
}
