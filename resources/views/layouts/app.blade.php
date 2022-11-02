<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f2f2e2;
            margin: 0 0 30px;
        }
        nav {
            padding: 0;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            background-color: #9abef2;
        }
        nav > * {
            margin-top: auto;
            margin-bottom: auto;
            padding: 20px;
            color: black;
        }
        .logo {
            margin: 0;
            padding: 5px;
            padding-left: 15px;
            font-size: 3em;
            font-weight: bold;
        }
        a {
            text-decoration: none;
        }

        main {
            width: 80%;
            margin: auto;
        }

        .page-nav {
            margin: 15px 0;
        }
        .page-nav > * + *::before {
            display: inline-block;
            content: '>';
            opacity: 0.6;
            padding: 0 5px;
        }


    </style>
    @yield('style')
</head>
<body>

    <div id="app">

        <nav>

            <a class="logo" href="/">{{ config('app.name', 'Laravel') }}</a>
            <div style="margin:auto"></div>

            @auth
                <a href="{{route('user.show',request()->user()->id)}}">{{ request()->user()->name }}</a>
                <span> | </span>
                <a href="{{ route('logout') }}">退出</a>
                <span> | </span>

            @endauth

            @guest

                <a href="{{route('register')}}">注册</a>
                <span> | </span>
                <a href="{{ route('login.create') }}">登陆</a>
                <span> | </span>
            @endguest

            <a href="#">帮助</a>
        </nav>

        <main class="py-4">


            @yield('breadcrumbs')

            @yield('content')
        </main>
    </div>
</body>
</html>
