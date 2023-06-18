<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;
            $request->session()->regenerate();
            if ($role == 'admin') {
                return redirect()->intended(route('admin-dashboard'))->with('success', 'Login Success!');
            } else {
                return redirect()->intended(route('user-dashboard'))->with('success', 'Login Success!');
            }
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
