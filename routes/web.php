<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

// ? ======= Pubilc Routes ======= (Anyone can go there)
Route::get('/', [ViewController::class, 'home'])->name('home');
Route::get('/about', [ViewController::class, 'about'])->name('about');
Route::get('/pricing', [ViewController::class, 'pricing'])->name('pricing');
Route::get('/blog', [ViewController::class, 'blog'])->name('blog');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ? ======= Auth Routes ======= (Logged in user can't go there)
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::get('/login', [ViewController::class, 'login'])->name('login-form');
    Route::get('/signup', [ViewController::class, 'signup'])->name('signup-form');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/therapist', [TherapistController::class, 'index'])->name('dashboard');
});
