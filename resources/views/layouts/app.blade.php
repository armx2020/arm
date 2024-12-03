<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ВСЕ АРМЯНЕ @yield('title') @if(isset($region)) {{ ' - ' .$region }} @endif</title>

    <link type="image/png" sizes="16x16" rel="icon" href="{{ url('image/favicon-16x16.png') }}">
    <link type="image/png" sizes="32x32" rel="icon" href="{{ url('image/favicon-32x32.png') }}">
    <link type="image/png" sizes="96x96" rel="icon" href="{{ url('image/favicon-96x96.png') }}">
    <link type="image/png" sizes="120x120" rel="icon" href="{{ url('image/favicon-120x120.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ url('/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ url('/select2.min.js') }}"></script>
    <script src="https://yastatic.net/share2/share.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/select.css', 'resources/js/jquery.bxslider.js'])
    @livewireStyles
</head>

<body class="antialiased w-full">
    <div class="min-h-screen bg-neutral-100">
        @include('layouts.nav')
        <div class="w-11/12 lg:w-10/12 max-w-7xl mx-auto">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
    @vite(['resources/js/scripts.js'])
    @livewireScripts
</body>

</html>
