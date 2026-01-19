@props([
    'slides' => [],
    'autoplay' => true,
    'interval' => 5000,
    'height' => 'lg',
    'overlay' => false,
    'overlayOpacity' => '50',
    'showDots' => true,
    'showArrows' => true,
])

@php
    $heightClasses = match($height) {
        'sm' => 'min-h-[400px] py-20',
        'md' => 'min-h-[600px] py-24',
        'lg' => 'min-h-[85vh] py-32',
        'full' => 'min-h-screen py-24',
        default => 'min-h-[85vh] py-32', // xl
    };

    $overlayClass = match($overlayOpacity) {
        '30' => 'bg-black/30',
        '40' => 'bg-black/40',
        '60' => 'bg-black/60',
        '70' => 'bg-black/70',
        default => 'bg-black/50',
    };

    // Ensure we have at least one slide
    if (empty($slides)) {
        $slides = [[
            'background_image' => null,
            'title' => trans_setting('site_name', 'Welcome to Sofoodtchad'),
            'subtitle' => trans_setting('site_tagline', 'Premium Quality Food Products'),
            'cta_text' => __('home.view_all_products'),
            'cta_url' => '/products',
        ]];
    }
@endphp

<section
    x-data="{
        currentSlide: 0,
        slides: {{ count($slides) }},
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        interval: {{ $interval }},
        timer: null,
        init() {
            if (this.autoplay && this.slides > 1) {
                this.startAutoplay();
            }
        },
        startAutoplay() {
            this.timer = setInterval(() => {
                this.next();
            }, this.interval);
        },
        stopAutoplay() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides) % this.slides;
        },
        goTo(index) {
            this.currentSlide = index;
            if (this.autoplay) {
                this.stopAutoplay();
                this.startAutoplay();
            }
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="if (autoplay && slides > 1) startAutoplay()"
    {{ $attributes->merge(['class' => "relative {$heightClasses} flex items-center overflow-hidden"]) }}
>
    {{-- Slides --}}
    @foreach($slides as $index => $slide)
        <div
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 transform scale-105"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="absolute inset-0"
        >
            {{-- Background Image --}}
            @if(!empty($slide['background_image']))
                @php
                    $bgImage = $slide['background_image'];
                    $bgImageUrl = Str::startsWith($bgImage, ['http://', 'https://']) ? $bgImage : asset($bgImage);
                @endphp
                <div class="absolute inset-0 z-0">
                    <img
                        src="{{ $bgImageUrl }}"
                        alt="{{ $slide['title'] ?? 'Slide ' . ($index + 1) }}"
                        class="w-full h-full object-cover"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
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
            <!-- <div class="relative z-10 h-full flex items-center">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center text-center max-w-4xl mx-auto">
                        {{-- Title --}}
                        @if(!empty($slide['title']))
                            <h1
                                x-show="currentSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700 delay-200"
                                x-transition:enter-start="opacity-0 transform translate-y-8"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight"
                            >
                                {{ $slide['title'] }}
                            </h1>
                        @endif

                        {{-- Subtitle --}}
                        @if(!empty($slide['subtitle']))
                            <p
                                x-show="currentSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700 delay-300"
                                x-transition:enter-start="opacity-0 transform translate-y-8"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="text-lg sm:text-xl md:text-2xl text-white/90 mb-8 max-w-2xl mx-auto"
                            >
                                {{ $slide['subtitle'] }}
                            </p>
                        @endif

                        {{-- CTA Buttons --}}
                        @if(!empty($slide['cta_text']) || !empty($slide['secondary_cta_text']))
                            <div
                                x-show="currentSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700 delay-400"
                                x-transition:enter-start="opacity-0 transform translate-y-8"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="flex flex-wrap gap-4 justify-center"
                            >
                                @if(!empty($slide['cta_text']) && !empty($slide['cta_url']))
                                    <a
                                        href="{{ $slide['cta_url'] }}"
                                        class="inline-flex items-center px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl"
                                    >
                                        {{ $slide['cta_text'] }}
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                @endif

                                @if(!empty($slide['secondary_cta_text']) && !empty($slide['secondary_cta_url']))
                                    <a
                                        href="{{ $slide['secondary_cta_url'] }}"
                                        class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-200"
                                    >
                                        {{ $slide['secondary_cta_text'] }}
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div> -->
        </div>
    @endforeach

    {{-- Navigation Arrows --}}
    @if($showArrows && count($slides) > 1)
        {{-- Previous Button --}}
        <button
            @click="prev()"
            class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/50 group"
            aria-label="Previous slide"
        >
            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        {{-- Next Button --}}
        <button
            @click="next()"
            class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/50 group"
            aria-label="Next slide"
        >
            <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    @endif

    {{-- Dots Navigation --}}
    @if($showDots && count($slides) > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
            @foreach($slides as $index => $slide)
                <button
                    @click="goTo({{ $index }})"
                    :class="currentSlide === {{ $index }} ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75'"
                    class="w-3 h-3 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif

    {{-- Decorative Wave --}}
    <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none">
        <svg class="w-full h-12 sm:h-16 text-white dark:text-gray-900" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,48 L1440,48 L1440,0 C1200,32 960,48 720,48 C480,48 240,32 0,0 L0,48 Z"></path>
        </svg>
    </div>
</section>
