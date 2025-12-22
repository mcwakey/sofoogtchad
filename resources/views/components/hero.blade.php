@props([
    'backgroundImage' => null,
    'background_image' => null,
    'title' => '',
    'subtitle' => '',
    'ctaText' => null,
    'cta_text' => null,
    'ctaUrl' => null,
    'cta_url' => null,
    'ctaType' => 'primary',
    'secondaryCtaText' => null,
    'secondaryCtaUrl' => null,
    'overlay' => true,
    'overlayOpacity' => '50',
    'height' => 'lg',
    'align' => 'center',
])

@php
    $bgImage = $backgroundImage ?? $background_image;
    $buttonText = $ctaText ?? $cta_text;
    $buttonUrl = $ctaUrl ?? $cta_url;

    $heightClasses = match($height) {
        'sm' => 'min-h-[300px] py-16',
        'md' => 'min-h-[400px] py-20',
        'xl' => 'min-h-[600px] py-32',
        'full' => 'min-h-screen py-20',
        default => 'min-h-[500px] py-24', // lg
    };

    $alignClasses = match($align) {
        'left' => 'text-left items-start',
        'right' => 'text-right items-end',
        default => 'text-center items-center',
    };

    $overlayClass = match($overlayOpacity) {
        '30' => 'bg-black/30',
        '40' => 'bg-black/40',
        '60' => 'bg-black/60',
        '70' => 'bg-black/70',
        default => 'bg-black/50',
    };
@endphp

<section {{ $attributes->merge(['class' => "relative {$heightClasses} flex items-center"]) }}>
    {{-- Background Image --}}
    @if($bgImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $bgImage }}"
                alt="{{ $title }}"
                class="w-full h-full object-cover"
                loading="eager"
            >
            @if($overlay)
                <div class="absolute inset-0 {{ $overlayClass }}"></div>
            @endif
        </div>
    @else
        {{-- Default gradient background if no image --}}
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-green-700 via-green-600 to-green-800"></div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $alignClasses }} max-w-4xl {{ $align === 'center' ? 'mx-auto' : '' }}">
            {{-- Title --}}
            @if($title)
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    {{ $title }}
                </h1>
            @endif

            {{-- Subtitle --}}
            @if($subtitle)
                <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-8 max-w-2xl {{ $align === 'center' ? 'mx-auto' : '' }}">
                    {{ $subtitle }}
                </p>
            @endif

            {{-- Extra Content Slot --}}
            @if($slot->isNotEmpty())
                <div class="hero-extra mb-8">
                    {{ $slot }}
                </div>
            @endif

            {{-- CTA Buttons --}}
            @if($buttonText || $secondaryCtaText)
                <div class="flex flex-wrap gap-4 {{ $align === 'center' ? 'justify-center' : ($align === 'right' ? 'justify-end' : 'justify-start') }}">
                    @if($buttonText && $buttonUrl)
                        <x-button
                            :type="$ctaType"
                            :text="$buttonText"
                            :url="$buttonUrl"
                            size="lg"
                        />
                    @endif

                    @if($secondaryCtaText && $secondaryCtaUrl)
                        <x-button
                            type="outline"
                            :text="$secondaryCtaText"
                            :url="$secondaryCtaUrl"
                            size="lg"
                            class="border-white text-white hover:bg-white hover:text-gray-900"
                        />
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- Decorative Elements (optional) --}}
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg class="w-full h-12 sm:h-16 text-white" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,48 L1440,48 L1440,0 C1200,32 960,48 720,48 C480,48 240,32 0,0 L0,48 Z"></path>
        </svg>
    </div>
</section>
