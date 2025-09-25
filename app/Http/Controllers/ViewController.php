<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

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
        $blogs = Blog::get();
        return view('blogs', compact('blogs'));
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
