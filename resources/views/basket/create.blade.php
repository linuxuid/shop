@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">        
    <link rel="stylesheet" href="{{ asset('/css/basket/create.css') }}">
@show

@section('content')
<main>
    <div class="content">
        <h1 class="order_top">make an order</h1>
        <form class="order" method="POST" action="{{ route('create.order') }}">
            @csrf
            <label for="name">
                Name:
            </label>
            <input type="text" name="name" placeholder="name" value="{{ old('name') }}">
        @error('name')
            <span class="order_error">{{ $message }}</span>
        @enderror
            <label for="email">
                Email:
            </label>
            <input type="email" name="email" placeholder="email" value="{{ old('email') }}">
        @error('name')
            <span class="order_error">{{ $message }}</span>
        @enderror    
            <label for="phone">
                Phone:
            </label>
            <input type="text" name="phone" placeholder="phone" value="{{ old('phone') }}">
        @error('name')
            <span class="order_error">{{ $message }}</span>
        @enderror    
            <label for="address">
                Address:
            </label>
            <input type="text" name="address" placeholder="address" value="{{ old('address') }}">
        @error('name')
            <span class="order_error">{{ $message }}</span>
        @enderror
            <label for="comment">
                Comment:
            </label>
            <input type="text" name="comment" placeholder="comment" value="{{ old('comment') }}">
        @error('name')
            <span class="order_error">{{ $message }}</span>
        @enderror
            <button type="submit">
                PUBLISH
            </button>

        </form>
    </div>
</main>
@endsection