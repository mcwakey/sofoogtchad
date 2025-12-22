<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - {{ config('app.name', 'Sofoodtchad') }}</title>

    {{-- Styles placeholder --}}
    @stack('styles')
</head>
<body>
    <div id="app">
        {{-- Header --}}
        @include('admin.partials.header')

        <div class="admin-wrapper">
            {{-- Sidebar --}}
            @include('admin.partials.sidebar')

            {{-- Main Content --}}
            <main class="admin-content">
                {{-- Flash Messages --}}
                @include('admin.partials.flash')

                {{-- Page Header --}}
                @hasSection('page-header')
                    <header class="page-header">
                        @yield('page-header')
                    </header>
                @endif

                {{-- Page Content --}}
                @yield('content')
            </main>
        </div>

        {{-- Footer --}}
        @include('admin.partials.footer')
    </div>

    {{-- Scripts placeholder --}}
    @stack('scripts')
</body>
</html>
