@props([
    'title' => '',
    'subtitle' => null,
    'description' => '',
    'image' => null,
    'imageAlt' => null,
    'imagePosition' => 'left',
    'reverse' => false,
])

@php
    $isReversed = $reverse || $imagePosition === 'right';
@endphp

<section {{ $attributes->merge(['class' => 'about-snippet py-12 md:py-16']) }}>
    <div class="container mx-auto px-4">
        <div class="flex flex-col {{ $isReversed ? 'lg:flex-row-reverse' : 'lg:flex-row' }} items-center gap-8 lg:gap-12">
            {{-- Image --}}
            @if($image)
                <div class="w-full lg:w-1/2">
                    <div class="relative rounded-2xl overflow-hidden shadow-lg">
                        <img
                            src="{{ $image }}"
                            alt="{{ $imageAlt ?? $title }}"
                            class="w-full h-64 sm:h-80 lg:h-96 object-cover"
                            loading="lazy"
                        >
                        {{-- Decorative element --}}
                        <div class="absolute -bottom-4 {{ $isReversed ? '-left-4' : '-right-4' }} w-24 h-24 bg-green-500/20 rounded-full blur-2xl"></div>
                    </div>
                </div>
            @endif

            {{-- Content --}}
            <div class="w-full {{ $image ? 'lg:w-1/2' : '' }}">
                {{-- Subtitle --}}
                @if($subtitle)
                    <span class="inline-block text-green-600 font-semibold text-sm uppercase tracking-wider mb-2">
                        {{ $subtitle }}
                    </span>
                @endif

                {{-- Title --}}
                @if($title)
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        {{ $title }}
                    </h2>
                @endif

                {{-- Description --}}
                @if($description)
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        {!! nl2br(e($description)) !!}
                    </div>
                @endif

                {{-- Extra Content Slot --}}
                @if($slot->isNotEmpty())
                    <div class="mt-6">
                        {{ $slot }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
