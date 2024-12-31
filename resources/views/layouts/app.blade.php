<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <style>
            .card-shadow{ 
                box-shadow: 0 2px 8px 0 rgb(000/10%); 
                border-radius: 5px; 
            }

            .category-heading{ 
            padding: 10px 12px; 
            border-left: 6px solid #000; 
            background-color: #ddd; 
            }

            post-heading{ 
            font-size: 26px; 
            color: #000
            }
        </style>

        @section('title', "$category->meta_title")

        @section('meta_description', "$category->meta_description")

        @section('meta_keyword', "$category->meta_keyword")

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>

        <meta name="meta_description" content=" @yield('meta_description')">

        <meta name="meta_keyword" content=" @yield('meta_keyword')">

       

        

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            @include('layouts.inc.frontend-navbar')
            
            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    </body>
</html>
