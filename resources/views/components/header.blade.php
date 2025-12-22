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
        ['label' => __('navigation.home'), 'route' => '/', 'active' => request()->is('/')],
        ['label' => __('navigation.about'), 'route' => '/about', 'active' => request()->is('about')],
        ['label' => __('navigation.products'), 'route' => '/products', 'active' => request()->is('products*')],
        ['label' => __('navigation.process'), 'route' => '/process', 'active' => request()->is('process*')],
        ['label' => __('navigation.partners'), 'route' => '/partners', 'active' => request()->is('partners*')],
        ['label' => __('navigation.blog'), 'route' => '/blog', 'active' => request()->is('blog*')],
        ['label' => __('navigation.contact'), 'route' => '/contact', 'active' => request()->is('contact')],
    ];
@endphp

<header
    x-data="{ scrolled: false, mobileMenuOpen: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-white dark:bg-gray-900 shadow-sm dark:shadow-gray-800/20' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out"
    role="banner"
>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center" aria-label="{{ $siteName }} - Home">
                    @if($siteLogo)
                        <img
                            src="{{ $siteLogo }}"
                            alt="{{ $logoAltText }}"
                            :class="scrolled ? '' : 'brightness-0 invert'"
                            class="h-10 lg:h-12 w-auto dark:brightness-110 transition-all duration-300"
                            loading="eager"
                        >
                    @else
                        <span :class="scrolled ? 'text-green-600 dark:text-green-400' : 'text-white'" class="text-xl lg:text-2xl font-bold transition-colors duration-300">{{ $siteName }}</span>
                    @endif
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1" role="navigation" aria-label="{{ __('navigation.main_navigation') }}">
                @foreach($navItems as $item)
                    <a
                        href="{{ url($item['route']) }}"
                        :class="scrolled
                            ? '{{ $item['active']
                                ? 'text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30'
                                : 'text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}'
                            : '{{ $item['active']
                                ? 'text-white bg-white/20'
                                : 'text-white/90 hover:text-white hover:bg-white/10' }}'"
                        class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200"
                        @if($item['active']) aria-current="page" @endif
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Header Actions --}}
            <div class="flex items-center gap-2">
                {{-- Language Switcher --}}
                <x-language-switcher />

                {{-- Theme Toggle --}}
                <x-theme-toggle />

                {{-- CTA Button (WhatsApp) --}}
                @if($showCta && $whatsappNumber)
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-green-600 dark:bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-colors duration-200"
                        aria-label="{{ __('general.contact_whatsapp') }}"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span>{{ __('general.whatsapp') }}</span>
                    </a>
                @endif

                {{-- Mobile Menu Toggle --}}
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    :class="scrolled ? 'text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 hover:bg-gray-100 dark:hover:bg-gray-800' : 'text-white hover:text-white hover:bg-white/10'"
                    class="lg:hidden inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500 transition-colors duration-300"
                    aria-label="{{ __('navigation.toggle_menu') }}"
                    :aria-expanded="mobileMenuOpen"
                    aria-controls="mobile-menu"
                    id="mobile-menu-button"
                >
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" id="menu-icon-open" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" id="menu-icon-close" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div
        id="mobile-menu"
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.away="mobileMenuOpen = false"
        @keydown.escape.window="mobileMenuOpen = false"
        class="lg:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 shadow-lg"
        role="navigation"
        aria-label="{{ __('navigation.mobile_navigation') }}"
        x-cloak
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
                        {{ __('general.contact_whatsapp') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</header>
