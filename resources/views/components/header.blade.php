@props([
    'logoUrl' => null,
    'logoAlt' => null,
])

@php
    $siteName = trans_setting('site_name', 'Sofoodtchad');
    $siteLogo = $logoUrl ?? setting('site_logo');
    $logoAltText = $logoAlt ?? $siteName;

    $navItems = [
        ['label' => __('navigation.home'), 'route' => '/', 'active' => request()->is('/'), 'icon' => 'home'],
        ['label' => __('navigation.about'), 'route' => '/about', 'active' => request()->is('about'), 'icon' => 'info'],
        ['label' => __('navigation.products'), 'route' => '/products', 'active' => request()->is('products*'), 'icon' => 'box'],
        ['label' => __('navigation.process'), 'route' => '/process', 'active' => request()->is('process*'), 'icon' => 'cog'],
        ['label' => __('navigation.partners'), 'route' => '/partners', 'active' => request()->is('partners*'), 'icon' => 'users'],
        ['label' => __('navigation.blog'), 'route' => '/blog', 'active' => request()->is('blog*'), 'icon' => 'newspaper'],
        ['label' => __('navigation.contact'), 'route' => '/contact', 'active' => request()->is('contact'), 'icon' => 'mail'],
    ];
@endphp

<header
    x-data="{
        scrollProgress: 0,
        mobileMenuOpen: false,
        updateScroll() {
            // Calculate scroll progress from 0 to 1 over 150px
            this.scrollProgress = Math.min(window.scrollY / 150, 1);
        }
    }"
    x-init="window.addEventListener('scroll', () => updateScroll())"
    :style="`background-color: rgba(255, 255, 255, ${0.15 + (scrollProgress * 0.8)}); backdrop-filter: blur(${12 + (scrollProgress * 12)}px);`"
    :class="{
        'shadow-lg shadow-black/5 dark:shadow-black/30': scrollProgress > 0.5,
        'dark:!bg-gray-900/95': scrollProgress > 0.5
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-shadow duration-300 ease-out"
    role="banner"
>
    {{-- Top accent line --}}
    <div :style="`opacity: ${scrollProgress}`" class="h-0.5 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-[72px]">

            {{-- Logo --}}
            <div class="flex-shrink-0 relative z-10">
                <a
                    href="{{ url('/') }}"
                    class="group flex items-center gap-3"
                    aria-label="{{ $siteName }} - Home"
                >
                    @if($siteLogo)
                        @php
                            $logoUrl = Str::startsWith($siteLogo, ['http://', 'https://']) ? $siteLogo : asset($siteLogo);
                        @endphp
                        <div class="relative flex items-center">
                            <img
                                src="{{ $logoUrl }}"
                                alt="{{ $logoAltText }}"
                                :class="scrollProgress > 0.5 ? 'brightness-110 saturate-110' : 'brightness-0 invert drop-shadow-lg'"
                                class="h-12 lg:h-14 max-w-[180px] lg:max-w-[220px] w-auto object-contain transition-all duration-300 group-hover:scale-105"
                                loading="eager"
                            >
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            {{-- Logo Icon --}}
                            <div :class="scrollProgress > 0.5 ? 'bg-green-600' : 'bg-white/30'" class="w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-105">
                                <svg :class="scrollProgress > 0.5 ? 'text-white' : 'text-white'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            {{-- Logo Text --}}
                            <span :class="scrollProgress > 0.5 ? 'text-gray-900 dark:text-white' : 'text-white drop-shadow-md'" class="text-lg lg:text-xl font-bold tracking-tight transition-colors duration-300">
                                {{ $siteName }}
                            </span>
                        </div>
                    @endif
                </a>
            </div>

            {{-- Desktop Navigation - Centered --}}
            <nav class="hidden lg:flex items-center" role="navigation" aria-label="{{ __('navigation.main_navigation') }}">
                <div class="flex items-center gap-1 px-2 py-2 rounded-full transition-all duration-300">
                    @foreach($navItems as $item)
                        <a
                            href="{{ url($item['route']) }}"
                            :class="scrollProgress > 0.5
                                ? '{{ $item['active']
                                    ? 'bg-white dark:bg-gray-700 text-green-600 dark:text-green-400 shadow-sm'
                                    : 'text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-white/60 dark:hover:bg-gray-700/60' }}'
                                : '{{ $item['active']
                                    ? 'bg-white/30 text-white shadow-sm'
                                    : 'text-white hover:text-white hover:bg-white/20' }}'"
                            class="relative px-4 py-2.5 text-[15px] font-semibold rounded-full transition-all duration-200"
                            @if($item['active']) aria-current="page" @endif
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </nav>

            {{-- Header Actions --}}
            <div class="flex items-center gap-1 sm:gap-2">
                {{-- Language Switcher --}}
                <div :class="scrollProgress > 0.5
                    ? '[&_button]:text-gray-700 [&_button]:dark:text-gray-200 [&_button]:font-semibold [&_button]:bg-gray-100/80 [&_button]:dark:bg-gray-800/80 [&_button:hover]:bg-gray-200 [&_button]:dark:hover:bg-gray-700 [&_button]:rounded-full'
                    : '[&_button]:text-white [&_button]:font-semibold [&_button]:bg-white/15 [&_button:hover]:bg-white/30 [&_button]:rounded-full [&_button]:drop-shadow-md'">
                    <x-language-switcher />
                </div>

                {{-- Theme Toggle --}}
                <div :class="scrollProgress > 0.5
                    ? '[&_button]:text-gray-700 [&_button]:dark:text-gray-200 [&_button]:bg-gray-100/80 [&_button]:dark:bg-gray-800/80 [&_button:hover]:bg-gray-200 [&_button]:dark:hover:bg-gray-700 [&_button]:rounded-full'
                    : '[&_button]:text-white [&_button]:bg-white/15 [&_button:hover]:bg-white/30 [&_button]:rounded-full [&_button]:drop-shadow-md'">
                    <x-theme-toggle />
                </div>

                {{-- Mobile Menu Toggle --}}
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    :class="scrollProgress > 0.5
                        ? 'text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800'
                        : 'text-white hover:text-white hover:bg-white/20 drop-shadow-sm'"
                    class="lg:hidden relative inline-flex items-center justify-center w-10 h-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200"
                    aria-label="{{ __('navigation.toggle_menu') }}"
                    :aria-expanded="mobileMenuOpen"
                    aria-controls="mobile-menu"
                >
                    {{-- Hamburger to X animation --}}
                    <div class="w-5 h-4 flex flex-col justify-between">
                        <span
                            :class="mobileMenuOpen ? 'rotate-45 translate-y-1.5' : ''"
                            class="block h-0.5 w-5 bg-current rounded-full transition-all duration-300 ease-out origin-center"
                        ></span>
                        <span
                            :class="mobileMenuOpen ? 'opacity-0 scale-0' : 'opacity-100'"
                            class="block h-0.5 w-5 bg-current rounded-full transition-all duration-200"
                        ></span>
                        <span
                            :class="mobileMenuOpen ? '-rotate-45 -translate-y-1.5' : ''"
                            class="block h-0.5 w-5 bg-current rounded-full transition-all duration-300 ease-out origin-center"
                        ></span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div
        id="mobile-menu"
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.away="mobileMenuOpen = false"
        @keydown.escape.window="mobileMenuOpen = false"
        class="lg:hidden absolute left-0 right-0 top-full bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-t border-gray-200/50 dark:border-gray-700/50 shadow-xl shadow-gray-900/10 dark:shadow-black/30"
        role="navigation"
        aria-label="{{ __('navigation.mobile_navigation') }}"
        x-cloak
    >
        <div class="container mx-auto px-4 py-6">
            <div class="grid gap-1">
                @foreach($navItems as $item)
                    <a
                        href="{{ url($item['route']) }}"
                        @click="mobileMenuOpen = false"
                        class="group flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all duration-200
                            {{ $item['active']
                                ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}"
                        @if($item['active']) aria-current="page" @endif
                    >
                        {{-- Nav Icon --}}
                        <span class="{{ $item['active'] ? 'bg-green-100 dark:bg-green-800/50' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-gray-200 dark:group-hover:bg-gray-700' }} w-10 h-10 rounded-lg flex items-center justify-center transition-colors">
                            @switch($item['icon'])
                                @case('home')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    @break
                                @case('info')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @break
                                @case('box')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    @break
                                @case('cog')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    @break
                                @case('users')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    @break
                                @case('newspaper')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    @break
                                @case('mail')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @break
                            @endswitch
                        </span>

                        {{-- Nav Label --}}
                        <span class="text-base font-medium">{{ $item['label'] }}</span>

                        {{-- Active Indicator --}}
                        @if($item['active'])
                            <span class="ml-auto w-2 h-2 rounded-full bg-green-500"></span>
                        @else
                            <svg class="ml-auto w-5 h-5 text-gray-400 dark:text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>
