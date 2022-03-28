@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/profile/index.css') }}">
@endsection

@section('content')
<main>
    <div class="content">

        <h1>My Profile</h1>

        <p>Welcome, <span>{{ auth()->user()->name }}!</p></span>
        <hr>
        {{-- START USER DATA IN PROFILE --}}
        <div class="description">
            <h2>Your personal data:</h2>
            <form method="POST">
                @csrf
            <label for="name">
                Name:
            </label>    
                <input name="name" id="name" value="{{ auth()->user()->name }}" disabled>
            <label for="username">
                Username:
            </label>        
                <input name="username" id="username" value="{{ auth()->user()->username }}" disabled>
            <label for="email">
                Email:
            </label>    
                <input name="email" id="email" value="{{ auth()->user()->email }}" disabled>
            <label for="phone">
                Phone:
            </label>
                <input name="phone" id="phone" value="{{ auth()->user()->phone }}" disabled>
            <label for="address">
                Address:
            </label>    
                <input name="address" id="address" value="{{ auth()->user()->address }}" disabled>
            </form>
        </div>

        <div class="btn">
            <a href="{{ route('personal.show') }}">Change</a>
        </div>
        {{-- END USER DATA PROFILE --}}

        {{-- START PROFILE DATA --}}
        <div class="profiles">    
            <div class="add_profiles">
                <a href="{{ route('personal.create') }}">Add profile</a>
            </div>
            <div class="btn_profile">
                <a href="{{ route('personal.show') }}">Change</a>
            </div>
            <h2>Your profile data:</h2>
            <table>
                <tr>
                    <thead>
                        <th>title</th>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>comment</th>
                        <th>edit</th>
                        <th>delete</th>
                    </thead>
                </tr>
            @forelse ($users->profiles as $item)
                <tr>
                    <tbody>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->comment }}</td>
                    </tr>
            @empty
                <p class="empty">You don't have any profiles</p>
            @endforelse
            </table>

            {{-- END PROFILE DATA --}}
        </div>
    </div>
</main>
@endsection

    

    
