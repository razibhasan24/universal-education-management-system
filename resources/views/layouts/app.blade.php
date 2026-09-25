<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} | {{ config('app.name') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    {{-- Bangla + English Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Vite CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Styles --}}
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 transition-colors duration-200">

    {{-- Toast Notifications --}}
    @include('layouts.partials.alerts')

    {{-- Loading Overlay --}}
    <div id="loading-overlay"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 flex flex-col items-center gap-3">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-indigo-500 border-t-transparent"></div>
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">লোড হচ্ছে...</p>
        </div>
    </div>

    <div class="min-h-screen flex" x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true' }" x-init="$watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val))">

        {{-- Mobile Sidebar Backdrop --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/60 z-40 lg:hidden" style="display: none;"></div>

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Main Content Wrapper --}}
        <div class="flex-1 flex flex-col min-w-0 lg:transition-all lg:duration-300"
            :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-64'">

            {{-- Topbar --}}
            @include('layouts.partials.topbar')

            {{-- Breadcrumb + Page Content --}}
            <main class="flex-1 p-4 md:p-6 overflow-x-hidden">
                {{-- Breadcrumb --}}
                @if (isset($breadcrumbs) || View::hasSection('breadcrumbs'))
                    @include('layouts.partials.breadcrumb')
                @endif

                {{-- Page Header --}}
                @hasSection('page-title')
                    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100">
                                @yield('page-title')
                            </h1>
                            @hasSection('page-subtitle')
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    @yield('page-subtitle')
                                </p>
                            @endif
                        </div>
                        @hasSection('page-actions')
                            <div class="flex items-center gap-2">
                                @yield('page-actions')
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Main Content --}}
                @yield('content')
                {{ $slot ?? '' }}
            </main>

            {{-- Footer --}}
            <footer class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div
                    class="flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} <span
                            class="font-semibold text-indigo-600 dark:text-indigo-400">{{ config('app.name') }}</span>.
                        All rights reserved.</p>
                    <p>Version 1.0.0 | Developed with ❤️ in Bangladesh</p>
                </div>
            </footer>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    @include('layouts.partials.delete-modal')

    @stack('scripts')

    <script>
        // Global helper: confirm delete
        function confirmDelete(formId) {
            window.dispatchEvent(new CustomEvent('open-delete-modal', {
                detail: {
                    formId
                }
            }));
        }

        // Show loading
        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        }

        // Hide loading
        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
        }
    </script>
</body>

</html>
