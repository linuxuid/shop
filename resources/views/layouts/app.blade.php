<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">        
@show
    <title>App name - @yield('title', 'shop')</title>
</head>
<body>
    <div class="wrapper">
    @section('header')
        <header>
            <nav class="menu_right">
                <a href="/">Home</a>
                <a href="/catalog">Catalog</a>
                <a href="/basket">Basket</a>
                <a href="/index">My Profile</a>
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
                                left: 600px;
                                bottom: 20px;
                            }
                        </style>
                    {{-- IF ADMIN AUTH END STYLE --}}

                <a href="{{ route('admin.index') }}">control panel</a>
            @endif
                <div class="logout">
                    <form method="POST" action="{{ route('session.destroy') }}">
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
                    <form action="" method="GET">
                        <input name="search" type="text" placeholder="search...">
                        <button>
                            search!
                        </button>
                    </form>
                </div>
            </nav>

        </header>
   @show
    
   @section('content')    
        <main>
            <div class="left">
                {{-- left sidebar --}}
            </div>

            <div class="content">
                {{-- main content --}}
            </div>
        </main>
    @show    

    @section('footer')
        <footer>
            <div class="footer_menu">
                <a href="#">FAQ</a> |
                <a href="#">Latests news</a> |
                <a href="#">jobs</a> |
                <a href="#">funshine@example.com</a> |
                <a href="#">+7(951)-065-93-05</a>
            </div>
            <div class="footer_text">
                <p><small>&copy; Copyright 2022, Example Corporation, Author:funshine</small> </p>
            </div>
        </footer>
    @show
    </div>
</body>
</html>