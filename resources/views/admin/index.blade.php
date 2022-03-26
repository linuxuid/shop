@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> 
    <link rel="stylesheet" href="{{ asset('/css/admin/index.css') }}">
@endsection

@section('header')
<header>
    <nav class="menu_right">
        <a href="/">Home</a>
        <a href="/catalog">Catalog</a>
        <a href="/basket">Basket</a>
        {{-- IF NOT AUTH STAT STYLE --}}
            <style>
                header .menu_left {
                    position: relative;
                    left: 493px;
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
                bottom: 90px;
            }
            
            header .menu_right .logout {
                position: relative;
                left: 390px;
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
                        left: 200px;
                        top: 55px
                    }

                </style>
            {{-- IF ADMIN AUTH END STYLE --}}

        <a href="{{ route('admin.create') }}">control panel</a>
        <nav class="menu_left">
            <div class="logout">
                <form method="POST" action="{{ route('session.destroy') }}">
                    @csrf
                    <button type="submit">Log Out</button>
                </form>
            </div>
        </nav>
    @endif

    @else
        <a href="/register">register</a>
        <a href="/login">sign-up</a>
    </nav>


    @endauth

</header>
@endsection

@section('content')
<main>
    <div class="content">

        <div class="under_top">
            <h1>Panel control</h1>
            <p>Welcome, {{ auth()->user()->name }}</p>
        </div>
    <div class="admin_links">  
        <a href="{{ route('admin.show', ['id' => 1]) }}" class="admin_link">EDIT CATEGORY</a>
        <a href="{{ route('admin.create') }}" class="admin_link">CREATE CATEGORY</a>
        <a href="{{ route('admin.product.edit', ['id' => 1]) }}" class="admin_link">EDIT PRODUCT</a>
        <a href="{{ route('admin.product.create') }}" class="admin_link">CREATE PRODUCT</a>
    </div>
    <div class="admin_products">
        <a href="/control/users" class="admin_link">USERS LIST</a>
    </div>

    <div class="all_categories">
        <h2>All categories</h2>

        @if(session()->has('success'))
        <div class="admin_top">
            <p>
               this category has been deleted
            </p>
        </div>
        @endif
        <table>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>delete</th>
            </tr>
            @foreach (App\Models\Category::all() as $category)
            <tr>
               <td> {{ $category->name }} </td>
               <td> {{ $category->slug }}</td>
               <td>
                <form action="{{ route('admin.destroy', ['id' => $category->id]) }}" method="POST">
                    @csrf
                <button class="remove_btn">
                    &#8855;
                </button>    
            </td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
</main>
@endsection