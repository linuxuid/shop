@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('/css/admin/create.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/profile/showProfile.css') }}">
@endsection

@section('content')
<main>
    <div class="content">
        <h2>Edit your profile</h2>
        <div class="session">
            @if (session()->has('success'))
                <p>your profile has been changed</p>
            @endif
        </div>
        
        <form class="admin" action="{{ route('personal.show.profile.store') }}" method="POST">
            @csrf
            {{-- USER_ID INPUT --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{-- END USER_ID INPUT --}}
            <div class="link_profiles">
                <a href="{{ route('personal.create') }}">Add profile</a>
            </div>
        @foreach (App\Models\Profile::all() as $profile)
            @if (auth()->user()->id == $profile->user_id)        
                    <label for="title">
                        Title:
                    </label>
                    <input type="text" name="title" id="title" placeholder="title" value="{{ $profile->title }}">
                @error('title')
                    <span class="control_errors">{{ $message }}</span>
                @enderror
                    <label for="name">
                        Name:
                    </label>
                    <input type="text" name="name" id="name" placeholder="name" value="{{ $profile->name }}">
                @error('name')
                    <span class="control_errors">{{ $message }}</span>
                @enderror
                    <label for="email">
                        Email:
                    </label>
                    <input type="email" name="email" id="email" placeholder="email" value="{{ $profile->email }}">
                @error('email')
                    <span class="control_errors">{{ $message }}</span>
                @enderror    
                    <label for="phone">
                        Phone:
                    </label>
                    <input type="number" name="phone" id="phone" placeholder="phone" value="{{ $profile->phone }}">
                @error('phone')
                    <span class="control_errors">{{ $message }}</span>
                @enderror
                    <label for="address">
                        Address:
                    </label>    
                    <input type="text" name="address" id="address" placeholder="address" value="{{ $profile->address }}">
                @error('address')
                    <span class="control_errors">{{ $message }}</span>
                @enderror
                    <label for="comment">
                        Comment:
                    </label>
                    <input type="text" name="comment" id="comment" placeholder="comment" value="{{ $profile->comment }}">
                @error('comment')
                    <span class="control_errors">{{ $message }}</span>
                @enderror
                <button>
                    SUBMIT
                </button>                
            @endif
        @endforeach
        </form>
    </div>
</main>    
@endsection
