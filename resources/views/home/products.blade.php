@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> 
    <link rel="stylesheet" href="{{ asset('/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/catalog.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/subcatalog.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/products.css') }}">
@endsection

@section('content')
<main>
    <div class="left">
    </div>

    <div class="content">
        <h2>{{ $products->slug }}</h2>
        <img src="/img/download.png" width="400px" height="400px" alt="" class="img-fluid">
        <span class="price">Price: {{ $products->price }}$</span>
        <form action="{{ route('basket.add', ['id' => $products->id]) }}" method="POST">
            @csrf
            <label for="input-quantity">
                Quantity:
            </label>
            <input type="number" name="quantity" id="input-quantity" value="1">
            <button class="product_basket">
                add to basket
            </button>
        </form>
        <p>{{ $products->body }}</p>
    </div>
</main>
@endsection