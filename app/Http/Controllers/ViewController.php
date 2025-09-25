<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function pricing()
    {
        return view('pricing');
    }

    public function blog()
    {
        return view('blog');
    }

    public function contact()
    {
        return view('contact');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function signup()
    {
        return view('auth.signup');
    }
}
