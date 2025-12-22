<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $page->meta_description ?? config('app.name') }}">
    <title>{{ $page->title }} - {{ config('app.name') }}</title>
    @stack('styles')
</head>
<body>
    <div id="page">
        {{-- Page Title --}}
        <header class="page-header">
            <h1>{{ $page->title }}</h1>
        </header>

        {{-- Page Sections --}}
        <main class="page-content">
            @foreach($page->sections as $section)
                @include('pages.sections.' . $section->section_type, ['content' => $section->content])
            @endforeach
        </main>

        {{-- Footer --}}
        <footer class="page-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </footer>
    </div>
    @stack('scripts')
</body>
</html>
