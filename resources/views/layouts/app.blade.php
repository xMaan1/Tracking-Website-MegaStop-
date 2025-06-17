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

        <!-- Custom CSS -->
        <link href="{{ asset('css/custom-animations.css') }}" rel="stylesheet">
        <link href="{{ asset('css/icon-sizing.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @php
            $manifestPath = public_path('build/manifest.json');
            $fallbackManifestPath = public_path('build/fallback-manifest.json');
            $manifestExists = file_exists($manifestPath);
            $manifest = $manifestExists ? json_decode(file_get_contents($manifestPath), true) : null;
        @endphp

        @if ($manifestExists && $manifest)
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @elseif (file_exists($fallbackManifestPath))
            <!-- Using fallback manifest -->
            <link href="{{ asset('build/assets/app-static.css') }}" rel="stylesheet">
            <script src="{{ asset('build/assets/app-static.js') }}" defer></script>
            <script src="{{ asset('build/assets/vendor-static.js') }}" defer></script>
            <script src="{{ asset('build/assets/alpine-static.js') }}" defer></script>
        @else
            <!-- Emergency fallback for when no manifests are available -->
            <link href="{{ asset('build/assets/app-G-FuTJ6b.css') }}" rel="stylesheet">
            <script src="{{ asset('build/assets/app-DAqi42qF.js') }}" defer></script>
            <script src="{{ asset('build/assets/vendor-Ht7b5I6w.js') }}" defer></script>
            <script src="{{ asset('build/assets/alpine-BoLXcf6Z.js') }}" defer></script>
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if (session('success'))
                    <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative fade-in" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative fade-in" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                
                {{ $slot }}
            </main>
        </div>
        
        <!-- Additional Scripts -->
        @stack('scripts')
    </body>
</html>