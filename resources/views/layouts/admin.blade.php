<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Universal Education Management System'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])

    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay" @click="closeSidebar"></div>

    @include('layouts.admin.sidebar')

    <div class="admin-wrapper">
        @include('layouts.admin.topbar')

        <main class="admin-content flex-grow-1">
            @include('layouts.admin.breadcrumb')

            <div class="container-fluid">
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

                @yield('content')
            </div>
        </main>

        @include('layouts.admin.footer')
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <script>
        const adminApp = {
            data() {
                return {
                    sidebarOpen: false
                }
            },
            methods: {
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                    document.body.classList.toggle('sidebar-open', this.sidebarOpen);
                },
                closeSidebar() {
                    this.sidebarOpen = false;
                    document.body.classList.remove('sidebar-open');
                }
            }
        };

        if (typeof Alpine !== 'undefined') {
            document.addEventListener('alpine:init', () => {
                Alpine.data('adminApp', () => adminApp);
            });
        }
    </script>

    @yield('scripts')
</body>
</html>