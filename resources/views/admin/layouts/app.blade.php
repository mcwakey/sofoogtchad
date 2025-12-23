<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - {{ config('app.name', 'Sofoodtchad') }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Styles placeholder --}}
    @stack('styles')
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">
    <div id="app" class="min-h-full">

        {{-- Mobile Sidebar Overlay --}}
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak
        ></div>

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Main Content Wrapper --}}
        <div class="lg:pl-64 flex flex-col min-h-screen">

            {{-- Top Navigation Bar --}}
            @include('admin.partials.topbar')

            {{-- Main Content Area --}}
            <main class="flex-1 py-6">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    {{-- Flash Messages --}}
                    @include('admin.partials.flash')

                    {{-- Page Header --}}
                    @hasSection('page-header')
                        <div class="mb-6">
                            @yield('page-header')
                        </div>
                    @endif

                    {{-- Page Content --}}
                    @yield('content')

                </div>
            </main>

            {{-- Footer --}}
            <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                        <p class="text-sm text-gray-500">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Sofoodtchad') }}. All rights reserved.
                        </p>
                        <p class="text-sm text-gray-400">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ config('app.name', 'Sofoodtchad') }} {{ app_version('formatted') }}
                            </span>
                        </p>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    {{-- Scripts placeholder --}}
    @stack('scripts')
</body>
</html>
