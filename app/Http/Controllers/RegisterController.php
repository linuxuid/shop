<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:2|max:20',
            'username' => ['required', 'min:5', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'max:100', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255'],
          ]);

        $user = User::create($attributes);

        auth()->login($user);

        return redirect()->route('home.index');
    }
}
