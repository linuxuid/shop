@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">        
    <link rel="stylesheet" href="{{ asset('/css/auth/register.css') }}">
@endsection

@section('content')    
<main>
    <div class="content">
        <form class="auth" action="{{ route('register.users') }}" method="POST">
            @csrf
        <span class="top">Register!</span>    
            <label for="name">
                Name:
            </label>
            <input type="text" name="name" id="name" placeholder="name" value="{{ old('name') }}">
        @error('name')
            <span class="reg_errors">{{ $message }}</span>
        @enderror    

            <label for="username">
                Username:
            </label>
            <input type="text" name="username" id="username" placeholder="username" value="{{ old('username') }}">
        @error('username')
            <span class="reg_errors">{{ $message }}</span>
        @enderror    
            <label for="email">
                Email:
            </label>
            <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        @error('email')
            <span class="reg_errors">{{ $message }}</span>
        @enderror    

            <label for="password">
                Password:
            </label>
            <input type="password" name="password" id="password" placeholder="password">
        @error('password')
            <span class="reg_errors">{{ $message }}</span>
        @enderror    

        <span class="down">Already have an account?<a href="/login">Sign In</a></span>

            <button class="auth_btn">
                SUBMIT
            </button>
        </form>
    </div>
</main>
@endsection   