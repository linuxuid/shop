@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> 
    <link rel="stylesheet" href="{{ asset('/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/catalog.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/subcatalog.css') }}">
@endsection

@section('content')
<main>
    <div class="left">
        <h3>Directory catalog</h3>
        <p>subcategory catalog</p>

        <h3>Directory catalog</h3>
        <p>subcategory catalog</p>
    </div>

    <div class="content">
        <h2>Products</h2>
        <hr>
        @foreach ($categories->products as $category)
            <span>{{ $category->slug }}</span>
            <img src="https://via.placeholder.com/400x120" alt="" class="img-fluid">
            <form action="/catalog/subcatalog/{{ $category->id }}/{{ $category->id }}">
                <button class="basket">
                    add to basket
                </button>
            </form>
            <form action="/catalog/subcatalog/{{ $category->id }}/{{ $category->id }}">
                <button class="follow">
                    Follow
                </button>
            </form>
        @endforeach
    </div>
</main>
@endsection