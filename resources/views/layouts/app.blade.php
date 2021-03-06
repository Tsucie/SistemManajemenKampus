<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kampusku') }}</title>
        {{-- <title>Kampusku</title> --}}
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <!-- My CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/mystyle.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets') }}/vendor/notifIt/css/notifIt.css" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            @php
                $userPhoto = auth()->user()->hasPhoto()->where('up_rec_status', 1)->get()->all();
            @endphp
            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="u_id" value="{{ auth()->user()->u_id }}" hidden>
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="{{ asset('assets') }}/vendor/notifIt/js/notifIt.js"></script>
        <script src="{{ asset('Scripts') }}/AlertMessage.js"></script>
        <script src="{{ asset('Scripts') }}/App.js"></script>
        <!-- Alert Message -->
        @if (Session::has('Error'))
            <input type="text" id="error-message" value="{{ Session::get('Error') }}" hidden>
            <script>
                pesanAlert({ "code": 0, "message": document.getElementById('error-message').value });
            </script>
        @endif
        @if (Session::has('Success'))
            <input type="text" id="error-message" value="{{ Session::get('Success') }}" hidden>
            <script>
                pesanAlert({ "code": 1, "message": document.getElementById('error-message').value });
            </script>
        @endif
    </body>
</html>