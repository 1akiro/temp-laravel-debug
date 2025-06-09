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

Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('tour', ToursController::class);
Route::patch('/tours/{tour}/visibility', [ToursController::class, 'toggleVisibility'])->name('tour.visibility');
Route::post('/tours/{tour}/change-owner', [ToursController::class, 'changeOwner'])
    ->name('tour.changeOwner');

Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');

Route::resource('user', UsersController::class);

Route::get('/api/users/search', function (Request $request) {
    $query = $request->input('query');

    if (strlen($query) < 2) {
        return response()->json([]);
    }

    $users = User::where('email', 'like', "%{$query}%")
        ->orWhere('name', 'like', "%{$query}%")
        ->select('id', 'name', 'email')
        ->limit(5)
        ->get();

    return response()->json($users);
})->name('users.search');
