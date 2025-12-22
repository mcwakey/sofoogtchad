@props([
    'type' => 'primary',
    'text' => '',
    'url' => null,
    'href' => null,
    'target' => null,
    'disabled' => false,
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'submit' => false,
])

@php
    $link = $url ?? $href;

    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-6 py-3 text-lg',
        'xl' => 'px-8 py-4 text-xl',
        default => 'px-4 py-2 text-base',
    };

    $typeClasses = match($type) {
        'primary' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 active:bg-green-800',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500 active:bg-gray-800',
        'outline' => 'border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white focus:ring-green-500',
        'outline-secondary' => 'border-2 border-gray-600 text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-500',
        'ghost' => 'text-green-600 hover:bg-green-50 focus:ring-green-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 active:bg-red-800',
        'white' => 'bg-white text-gray-900 hover:bg-gray-100 focus:ring-gray-300 shadow-sm',
        default => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 active:bg-green-800',
    };

    $classes = "{$baseClasses} {$sizeClasses} {$typeClasses}";
@endphp

@if($link)
    <a
        href="{{ $link }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if($target) target="{{ $target }}" @endif
        @if($target === '_blank') rel="noopener noreferrer" @endif
    >
        @if($icon && $iconPosition === 'left')
            <span class="mr-2">{!! $icon !!}</span>
        @endif

        {{ $text ?: $slot }}

        @if($icon && $iconPosition === 'right')
            <span class="ml-2">{!! $icon !!}</span>
        @endif
    </a>
@else
    <button
        type="{{ $submit ? 'submit' : 'button' }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if($disabled) disabled @endif
    >
        @if($icon && $iconPosition === 'left')
            <span class="mr-2">{!! $icon !!}</span>
        @endif

        {{ $text ?: $slot }}

        @if($icon && $iconPosition === 'right')
            <span class="ml-2">{!! $icon !!}</span>
        @endif
    </button>
@endif
