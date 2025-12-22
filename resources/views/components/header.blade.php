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
        ['label' => 'Process', 'route' => '/process', 'active' => request()->is('process*')],
        ['label' => 'Partners', 'route' => '/partners', 'active' => request()->is('partners*')],
        ['label' => 'Blog', 'route' => '/blog', 'active' => request()->is('blog*')],
        ['label' => 'Contact', 'route' => '/contact', 'active' => request()->is('contact')],
    ];
@endphp

<header class="bg-white dark:bg-gray-900 shadow-sm dark:shadow-gray-800/20 sticky top-0 z-50 transition-colors duration-200" role="banner">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center" aria-label="{{ $siteName }} - Home">
                    @if($siteLogo)
                        <img
                            src="{{ $siteLogo }}"
                            alt="{{ $logoAltText }}"
                            class="h-10 lg:h-12 w-auto dark:brightness-110"
                            loading="eager"
                        >
                    @else
                        <span class="text-xl lg:text-2xl font-bold text-green-600 dark:text-green-400">{{ $siteName }}</span>
                    @endif
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center space-x-1" role="navigation" aria-label="Main navigation">
                @foreach($navItems as $item)
                    <a
                        href="{{ url($item['route']) }}"
                        class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200
                            {{ $item['active']
                                ? 'text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30'
                                : 'text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}"
                        @if($item['active']) aria-current="page" @endif
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Header Actions --}}
            <div class="flex items-center gap-2">
                {{-- Theme Toggle --}}
                <x-theme-toggle />

                {{-- CTA Button (WhatsApp) --}}
                @if($showCta && $whatsappNumber)
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-green-600 dark:bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-colors duration-200"
                        aria-label="Contact us on WhatsApp"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span>WhatsApp</span>
                    </a>
                @endif

                {{-- Mobile Menu Toggle --}}
                <button
                    type="button"
                    class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500"
                    aria-label="Toggle navigation menu"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    id="mobile-menu-button"
                >
                    <svg class="h-6 w-6 block" id="menu-icon-open" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 hidden" id="menu-icon-close" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div
        id="mobile-menu"
        class="lg:hidden hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800"
        role="navigation"
        aria-label="Mobile navigation"
    >
        <div class="container mx-auto px-4 py-4 space-y-1">
            @foreach($navItems as $item)
                <a
                    href="{{ url($item['route']) }}"
                    class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-200
                        {{ $item['active']
                            ? 'text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30'
                            : 'text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}"
                    @if($item['active']) aria-current="page" @endif
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            {{-- Mobile CTA --}}
            @if($showCta && $whatsappNumber)
                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800">
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-green-600 dark:bg-green-500 text-white text-base font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Contact on WhatsApp
                    </a>
                </div>
            @endif
        </div>
    </div>
</header>

{{-- Mobile Menu Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', function() {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';

            menuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconOpen.classList.toggle('block');
            iconClose.classList.toggle('hidden');
            iconClose.classList.toggle('block');
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                menuButton.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.add('hidden');
                iconOpen.classList.remove('hidden');
                iconOpen.classList.add('block');
                iconClose.classList.add('hidden');
                iconClose.classList.remove('block');
            }
        });
    }
});
</script>
