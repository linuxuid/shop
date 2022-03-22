@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">        
    <link rel="stylesheet" href="{{ asset('/css/auth/register.css') }}">
@endsection

@section('content')    
<main>
    <div class="left">
        {{-- left sidebar --}}
    </div>

    <div class="content">
        <form class="auth" action="{{ route('session.store') }}" method="POST">
            @csrf
        <span class="top">Sign Up</span> 

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

        <span class="down">Forget your password?<a href="/login">Restore</a></span>

            <button class="auth_btn">
                SUBMIT
            </button>
        </form>
    </div>
</main>
@endsection   