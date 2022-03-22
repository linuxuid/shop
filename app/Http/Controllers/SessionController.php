<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create() 
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($attributes)){
            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'email' => 'your email was wrong',
            'password' => 'your password was wrong'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home.index');
    }
}
