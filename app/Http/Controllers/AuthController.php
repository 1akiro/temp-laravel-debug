<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister ()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|confirmed'

        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => $request->password
        ]);

        Auth::login($user);
        return redirect()->route('tour.index')->with('success', 'Account created successfuly!');
    }

    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($user)) {

            $request->session()->regenerate();

            return redirect()->route('tour.index');
        }
        return back()->withErrors([

            'email' => 'The provided credentials do not match our records.',

        ])->onlyInput('email');
    }
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('tour.index')->with('success', 'Logged out!');
    }
}
