<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_process(Request $request)
    {
        $validate1 = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:10',
        ]);

        if (Auth::attempt($validate1)) {
            return redirect(route('dashboard'));
        } else {
            return back()->with('failed', 'Login Failed');
        }
    }

    public function register_process(Request $request)
    {
        $validate2 = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:10|confirmed',
        ]);

        User::create([
            'name' => $validate2['name'],
            'email' => $validate2['email'],
            'password' => $validate2['password'],
            'role' => 'student',
        ]);

        if (Auth::attempt($validate2)) {
            return redirect(url('/'));
        } else {
            return back()->with('failed', 'register Failed');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(url('/'));
    }
}
