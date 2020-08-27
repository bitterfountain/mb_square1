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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
    </head>


    <body class="text-center">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="masthead ">
                <div class="inner">
                    <h3 class="masthead-brand">Blog</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link" @if( Request::is('/') ) active @endif href="/">Home</a>
                        @if( Session::has('username') )
                            <a class="logOut nav-link" id="logOut" href="/logout"><span class="green">{{Session::get('username')}}</span> - Logout</a>
                            <a class="nav-link" href="/mypost">My Post</a>
                            <a class="nav-link" href="/newpost">New Post</a>
                        @else
                            <a class="nav-link" @if( Request::is('register') ) active @endif href="/register">Register</a>
                            <a class="nav-link" @if( Request::is('login') ) active @endif href="/login">Login</a>
                        @endif
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
        
        <script type="text/javascript" src="{{ asset('vendor/jquery-3.5.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/bootstrap.min.js') }}"></script>
    </body>



</html>
