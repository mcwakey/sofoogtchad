@props([
    'name' => '',
    'logoImage' => null,
    'logo_image' => null,
    'link' => null,
    'description' => null,
    'size' => 'md',
])

@php
    $logo = $logoImage ?? $logo_image;

    $sizeClasses = match($size) {
        'sm' => 'p-4 h-20',
        'lg' => 'p-8 h-40',
        default => 'p-6 h-28',
    };

    $imgSizeClasses = match($size) {
        'sm' => 'max-h-12',
        'lg' => 'max-h-24',
        default => 'max-h-16',
    };
@endphp

<div {{ $attributes->merge(['class' => 'partner-card bg-white dark:bg-gray-800 rounded-xl shadow-sm dark:shadow-gray-900/30 hover:shadow-md dark:hover:shadow-gray-900/50 transition-all duration-300 ' . $sizeClasses]) }}>
    @if($link)
        <a
            href="{{ $link }}"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center justify-center h-full w-full group"
            title="{{ $name }}"
        >
    @else
        <div class="flex items-center justify-center h-full w-full">
    @endif

        @if($logo)
            <img
                src="{{ $logo }}"
                alt="{{ $name }}"
                class="{{ $imgSizeClasses }} max-w-full object-contain grayscale hover:grayscale-0 opacity-70 hover:opacity-100 transition-all duration-300"
                loading="lazy"
            >
        @else
            <span class="text-gray-600 dark:text-gray-300 font-semibold text-center">{{ $name }}</span>
        @endif

    @if($link)
        </a>
    @else
        </div>
    @endif

    {{-- Optional description tooltip --}}
    @if($description)
        <div class="sr-only">{{ $description }}</div>
    @endif
</div>

{{-- Alternative: Card with name visible --}}
@if($slot->isNotEmpty())
    <div class="mt-2 text-center">
        {{ $slot }}
    </div>
@endif
