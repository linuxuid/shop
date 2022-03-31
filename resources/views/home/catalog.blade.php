@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/catalog.css') }}">
@endsection

@section('content')
<main>
    <div class="left">
        @foreach (App\Models\Category::all() as $item)
        <h2>{{ $item->name }}</h2>
        @foreach (App\Models\Product::all() as $product)
            @if ($product->category_id == $item->id)
            <p><a class="subs" href="/catalog/subcatalog/{{ $product->id }}">{{ $product->slug }}</a></p> 
            @endif
    @endforeach
    @endforeach    
    </div>

    <div class="content">  
        <h2>Categories</h2>
        <hr>
            @foreach ($categories as $category)
            <div class="catalogs">
            <span>{{ $category->slug }}</span>
            <img src="img/unnamed.png" width="300px" alt="" class="img-fluid"> 
                <form action="/catalog/subcatalog/{{ $category->id }}">
                    <button>
                        Follow
                    </button>
                </form> 
            </div>
            @endforeach
    </div>
</main>
@endsection