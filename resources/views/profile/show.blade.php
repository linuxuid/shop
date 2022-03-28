@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('/css/admin/create.css') }}">
@endsection

@section('content')
<main>
    <div class="content">
        <h2>Edit your data</h2>
        <div class="session">
            @if (session()->has('success'))
                <p>your profile has been changed</p>
            @endif
        </div>

        <form class="admin" action="{{ route('personal.show.store') }}" method="POST">
            @csrf
            <label for="name">
                Name:
            </label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}">
        @error('name')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="username">
                Username:
            </label>
            <input type="text" name="username" id="username" value="{{ auth()->user()->username }}">
        @error('username')
            <span class="control_errors">{{ $message }}</span>
        @enderror    
            <label for="email">
                Email:
            </label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}">
        @error('email')
            <span class="control_errors">{{ $message }}</span>
        @enderror    
            <label for="phone">
                Phone:
            </label>
            <input type="number" name="phone" id="phone" value="{{ auth()->user()->phone }}">
        @error('phone')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="address">
                Address:
            </label>    
            <input type="text" name="address" id="address" value="{{ auth()->user()->address }}">
        @error('address')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <button>
                SUBMIT
            </button>
        </form>
    </div>
</main>  
@endsection