<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/rooms', function () {
    return view('room-listing');
})->name('rooms');

// Route to display the registration form
Route::get('/register', [AuthController::class, 'showSignupForm'])->name('register');

// Route to handle the form submission
Route::post('/register', [AuthController::class, 'signup'])->name('signup');



Route::get('/login',[AuthController::class,'signin'])->name('signin');


Route::post('/register',[AuthController::class,'signup'])->name('register');


Route::get('/set-password', [AuthController::class, 'showPasswordSetupForm']);
Route::post('/set-password', [AuthController::class, 'setPassword']);

// Route to show the password setup form
Route::get('/password-setup/{token}', [AuthController::class, 'showPasswordSetupForm'])->name('password.setup');

Route::get('/login', [AuthController::class, 'signin'])->name('login');

Route::post('/login',[AuthController::class,'login'])->name('login.submit');