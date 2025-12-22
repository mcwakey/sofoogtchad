<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Meta Tags --}}
    <title>@yield('title', setting('site_name', 'Sofoodtchad'))</title>
    <meta name="description" content="@yield('meta_description', setting('site_description', ''))">
    <meta name="keywords" content="@yield('meta_keywords', setting('seo_meta_keywords', ''))">
    <meta name="author" content="{{ setting('site_name', 'Sofoodtchad') }}">

    {{-- Open Graph / Social Media Meta Tags --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', setting('site_name', 'Sofoodtchad'))">
    <meta property="og:description" content="@yield('og_description', setting('site_description', ''))">
    <meta property="og:image" content="@yield('og_image', setting('site_logo', ''))">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:site_name" content="{{ setting('site_name', 'Sofoodtchad') }}">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', setting('site_name', 'Sofoodtchad'))">
    <meta name="twitter:description" content="@yield('twitter_description', setting('site_description', ''))">
    <meta name="twitter:image" content="@yield('twitter_image', setting('site_logo', ''))">

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Favicon --}}
    @if(setting('site_favicon'))
        <link rel="icon" type="image/x-icon" href="{{ setting('site_favicon') }}">
        <link rel="shortcut icon" href="{{ setting('site_favicon') }}">
    @endif

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Preconnect to External Resources --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Fonts (placeholder - add your preferred fonts) --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Additional Head Styles --}}
    @stack('styles')

    {{-- Google Analytics --}}
    @if(setting('seo_google_analytics'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('seo_google_analytics') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ setting('seo_google_analytics') }}');
        </script>
    @endif

    {{-- Google Tag Manager --}}
    @if(setting('seo_google_tag_manager'))
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ setting('seo_google_tag_manager') }}');
        </script>
    @endif
</head>
<body class="@yield('body_class', '')">
    {{-- Google Tag Manager (noscript) --}}
    @if(setting('seo_google_tag_manager'))
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ setting('seo_google_tag_manager') }}"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    @endif

    {{-- Skip to Content (Accessibility) --}}
    <a href="#main-content" class="skip-link sr-only focus:not-sr-only">
        Skip to main content
    </a>

    {{-- Site Header --}}
    <x-header />

    {{-- Main Content Area --}}
    <main id="main-content" role="main">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        @yield('content')
    </main>

    {{-- Site Footer --}}
    <x-footer />

    {{-- WhatsApp Floating Button --}}
    @if(setting('contact_whatsapp'))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="whatsapp-float"
           aria-label="Contact us on WhatsApp">
            <svg class="whatsapp-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    @endif

    {{-- Scripts --}}
    @stack('scripts')

    {{-- Structured Data (JSON-LD) --}}
    @hasSection('structured_data')
        @yield('structured_data')
    @else
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{{ setting('site_name', 'Sofoodtchad') }}",
            "url": "{{ url('/') }}",
            @if(setting('site_logo'))
            "logo": "{{ setting('site_logo') }}",
            @endif
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "{{ setting('contact_phone', '') }}",
                "contactType": "customer service"
            },
            "sameAs": [
                @if(setting('social_facebook'))"{{ setting('social_facebook') }}"@endif
                @if(setting('social_facebook') && setting('social_instagram')),@endif
                @if(setting('social_instagram'))"{{ setting('social_instagram') }}"@endif
                @if((setting('social_facebook') || setting('social_instagram')) && setting('social_twitter')),@endif
                @if(setting('social_twitter'))"{{ setting('social_twitter') }}"@endif
                @if((setting('social_facebook') || setting('social_instagram') || setting('social_twitter')) && setting('social_linkedin')),@endif
                @if(setting('social_linkedin'))"{{ setting('social_linkedin') }}"@endif
            ]
        }
        </script>
    @endif
</body>
</html>
