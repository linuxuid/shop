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
        <div class="description">
            <h2>Your personal data:</h2>
            <p></p>
        </div>
    </div>
</main>
@endsection