<?php

namespace App\Http\Controllers;

class TherapistController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return view('therapist.admin');
        } elseif ($role == 'user') {
            return view('therapist.user');
        }
    }
}
