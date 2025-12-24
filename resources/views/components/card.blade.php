@props([
    'image' => null,
    'imageAlt' => '',
    'title' => '',
    'description' => '',
    'link' => null,
    'linkText' => null,
    'badge' => null,
    'badgeColor' => 'green',
    'variant' => 'default',
    'hover' => true,
])

@php
    $linkText = $linkText ?? __('general.learn_more');

    $badgeColors = [
        'green' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
        'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300',
        'red' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
        'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
        'gray' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'orange' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300',
    ];

    $cardClasses = 'bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md dark:shadow-gray-900/30 border border-gray-100 dark:border-gray-600';
    if ($hover) {
        $cardClasses .= ' transition-all duration-300 hover:shadow-xl dark:hover:shadow-gray-900/50 hover:-translate-y-1';
    }

    $variantClasses = match($variant) {
        'horizontal' => 'flex flex-col md:flex-row',
        'compact' => '',
        default => '',
    };
@endphp

<article {{ $attributes->merge(['class' => "{$cardClasses} {$variantClasses}"]) }}>
    {{-- Image --}}
    @if($image)
        @php
            if (Str::startsWith($image, ['http://', 'https://'])) {
                $imageUrl = $image;
            } elseif (Str::startsWith($image, '/storage/')) {
                $imageUrl = asset($image);
            } else {
                $imageUrl = asset('storage/' . ltrim($image, '/'));
            }
        @endphp
        <div class="relative {{ $variant === 'horizontal' ? 'md:w-1/3 md:flex-shrink-0' : '' }}">
            @if($link)
                <a href="{{ $link }}" class="block">
            @endif

            <img
                src="{{ $imageUrl }}"
                alt="{{ $imageAlt ?: $title }}"
                class="w-full h-48 object-cover {{ $variant === 'horizontal' ? 'md:h-full' : '' }}"
                loading="lazy"
            >

            {{-- Badge --}}
            @if($badge)
                <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColors[$badgeColor] ?? $badgeColors['green'] }}">
                    {{ $badge }}
                </span>
            @endif

            @if($link)
                </a>
            @endif
        </div>
    @endif

    {{-- Content --}}
    <div class="p-5 {{ $variant === 'horizontal' ? 'md:flex md:flex-col md:justify-center' : '' }}">
        {{-- Title --}}
        @if($title)
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                @if($link)
                    <a href="{{ $link }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        {{ $title }}
                    </a>
                @else
                    {{ $title }}
                @endif
            </h3>
        @endif

        {{-- Description --}}
        @if($description)
            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                {{ $description }}
            </p>
        @endif

        {{-- Extra Content Slot --}}
        @if($slot->isNotEmpty())
            <div class="card-extra">
                {{ $slot }}
            </div>
        @endif

        {{-- Link --}}
        @if($link && $linkText)
            <a href="{{ $link }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium text-sm hover:text-green-700 dark:hover:text-green-300 transition-colors mt-auto">
                {{ $linkText }}
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif
    </div>
</article>
