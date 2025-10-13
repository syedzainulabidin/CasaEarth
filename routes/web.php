<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

// * === Therapist Availability === (AJAX)
Route::get('/dashboard/appointment/{therapist}/availability', [AppointmentController::class, 'getAvailability'])
    ->name('appointment.availability');

// * === Pubilc Routes === (Anyone can go there)
Route::get('/', [ViewController::class, 'home'])->name('home');
Route::get('/about', [ViewController::class, 'about'])->name('about');
Route::get('/pricing', [ViewController::class, 'pricing'])->name('pricing');
Route::get('/blogs', [ViewController::class, 'blog'])->name('blogs');
Route::get('/blog/{id}', [BlogController::class, 'blog'])->name('blog');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');

// * === Guest Routes === (Logged in user can't go there)
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::get('/login', [ViewController::class, 'login'])->name('login-form');
    Route::get('/signup', [ViewController::class, 'signup'])->name('signup-form');
});

// * === Google Auth === (Default Free Tier)
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// * === Auth Routes === (User must be logged in)
Route::middleware('auth')->group(function () {

    // ! Dashboard Home (role-based content inside controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ! Dashboard Resources Group
    Route::prefix('/dashboard')->group(function () {

        // * Admin-only resources
        Route::middleware('role:admin')->group(function () {
            Route::resource('therapist', TherapistController::class);
            Route::resource('course', CourseController::class);
            Route::resource('blog', BlogController::class);
            Route::resource('appointment', AppointmentController::class);
            Route::resource('tier', TierController::class);
            // * Google Calendar + Google Meet
            Route::get('/google/calendar/connect', [GoogleCalendarController::class, 'connect'])->name('google.calendar.connect');
            Route::get('/google/calendar/callback', [GoogleCalendarController::class, 'callback'])->name('google.calendar.callback');
            Route::get('/google/calendar/create-meeting', [GoogleCalendarController::class, 'createMeetingEvent'])->name('google.calendar.create');

        });

        // * Public resources
        Route::resource('therapist', TherapistController::class)->only(['index']);
        Route::resource('course', CourseController::class)->only(['index', 'show']);
        Route::resource('appointment', AppointmentController::class)->only(['index', 'create', 'store']);

        // * User-only resource
        Route::middleware('role:user')->group(function () {
            Route::resource('plan', PlanController::class);
            Route::post('plan/upgrade', [PaymentController::class, 'getPayment'])->name('plan.upgrade');
        });

        Route::resource('profile', ProfileController::class);

    });

    // ! Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Google Calendar OAuth (admin use only)
