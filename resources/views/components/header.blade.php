@props([
    'logoUrl' => null,
    'logoAlt' => null,
    'showCta' => true,
])

@php
    $siteName = setting('site_name', 'Sofoodtchad');
    $siteLogo = $logoUrl ?? setting('site_logo');
    $logoAltText = $logoAlt ?? $siteName;
    $whatsappNumber = setting('contact_whatsapp');

    $navItems = [
        ['label' => 'Home', 'route' => '/', 'active' => request()->is('/')],
        ['label' => 'About', 'route' => '/about', 'active' => request()->is('about')],
        ['label' => 'Products', 'route' => '/products', 'active' => request()->is('products*')],
        ['label' => 'Quality & Process', 'route' => '/process', 'active' => request()->is('process*')],
        ['label' => 'Partners', 'route' => '/partners', 'active' => request()->is('partners*')],
        ['label' => 'Blog', 'route' => '/blog', 'active' => request()->is('blog*')],
        ['label' => 'Contact', 'route' => '/contact', 'active' => request()->is('contact')],
    ];
@endphp

<header class="site-header" role="banner">
    <div class="header-container">
        {{-- Logo --}}
        <div class="header-logo">
            <a href="{{ url('/') }}" aria-label="{{ $siteName }} - Home">
                @if($siteLogo)
                    <img
                        src="{{ $siteLogo }}"
                        alt="{{ $logoAltText }}"
                        class="logo-image"
                        loading="eager"
                    >
                @else
                    <span class="logo-text">{{ $siteName }}</span>
                @endif
            </a>
        </div>

        {{-- Desktop Navigation --}}
        <nav class="header-nav desktop-nav" role="navigation" aria-label="Main navigation">
            <ul class="nav-menu">
                @foreach($navItems as $item)
                    <li class="nav-item">
                        <a
                            href="{{ url($item['route']) }}"
                            class="nav-link {{ $item['active'] ? 'active' : '' }}"
                            @if($item['active']) aria-current="page" @endif
                        >
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Header Actions --}}
        <div class="header-actions">
            {{-- CTA Button (WhatsApp) --}}
            @if($showCta && $whatsappNumber)
                <a
                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="header-cta"
                    aria-label="Contact us on WhatsApp"
                >
                    <svg class="cta-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span class="cta-text">WhatsApp</span>
                </a>
            @endif

            {{-- Mobile Menu Toggle --}}
            <button
                type="button"
                class="mobile-menu-toggle"
                aria-label="Toggle navigation menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
                data-menu-toggle
            >
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="sr-only">Menu</span>
            </button>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <nav
        id="mobile-menu"
        class="mobile-nav"
        role="navigation"
        aria-label="Mobile navigation"
        aria-hidden="true"
        data-mobile-menu
    >
        <ul class="mobile-nav-menu">
            @foreach($navItems as $item)
                <li class="mobile-nav-item">
                    <a
                        href="{{ url($item['route']) }}"
                        class="mobile-nav-link {{ $item['active'] ? 'active' : '' }}"
                        @if($item['active']) aria-current="page" @endif
                    >
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach

            {{-- Mobile CTA --}}
            @if($showCta && $whatsappNumber)
                <li class="mobile-nav-item mobile-nav-cta">
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mobile-cta-button"
                    >
                        <svg class="cta-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Contact on WhatsApp
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</header>

{{-- Mobile Menu Script --}}
@pushOnce('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';

            menuToggle.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.setAttribute('aria-hidden', isExpanded);
            mobileMenu.classList.toggle('is-open');
            menuToggle.classList.toggle('is-active');

            // Prevent body scroll when menu is open
            document.body.classList.toggle('menu-open', !isExpanded);
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('is-open')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
                mobileMenu.classList.remove('is-open');
                menuToggle.classList.remove('is-active');
                document.body.classList.remove('menu-open');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenu.classList.contains('is-open') &&
                !mobileMenu.contains(e.target) &&
                !menuToggle.contains(e.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
                mobileMenu.classList.remove('is-open');
                menuToggle.classList.remove('is-active');
                document.body.classList.remove('menu-open');
            }
        });
    }
});
</script>
@endPushOnce
