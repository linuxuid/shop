@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">   
    <link rel="stylesheet" href="{{ asset('/css/admin/users/edit.css') }}"> 
@endsection

@section('content')
<main>
    <div class="left">
        @foreach (App\Models\User::all() as $user)
            <p><a href="/control/users/{{ $user->id }}">{{ $user->username }}</a></p>
        @endforeach
    </div>
    <div class="content">
        <div class="top">
            <h2>Users list</h2>
        </div>
        <div class="session">
            @if (session()->has('success'))
                <p>account has been changed</p>
            @endif
        </div>
        <div class="users">
            <form class="admin_users" action="/control/users/{{ $users->id }}" method="POST">
                @csrf
                @method('PUT')
                <label for="name">
                    Name:
                </label>
                    <input type="text" name="name" id="name" value="{{ $users->name }}">
            @error('name')
                <span class="control_errors">{{ $message }}</span>
            @enderror
                <label for="username">
                    Username:
                </label>
                    <input type="text" name="username" id="username" value="{{ $users->username }}">
            @error('username')
                <span class="control_errors">{{ $message }}</span>
            @enderror
                <label for="email">
                    Email:
                </label>
                    <input type="text" name="email" id="email" value="{{ $users->email }}">
            @error('email')
                <span class="control_errors">{{ $message }}</span>
            @enderror    
                <button>
                    SUBMIT
                </button>
            </form>
        </div>
    </div>
</main>
@endsection