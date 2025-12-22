@extends('layouts.app')

@section('title', setting('partners_page_title', 'Our Partners') . ' - ' . setting('site_name', 'Sofoodtchad'))
@section('description', setting('partners_page_description', 'Discover our network of trusted partners and distributors across Africa.'))

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    {{ setting('partners_page_title', 'Our Partners') }}
                </h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    {{ setting('partners_page_subtitle', 'Building strong relationships for quality and growth') }}
                </p>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    {{-- Featured Partners Section --}}
    @if($featuredPartners->count())
        <section class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                        {{ setting('partners_featured_title', 'Featured Partners') }}
                    </h2>
                    <p class="text-gray-600 max-w-xl mx-auto">
                        {{ setting('partners_featured_subtitle', 'Our key partners who help us deliver quality products across the region') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($featuredPartners as $partner)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                            {{-- Logo Section --}}
                            <div class="p-8 flex items-center justify-center bg-gradient-to-br from-gray-50 to-white border-b border-gray-100">
                                @if($partner->logo)
                                    <img
                                        src="{{ $partner->logo_url }}"
                                        alt="{{ $partner->name }}"
                                        class="max-h-20 max-w-full object-contain grayscale group-hover:grayscale-0 transition-all duration-300"
                                    >
                                @else
                                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl font-bold text-green-600">{{ substr($partner->name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content Section --}}
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $partner->name }}</h3>
                                @if($partner->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $partner->description }}</p>
                                @endif
                                @if($partner->website)
                                    <a href="{{ $partner->website }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center text-green-600 font-medium text-sm hover:text-green-700 transition-colors">
                                        Visit Website
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- All Partners Grid --}}
    <section class="py-12 md:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                    {{ setting('partners_all_title', 'All Partners') }}
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    {{ setting('partners_all_subtitle', 'Trusted partners in our mission to deliver quality food products') }}
                </p>
            </div>

            @if($partners->isEmpty())
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Partner Information Coming Soon</h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        We're updating our partner directory. Check back soon!
                    </p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                    @foreach($partners->where('is_featured', false) as $partner)
                        <x-partner-card
                            :name="$partner->name"
                            :logo-image="$partner->logo_url"
                            :link="$partner->website"
                            :description="$partner->description"
                            size="md"
                        />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Why Partner With Us --}}
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                    {{ setting('partners_why_title', 'Why Partner With Us?') }}
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    {{ setting('partners_why_subtitle', 'Join our network and grow together') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Benefit 1 --}}
                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Quality Products</h3>
                    <p class="text-gray-600 text-sm">Premium food products that meet international standards</p>
                </div>

                {{-- Benefit 2 --}}
                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Growth Support</h3>
                    <p class="text-gray-600 text-sm">Marketing materials and sales support to grow your business</p>
                </div>

                {{-- Benefit 3 --}}
                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Wide Coverage</h3>
                    <p class="text-gray-600 text-sm">Expanding distribution network across Africa</p>
                </div>

                {{-- Benefit 4 --}}
                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Dedicated Support</h3>
                    <p class="text-gray-600 text-sm">24/7 partner support and logistics assistance</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Become a Distributor CTA --}}
    <section class="py-16 md:py-20 bg-gradient-to-br from-green-700 via-green-600 to-green-500 relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white rounded-full"></div>
            <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white rounded-full"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="md:flex">
                    {{-- Left Side - Info --}}
                    <div class="md:w-1/2 p-8 md:p-10 bg-gradient-to-br from-green-800 to-green-700 text-white">
                        <h2 class="text-2xl md:text-3xl font-bold mb-4">
                            {{ setting('distributor_cta_title', 'Become a Distributor') }}
                        </h2>
                        <p class="text-green-100 mb-6">
                            {{ setting('distributor_cta_description', 'Join our growing network and bring quality food products to your region. We offer competitive margins and full support.') }}
                        </p>

                        <ul class="space-y-3">
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Exclusive territory rights
                            </li>
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Competitive profit margins
                            </li>
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Marketing & promotional support
                            </li>
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Training & product knowledge
                            </li>
                        </ul>
                    </div>

                    {{-- Right Side - Form CTA --}}
                    <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-center">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Ready to Get Started?</h3>
                        <p class="text-gray-600 mb-6">
                            Fill out our distributor application form and our team will contact you within 48 hours.
                        </p>
                        <a href="{{ route('partners.become-distributor') }}"
                           class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition-colors duration-200 shadow-lg hover:shadow-xl">
                            Apply Now
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>

                        <p class="mt-6 text-sm text-gray-500">
                            Have questions?
                            <a href="{{ route('contact.index') ?? '#' }}" class="text-green-600 hover:underline">Contact us</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
