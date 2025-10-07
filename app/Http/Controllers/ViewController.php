<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tier;

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
        $tiers = Tier::get();

        return view('pricing', compact('tiers'));
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
