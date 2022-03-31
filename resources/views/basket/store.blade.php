@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/basket/store.css') }}">      
@endsection

@section('content')
<main>
    <div class="content">
    @if (session()->has('success'))
        <div class="session_store">
            <p>
                your order has been successfully placed
            </p>
        </div>
    @endif
    </div>
</main>
@endsection