<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    

    <script src="{{ url('/jquery-3.7.0.min.js')}}"></script>
    <script src="{{ url('/select2.min.js')}}"></script>
    <link href="{{ url('/select2.min.css')}}" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="font-sans antialiased min-h-screen bg-gray-100">

    @include('admin.layouts.head')

    <div class="flex overflow-hidden bg-white pt-16">

        @include('admin.layouts.nav')

        <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>

        <div id="main-content" class="w-full bg-gray-50 relative overflow-y-auto lg:ml-64">

            <main class="min-h-screen">
                @yield('content')
            </main>

            @include('admin.layouts.footer')
        </div>

    </div>
    @livewireScripts

</body>

</html>