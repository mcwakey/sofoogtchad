@extends('layouts.app')

@section('title', trans_setting('site_name', 'Sofoodtchad') . ' - ' . __('process.title'))

@section('meta_description', trans_setting('process_meta_description', __('process.description')))

@section('content')
    {{-- ==================== PAGE HEADER ==================== --}}
    <section class="relative bg-gradient-to-br from-green-600 to-green-800 py-16 md:py-24">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-block text-green-200 font-semibold text-sm uppercase tracking-wider mb-4">
                    {{ trans_setting('process_page_subtitle', __('process.subtitle')) }}
                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                    {{ trans_setting('process_page_title', __('process.title')) }}
                </h1>
                <p class="text-lg text-green-100">
                    {{ trans_setting('process_page_description', __('process.description')) }}
                </p>
            </div>
        </div>
    </section>

    {{-- ==================== PROCESS STEPS ==================== --}}
    @if(isset($steps) && $steps->count() > 0)
        <section class="py-16 md:py-24 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                {{-- Section Header --}}
                <div class="text-center mb-16">
                    <span class="inline-block text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider mb-2">
                        {{ trans_setting('process_steps_subtitle', __('process.step_by_step')) }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        {{ trans_setting('process_steps_title', __('process.how_we_ensure_quality')) }}
                    </h2>
                </div>

                {{-- Desktop: Horizontal Timeline --}}
                <div class="hidden lg:block">
                    <div class="relative">
                        {{-- Connection Line --}}
                        <div class="absolute top-16 left-0 right-0 h-1 bg-gradient-to-r from-green-200 via-green-400 to-green-600 dark:from-green-900 dark:via-green-700 dark:to-green-500"></div>

                        {{-- Steps --}}
                        <div class="grid grid-cols-{{ min($steps->count(), 6) }} gap-4 relative">
                            @foreach($steps as $index => $step)
                                <div class="flex flex-col items-center text-center">
                                    {{-- Step Number Circle --}}
                                    <div class="relative z-10 w-32 h-32 bg-white dark:bg-gray-800 rounded-full shadow-xl dark:shadow-gray-900/50 flex items-center justify-center mb-6 border-4 border-green-500">
                                        <div class="text-center">
                                            <span class="block text-4xl font-bold text-green-600 dark:text-green-400">{{ str_pad($step->sort_order ?? $index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $step->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $step->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Tablet: 2-Column Grid --}}
                <div class="hidden md:grid lg:hidden grid-cols-2 gap-8">
                    @foreach($steps as $index => $step)
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8">
                            <div class="flex items-start gap-6">
                                {{-- Step Number --}}
                                <div class="flex-shrink-0 w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    {{ str_pad($step->sort_order ?? $index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                {{-- Content --}}
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $step->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $step->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Mobile: Vertical Timeline --}}
                <div class="md:hidden">
                    <div class="relative">
                        {{-- Vertical Line --}}
                        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-green-200 dark:bg-green-800"></div>

                        {{-- Steps --}}
                        <div class="space-y-8">
                            @foreach($steps as $index => $step)
                                <div class="relative flex items-start gap-6 pl-4">
                                    {{-- Step Number --}}
                                    <div class="relative z-10 flex-shrink-0 w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white text-lg font-bold shadow-lg ring-4 ring-white dark:ring-gray-900">
                                        {{ $step->sort_order ?? $index + 1 }}
                                    </div>

                                    {{-- Content Card --}}
                                    <div class="flex-1 bg-white dark:bg-gray-800 rounded-xl shadow-md dark:shadow-gray-900/30 p-5">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $step->title }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $step->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        {{-- Empty State --}}
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h3 class="mt-4 text-xl font-medium text-gray-900 dark:text-white">Process information coming soon</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">We're working on documenting our quality process. Check back later.</p>
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== QUALITY COMMITMENT SECTION ==================== --}}
    <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Content --}}
                <div>
                    <span class="inline-block text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider mb-2">
                        {{ trans_setting('quality_commitment_subtitle', __('process.our_promise')) }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                        {{ trans_setting('quality_commitment_title', __('process.quality_you_can_trust')) }}
                    </h2>
                    <div class="prose prose-lg text-gray-600 dark:text-gray-300 mb-8">
                        <p>{{ trans_setting('quality_commitment_description', __('process.quality_description')) }}</p>
                    </div>

                    {{-- Quality Features --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $qualityFeatures = [
                                ['icon' => 'shield-check', 'title' => __('process.quality_assured'), 'description' => __('process.quality_assured_desc')],
                                ['icon' => 'leaf', 'title' => __('process.natural'), 'description' => __('process.natural_desc')],
                                ['icon' => 'users', 'title' => __('process.expert_team'), 'description' => __('process.expert_team_desc')],
                                ['icon' => 'badge-check', 'title' => __('process.certified'), 'description' => __('process.certified_desc')],
                            ];
                        @endphp
                        @foreach($qualityFeatures as $feature)
                            <div class="flex items-start gap-3 p-4 bg-white dark:bg-gray-700 rounded-xl shadow-sm dark:shadow-gray-900/30">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($feature['icon'] === 'shield-check')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        @elseif($feature['icon'] === 'leaf')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                        @elseif($feature['icon'] === 'users')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $feature['title'] }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $feature['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Image --}}
                <div class="relative">
                    <img
                        src="{{ setting('quality_commitment_image', 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&h=500&fit=crop') }}"
                        alt="Quality Process"
                        class="rounded-2xl shadow-xl dark:shadow-gray-900/50 w-full h-auto object-cover"
                    >
                    {{-- Decorative elements --}}
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-100 dark:bg-green-900/30 rounded-2xl -z-10"></div>
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== STATS SECTION ==================== --}}
    <section class="py-16 bg-green-600">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @php
                    $stats = [
                        ['value' => setting('stat_years', '10+'), 'label' => __('process.years_excellence')],
                        ['value' => setting('stat_products', '50+'), 'label' => __('process.quality_products')],
                        ['value' => setting('stat_customers', '10K+'), 'label' => __('process.happy_customers')],
                        ['value' => setting('stat_quality', '100%'), 'label' => __('process.quality_tested')],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div>
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $stat['value'] }}</div>
                        <div class="text-green-100">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CTA SECTION ==================== --}}
    <section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ trans_setting('process_cta_title', __('process.experience_quality')) }}
            </h2>
            <p class="text-gray-600 dark:text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
                {{ trans_setting('process_cta_description', __('process.experience_quality_desc')) }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('products.index') }}" class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                    {{ __('process.explore_products') }}
                </a>
                <a href="/contact" class="px-8 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:border-green-600 hover:text-green-600 dark:hover:border-green-400 dark:hover:text-green-400 transition-colors duration-200">
                    {{ __('general.contact_us') }}
                </a>
            </div>
        </div>
    </section>
@endsection
