<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class RegistController extends Controller
{
    public function index()
    {
        return view('login.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required', 
            'password' => 'required',
        ]);

        $check = User::where('username', $validatedData['username'])->count();
        if ($check) {
            return back()->with('loginError', 'Username already taken!');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['role'] = 'user';

        User::create($validatedData);

        return redirect(route('login'))
            ->with('success', 'Registration Success!');
    }
}
