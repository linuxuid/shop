@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/create.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/profile/showProfile.css') }}">
@endsection

@section('content')
<main>
    <div class="content">
        <h2>Add New Profile</h2>
        <div class="session">
            @if (session()->has('success'))
                <p>your profile has been added</p>
            @endif
        </div>
        
        <form class="admin" action="{{ route('personal.store') }}" method="POST">
            @csrf
            {{-- USER_ID INPUT --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{-- END USER_ID INPUT --}}
            <div class="link_profiles">
                <a href="{{ route('personal.show.profile') }}">Edit profile</a>
            </div>
            <label for="title">
                Title:
            </label>
            <input type="text" name="title" id="title" placeholder="title" value="{{ old('title') }}">
        @error('title')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="name">
                Name:
            </label>
            <input type="text" name="name" id="name" placeholder="name" value="{{ old('name') }}">
        @error('name')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="email">
                Email:
            </label>
            <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        @error('email')
            <span class="control_errors">{{ $message }}</span>
        @enderror    
            <label for="phone">
                Phone:
            </label>
            <input type="number" name="phone" id="phone" placeholder="phone" value="{{ old('phone') }}">
        @error('phone')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="address">
                Address:
            </label>    
            <input type="text" name="address" id="address" placeholder="address" value="{{ old('address') }}">
        @error('address')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="comment">
                Comment:
            </label>
            <input type="text" name="comment" id="comment" placeholder="comment" value="{{ old('comment') }}">
        @error('comment')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <button>
                SUBMIT
            </button>
        </form>
    </div>
</main>    
@endsection