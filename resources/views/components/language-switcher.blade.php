@props(['class' => ''])

@php
    $currentLocale = app()->getLocale();
    $locales = [
        'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'short' => 'FR'],
        'en' => ['name' => 'English', 'flag' => '🇬🇧', 'short' => 'EN'],
        'ar' => ['name' => 'العربية', 'flag' => '🇹🇩', 'short' => 'AR'],
    ];
@endphp

<div x-data="{ open: false }" class="relative {{ $class }}" @click.away="open = false">
    <button
        @click="open = !open"
        type="button"
        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
        aria-expanded="false"
        aria-haspopup="true"
    >
        <span class="text-lg">{{ $locales[$currentLocale]['flag'] }}</span>
        <span class="hidden sm:inline">{{ $locales[$currentLocale]['short'] }}</span>
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 rtl:right-auto rtl:left-0 mt-2 w-48 origin-top-right rounded-xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-white/10 focus:outline-none z-50"
        role="menu"
        aria-orientation="vertical"
        x-cloak
    >
        <div class="py-1">
            @foreach($locales as $code => $locale)
                <a
                    href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm {{ $currentLocale === $code ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors"
                    role="menuitem"
                >
                    <span class="text-lg">{{ $locale['flag'] }}</span>
                    <span class="flex-1">{{ $locale['name'] }}</span>
                    @if($currentLocale === $code)
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</div>
