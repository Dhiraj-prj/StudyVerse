<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
           /* Hover effect for Cards */
.card:hover {
    transform: scale(1.05); /* Slightly enlarge the card */
    transition: transform 0.3s ease-in-out; /* Smooth transition */
}

/* Hover effect for Buttons */
.custom-btn:hover {
    transform: scale(1.1); /* Slightly enlarge the button */
    opacity: 0.9; /* Slight opacity change */
    transition: transform 0.3s ease, opacity 0.3s ease; /* Smooth transition */
}

/* Hover effect for Advertisement Section */
.bg-dark:hover {
    transform: translateY(-5px); /* Slightly lift the advertisement section */
    transition: transform 0.3s ease-in-out; /* Smooth transition */
}

/* Hover effect for the Faculty Card Link */
.card-body:hover a {
    color: #007bff; /* Change link color on hover */
    text-decoration: underline; /* Underline the link */
    transition: color 0.3s ease, text-decoration 0.3s ease;
}

/* Hover effect for Heading */
h3:hover {
    transform: scale(1.05); /* Slightly enlarge the heading */
    color: #0056b3; /* Change color on hover */
    transition: transform 0.3s ease, color 0.3s ease;
}


            .custom-btn {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 30px; /* Rounded corners */
    text-transform: uppercase; /* Uppercase text */
    font-weight: bold; /* Bold text */
    letter-spacing: 1px; /* Slight letter spacing */
    transition: all 0.3s ease; /* Smooth transition */
}

.custom-btn:hover {
    background-color: #0056b3; /* Darker blue background on hover */
    color: white; /* White text on hover */
    transform: translateY(-5px); /* Move the button slightly up */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a shadow for depth */
}

            post-heading{
            font-size: 26px;
            color: #000
            }

            .underline {
                height: 3px;
                width: 60px;
                background-color: #e71212 !important;
                margin-bottom: 10px;
            }

        </style>




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
