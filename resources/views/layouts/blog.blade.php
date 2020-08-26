<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>


    <body class="text-center">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="masthead ">
                <div class="inner">
                    <h3 class="masthead-brand">Blog Community Blogger </h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link" @if( Request::is('/') ) active @endif href="/">Home</a>
                        <a class="nav-link" @if( Request::is('register') ) active @endif href="/register">Register</a>
                        <a class="nav-link" @if( Request::is('login') ) active @endif href="/login">Login</a>
                    </nav>
                </div>
            </header>

            <main class="">
                @yield('content')
            </main>

            <footer class="mastfoot mt-auto">
                <div class="inner">
                    
                </div>
            </footer>
        </div>
        
        <script type="text/javascript" src="{{ asset('vendor/bootstrap.min.js') }}"></script>
    </body>



</html>
