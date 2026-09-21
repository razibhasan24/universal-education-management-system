<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css'])

        @yield('styles')
    </head>
    <body class="d-flex flex-column min-vh-100">
        @include('layouts.navbar')

        <main class="container-fluid flex-grow-1 py-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @isset($header)
                        <div class="mb-4">
                            <h1 class="h3 fw-semibold mb-0">{{ $header }}</h1>
                        </div>
                    @endisset

                    @yield('content')
                </div>
            </div>
        </main>

        @include('layouts.footer')

        <!-- Scripts -->
        @vite(['resources/js/app.js'])

        @yield('scripts')
    </body>
</html>
