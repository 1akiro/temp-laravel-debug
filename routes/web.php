<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('show.register')
    ->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('show.login')
    ->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::resource('tour', ToursController::class);
Route::patch('/tours/{tour}/visibility', [ToursController::class, 'toggleVisibility'])
    ->name('tour.visibility')
    ->middleware('auth');
Route::post('/tours/{tour}/change-owner', [ToursController::class, 'changeOwner'])
    ->name('tour.changeOwner')
    ->middleware('auth');

Route::get('/dashboard', [AdminController::class, 'showDashboard'])
    ->name('dashboard')
    ->middleware('auth');

Route::resource('user', UsersController::class);

Route::get('/logs', [AdminController::class, 'activities'])
    ->name('admin.activities')
    ->middleware('auth');
Route::get('/api/users/search', [UsersController::class, 'search'])
    ->name('users.search')
    ->middleware('auth');
