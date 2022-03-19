<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title>App name - @yield('title', 'shop')</title>
</head>
<body>
    <div class="wrapper">
    @section('header')
        <header>
            <nav class="menu_right">
                <a href="#">Home</a>
                <a href="#">Catalog</a>
            </nav>
            <div class="search">
                <form action="" method="POST">
                    @csrf
                    <input name="search" type="text" placeholder="search...">
                    <button>
                        search!
                    </button>
                </form>
            </div>
            <nav class="menu_left">
                <a href="#">Basket</a>
                <a href="#">register</a>
                <a href="#">sign-up</a>
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