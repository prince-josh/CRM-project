<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes (placeholder)
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('password.request');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');
    
    // Contact routes
    Route::resource('contacts', \App\Http\Controllers\ContactController::class);

        // User Invitation routes
        Route::resource('user-invitations', \App\Http\Controllers\UserInvitationController::class);
});
