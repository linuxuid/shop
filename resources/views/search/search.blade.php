@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">   
    <link rel="stylesheet" href="{{ asset('/css/search/search.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/catalog.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/subcatalog.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home/products.css') }}">
@endsection

@section('header')
<header>
    <nav class="menu_right">
        <a href="/">Home</a>
        <a href="/catalog">Catalog</a>
        <a href="/basket">Basket</a>
    @if(auth()->user())
        <a href="/index">My Profile</a>
    @else
        <a href="/index">My Profile</a>
    @endif
        {{-- IF NOT AUTH STAT STYLE --}}
            <style>
                header .menu_left {
                    position: relative;
                    left: 400px;
                    bottom: 29px
                }
            </style>
        {{-- IF NOT AUTH END STYLE --}}
    @auth
    {{-- IF AUTH START STYLE --}}
        <style>
            header .menu_left {
                position: relative;
                left: 900px;
                bottom: 110px;
            }
            
            header .menu_right .logout {
                position: relative;
                left: 500px;
                bottom: 20px;
            }
        </style>
    {{-- IF AUTH END STYLE --}}
        <span class="welcome_back">Hello!, <span class="user">{{ auth()->user()->name }}!</span></span>
        
    @if (auth()->user()->name == 'admin')
            {{-- IF ADMIN AUTH START STYLE --}}
                <style>
                    header .menu_right .logout {
                        position: relative;
                        left: 600px;
                        bottom: 27px;
                    }
                </style>
            {{-- IF ADMIN AUTH END STYLE --}}

        <a href="{{ route('admin.index') }}">control panel</a>
    @endif
        <div class="logout">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit">Log Out</button>
            </form>
        </div>
    @else
        <a href="/register">register</a>
        <a href="/login">sign-up</a>
    </nav>
    @endauth

    <nav class="menu_left">
        <div class="search">
            <form action="{{ route('search') }}" method="GET">
                <input name="search" type="text" placeholder="search...">
                <button>
                    search!
                </button>
            </form>
        </div>
    </nav>

</header>
@endsection

@section('content')
<main>

    @php
        $categories = App\Models\Category::all();
        $products = App\Models\Product::all();
    @endphp

    <div class="left">
    @foreach (App\Models\Category::all() as $item)
        <h2>{{ $item->name }}</h2>
    @foreach ($products as $product)
        @if ($product->category_id == $item->id)
        <p><a class="subs" href="/catalog/subcatalog/{{ $product->id }}/{{ $product->id }}">{{ $product->slug }}</a></p>                
        @endif
    @endforeach
    @endforeach  
    </div>

    <div class="content">
        @if($posts->isNotEmpty() or $posts == null)
            @foreach ($posts as $post)
                    @foreach ($products as $product)
                    <div class="post_list">
                    @if ($post->id == $product->category_id)
                    <h3>{{ $product->slug }}</h3>
                    <img src="/img/download.png" width="300px" alt="" class="img-fluid">
                    <form action="{{ route('basket.add', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        <button class="search_btn">
                            add basket
                        </button>
                    </form>
                        
                    @endif
                </div>
                    @endforeach
            @endforeach
            

        
    @else 
        <div>
            <p>No posts found</p>
        </div>
    @endif
    </div>
</main>
@endsection