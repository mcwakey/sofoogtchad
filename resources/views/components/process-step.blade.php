@props([
    'stepNumber' => null,
    'step_number' => null,
    'title' => '',
    'description' => '',
    'icon' => null,
    'image' => null,
    'layout' => 'vertical',
    'iconBgColor' => 'green',
])

@php
    $number = $stepNumber ?? $step_number;
    $iconOrImage = $icon ?? $image;

    $bgColors = [
        'green' => 'bg-green-100 text-green-600',
        'blue' => 'bg-blue-100 text-blue-600',
        'orange' => 'bg-orange-100 text-orange-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
        'red' => 'bg-red-100 text-red-600',
        'purple' => 'bg-purple-100 text-purple-600',
    ];

    $bgClass = $bgColors[$iconBgColor] ?? $bgColors['green'];
@endphp

@if($layout === 'horizontal')
    {{-- Horizontal Layout --}}
    <div {{ $attributes->merge(['class' => 'process-step flex flex-col sm:flex-row items-start gap-4 sm:gap-6']) }}>
        {{-- Step Number & Icon --}}
        <div class="flex-shrink-0 flex items-center gap-4">
            @if($number)
                <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center text-xl font-bold shadow-lg">
                    {{ $number }}
                </div>
            @endif

            @if($iconOrImage)
                <div class="w-16 h-16 rounded-xl {{ $bgClass }} flex items-center justify-center">
                    @if(Str::startsWith($iconOrImage, '<svg') || Str::startsWith($iconOrImage, '<img'))
                        {!! $iconOrImage !!}
                    @else
                        <img src="{{ $iconOrImage }}" alt="{{ $title }}" class="w-10 h-10 object-contain">
                    @endif
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-1">
            @if($title)
                <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $title }}</h3>
            @endif
            @if($description)
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $description }}</p>
            @endif

            @if($slot->isNotEmpty())
                <div class="mt-3">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
@else
    {{-- Vertical Layout (default) --}}
    <div {{ $attributes->merge(['class' => 'process-step text-center']) }}>
        {{-- Step Number --}}
        @if($number)
            <div class="w-14 h-14 mx-auto rounded-full bg-green-600 text-white flex items-center justify-center text-2xl font-bold shadow-lg mb-4">
                {{ $number }}
            </div>
        @endif

        {{-- Icon/Image --}}
        @if($iconOrImage)
            <div class="w-20 h-20 mx-auto rounded-2xl {{ $bgClass }} flex items-center justify-center mb-4">
                @if(Str::startsWith($iconOrImage, '<svg') || Str::startsWith($iconOrImage, '<img'))
                    {!! $iconOrImage !!}
                @else
                    <img src="{{ $iconOrImage }}" alt="{{ $title }}" class="w-12 h-12 object-contain">
                @endif
            </div>
        @endif

        {{-- Title --}}
        @if($title)
            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $title }}</h3>
        @endif

        {{-- Description --}}
        @if($description)
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $description }}</p>
        @endif

        {{-- Extra Content Slot --}}
        @if($slot->isNotEmpty())
            <div class="mt-4">
                {{ $slot }}
            </div>
        @endif
    </div>
@endif
