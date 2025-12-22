@props([
    'image' => null,
    'imageAlt' => '',
    'title' => '',
    'description' => '',
    'link' => null,
    'linkText' => 'Learn More',
    'badge' => null,
    'badgeColor' => 'green',
    'variant' => 'default',
    'hover' => true,
])

@php
    $badgeColors = [
        'green' => 'bg-green-100 text-green-800',
        'blue' => 'bg-blue-100 text-blue-800',
        'red' => 'bg-red-100 text-red-800',
        'yellow' => 'bg-yellow-100 text-yellow-800',
        'gray' => 'bg-gray-100 text-gray-800',
        'orange' => 'bg-orange-100 text-orange-800',
    ];

    $cardClasses = 'bg-white rounded-xl overflow-hidden shadow-md';
    if ($hover) {
        $cardClasses .= ' transition-all duration-300 hover:shadow-xl hover:-translate-y-1';
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
        <div class="relative {{ $variant === 'horizontal' ? 'md:w-1/3 md:flex-shrink-0' : '' }}">
            @if($link)
                <a href="{{ $link }}" class="block">
            @endif

            <img
                src="{{ $image }}"
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
            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                @if($link)
                    <a href="{{ $link }}" class="hover:text-green-600 transition-colors">
                        {{ $title }}
                    </a>
                @else
                    {{ $title }}
                @endif
            </h3>
        @endif

        {{-- Description --}}
        @if($description)
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
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
            <a href="{{ $link }}" class="inline-flex items-center text-green-600 font-medium text-sm hover:text-green-700 transition-colors mt-auto">
                {{ $linkText }}
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif
    </div>
</article>
