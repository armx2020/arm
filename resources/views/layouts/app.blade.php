<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ВСЕ АРМЯНЕ</title>

    <link type="image/png" sizes="16x16" rel="icon" href="{{ url('image/favicon-16x16.png') }}">
    <link type="image/png" sizes="32x32" rel="icon" href="{{ url('image/favicon-32x32.png') }}">
    <link type="image/png" sizes="96x96" rel="icon" href="{{ url('image/favicon-96x96.png') }}">
    <link type="image/png" sizes="120x120" rel="icon" href="{{ url('image/favicon-120x120.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ url('/jquery-3.7.0.min.js')}}"></script>
    <script src="{{ url('/select2.min.js')}}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/select.css', 'resources/js/jquery.bxslider.js'])
    @livewireStyles
</head>

<body class="antialiased w-full">
    <div class="min-h-screen bg-neutral-100">
        @include('layouts.nav')
        @yield('content')
    </div>
    <div id="warning_cookie" class=" hidden bg-orange-100 px-1 lg:px-6 py-2 lg:py-5 text-xs md:text-sm lg:text-base text-orange-800 fixed bottom-0 w-full opacity-100">
        <div class="w-full md:w-10/12 mx-auto flex justify-between p-1">
            <div class="flex basis-full">Мы используем cookie. Продолжая пользоваться сайтом, вы соглашаетесь с использованием файлов cookie.</div>
            <div class="flex h-10 md:h-12">
            <button type="button" id="warning_button_cookie" class="flex basis-full bg-orange-600 rounded-lg p-3 px-auto text-white" href="http://armo/register">
                Принять
            </button>
            </div>
        </div>
    </div>
    @vite(['resources/js/scripts.js'])
    @livewireScripts
</body>

</html>