@extends('layouts.app')

@section('title', $pageTitle ?? trans_setting('site_name', 'Sofoodtchad') . ' - ' . trans_setting('site_tagline', 'Quality Food Products'))

@section('meta_description', $metaDescription ?? trans_setting('site_description'))

@section('content')
    {{-- ==================== HERO SLIDER SECTION ==================== --}}
    @php
        // Build slides array from hero data
        $heroSlides = $heroSlides ?? [];

        // If no slides provided, create default slides from hero data
        if (empty($heroSlides)) {
            $heroSlides = [
                [
                    'background_image' => $hero['background_image'] ?? null,
                    'title' => $hero['title'] ?? trans_setting('site_name', 'Welcome to Sofoodtchad'),
                    'subtitle' => $hero['subtitle'] ?? trans_setting('site_tagline', 'Premium Quality Food Products'),
                    'cta_text' => $hero['cta_text'] ?? __('home.view_all_products'),
                    'cta_url' => $hero['cta_url'] ?? '/products',
                    'secondary_cta_text' => $hero['secondary_cta_text'] ?? null,
                    'secondary_cta_url' => $hero['secondary_cta_url'] ?? null,
                ],
                [
                    'background_image' => $hero['slide2_image'] ?? $hero['background_image'] ?? null,
                    'title' => __('home.quality_trust'),
                    'subtitle' => __('home.process_subtitle'),
                    'cta_text' => __('general.our_process'),
                    'cta_url' => '/process',
                    'secondary_cta_text' => __('general.contact_us'),
                    'secondary_cta_url' => '/contact',
                ],
                [
                    'background_image' => $hero['slide3_image'] ?? $hero['background_image'] ?? null,
                    'title' => __('home.partner_with_us'),
                    'subtitle' => __('home.partners_subtitle'),
                    'cta_text' => __('home.become_partner'),
                    'cta_url' => '/partners',
                    'secondary_cta_text' => __('general.learn_more'),
                    'secondary_cta_url' => '/about',
                ],
            ];
        }
    @endphp

    <x-hero-slider
        :slides="$heroSlides"
        :autoplay="true"
        :interval="6000"
        height="full"
        :showDots="true"
        :showArrows="true"
    />

    {{-- ==================== ABOUT SNIPPET SECTION ==================== --}}
    @if($about)
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Image Column --}}
                    @if($about['image'])
                        <div class="order-2 lg:order-1">
                            <div class="relative">
                                <img
                                    src="{{ $about['image'] }}"
                                    alt="About {{ trans_setting('site_name', 'Sofoodtchad') }}"
                                    class="rounded-2xl shadow-xl dark:shadow-gray-900/50 w-full h-auto object-cover"
                                    onerror="this.style.display='none'"
                                >
                                {{-- Decorative element --}}
                                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-100 dark:bg-green-900/30 rounded-2xl -z-10"></div>
                                <div class="absolute -top-6 -left-6 w-24 h-24 bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl -z-10"></div>
                            </div>
                        </div>
                    @endif

                    {{-- Content Column --}}
                    <div class="{{ $about['image'] ? 'order-1 lg:order-2' : 'col-span-full text-center max-w-3xl mx-auto' }}">
                        @if($about['subtitle'])
                            <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                                {{ $about['subtitle'] }}
                            </span>
                        @endif
                        @if($about['title'])
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mt-2 mb-6">
                                {{ $about['title'] }}
                            </h2>
                        @endif
                        @if($about['description'])
                            <div class="prose prose-lg text-gray-600 dark:text-gray-300 mb-8">
                                <p>{{ $about['description'] }}</p>
                            </div>
                        @endif

                        {{-- Features List --}}
                        @if(!empty($about['features']))
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 {{ !$about['image'] ? 'justify-center' : '' }}">
                                @foreach($about['features'] as $feature)
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- CTA Button --}}
                        @if($about['cta_text'] && $about['cta_url'])
                            <a href="{{ $about['cta_url'] }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                                {{ $about['cta_text'] }}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== PRODUCT HIGHLIGHTS SECTION ==================== --}}
    @if(isset($products) && count($products) > 0)
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <x-product-grid
                    :products="$products"
                    :title="$productsSection['title'] ?? __('home.products_title')"
                    :subtitle="$productsSection['subtitle'] ?? __('home.products_subtitle')"
                    :viewAllUrl="$productsSection['view_all_url'] ?? '/products'"
                    :viewAllText="$productsSection['view_all_text'] ?? __('home.view_all_products')"
                    :columns="$productsSection['columns'] ?? 4"
                />
            </div>
        </section>
    @endif

    {{-- ==================== QUALITY & PROCESS SECTION ==================== --}}
    @if(isset($processSteps) && count($processSteps) > 0)
        @php
            $processBgImage = setting('homepage_process_bg_image');
        @endphp
        <section class="py-16 relative overflow-hidden transition-colors duration-200">
            {{-- Background Image --}}
            @if($processBgImage)
                <div class="absolute inset-0 z-0">
                    <img src="{{ $processBgImage }}" alt="" class="w-full h-full object-cover blur-lg scale-105 opacity-30">
                </div>
                <div class="absolute inset-0 z-0 bg-white/95 dark:bg-gray-900/05"></div>
            @else
                <div class="absolute inset-0 bg-white dark:bg-gray-900"></div>
            @endif

            <div class="container mx-auto px-4 relative z-10">
                {{-- Section Header --}}
                <div class="text-center mb-12">
                    @if(isset($processSection['subtitle']))
                        <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                            {{ $processSection['subtitle'] }}
                        </span>
                    @endif
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ $processSection['title'] ?? __('home.process_title') }}
                    </h2>
                    @if(isset($processSection['description']))
                        <p class="text-gray-600 dark:text-gray-300 mt-2 max-w-2xl mx-auto">
                            {{ $processSection['description'] }}
                        </p>
                    @endif
                </div>

                {{-- Process Steps Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(count($processSteps), 4) }} gap-8">
                    @foreach($processSteps as $index => $step)
                        <x-process-step
                            :step_number="$step->sort_order ?? $index + 1"
                            :title="$step->title"
                            :description="$step->description ?? ''"
                            :icon="$step->icon ?? null"
                            :iconBgColor="$step->icon_color ?? 'green'"
                        />
                    @endforeach
                </div>

                {{-- View More Link --}}
                @if(isset($processSection['cta_url']))
                    <div class="text-center mt-10">
                        <x-button
                            type="outline"
                            :text="$processSection['cta_text'] ?? __('home.learn_more_process')"
                            :url="$processSection['cta_url']"
                        />
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ==================== PARTNERS SECTION ==================== --}}
    @if(isset($partners) && count($partners) > 0)
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="container mx-auto px-4">
                {{-- Section Header --}}
                <div class="text-center mb-12">
                    @if(isset($partnersSection['subtitle']))
                        <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                            {{ $partnersSection['subtitle'] }}
                        </span>
                    @endif
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ $partnersSection['title'] ?? __('home.partners_title') }}
                    </h2>
                    @if(isset($partnersSection['description']))
                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            {{ $partnersSection['description'] }}
                        </p>
                    @endif
                </div>

                {{-- Partners Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-{{ min(count($partners), 6) }} gap-6">
                    @foreach($partners as $partner)
                        <x-partner-card
                            :name="$partner->name"
                            :logo_image="$partner->logo ?? null"
                            :link="$partner->website ?? null"
                        />
                    @endforeach
                </div>

                {{-- CTA Button --}}
                @if(isset($partnersSection['cta_url']))
                    <div class="text-center mt-10">
                        <x-button
                            type="outline"
                            :text="$partnersSection['cta_text'] ?? __('home.become_partner')"
                            :url="$partnersSection['cta_url']"
                        />
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ==================== BLOG HIGHLIGHTS SECTION (Optional) ==================== --}}
    @if(isset($posts) && count($posts) > 0)
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                {{-- Section Header --}}
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8">
                    <div>
                        @if(isset($blogSection['subtitle']))
                            <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                                {{ $blogSection['subtitle'] }}
                            </span>
                        @endif
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $blogSection['title'] ?? __('home.blog_title') }}
                        </h2>
                    </div>
                    @if(isset($blogSection['view_all_url']))
                        <a href="{{ $blogSection['view_all_url'] }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 mt-4 sm:mt-0">
                            {{ $blogSection['view_all_text'] ?? __('home.view_all_posts') }}
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    @endif
                </div>

                {{-- Posts Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <x-post-card
                            :title="$post->title"
                            :summary="$post->excerpt ?? Str::limit($post->content, 150)"
                            :image="$post->featured_image ?? null"
                            :link="route('blog.show', $post->slug)"
                            :published_date="$post->published_at ?? $post->created_at"
                            :category="$post->category ?? null"
                        />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== CTA SECTION (Optional) ==================== --}}
    @if(isset($cta) && $cta)
        <section class="py-20 bg-green-600">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    {{ $cta['title'] ?? __('home.cta_title') }}
                </h2>
                @if(isset($cta['description']))
                    <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">
                        {{ $cta['description'] }}
                    </p>
                @endif
                <div class="flex flex-wrap justify-center gap-4">
                    @if(isset($cta['primary_text']) && isset($cta['primary_url']))
                        <x-button
                            type="white"
                            :text="$cta['primary_text']"
                            :url="$cta['primary_url']"
                            size="lg"
                        />
                    @endif
                    @if(isset($cta['secondary_text']) && isset($cta['secondary_url']))
                        <x-button
                            type="outline"
                            :text="$cta['secondary_text']"
                            :url="$cta['secondary_url']"
                            size="lg"
                            class="border-white text-white hover:bg-white hover:text-green-600"
                        />
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection
