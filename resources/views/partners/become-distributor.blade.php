@extends('layouts.app')

@section('title', 'Become a Distributor - ' . trans_setting('site_name', 'Sofoodtchad'))
@section('description', 'Partner with Sofoodtchad as a distributor. Expand your business with quality products.')

@section('content')
    {{-- Page Header with Wave --}}
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    {{ __('partners.become_distributor') }}
                </h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    {{ __('partners.distributor_subtitle') }}
                </p>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-white dark:fill-gray-900"/>
            </svg>
        </div>
    </section>

    {{-- Form Section --}}
    <section class="py-12 md:py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Link --}}
            <a href="{{ route('partners.index') }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 transition-colors mb-8">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                {{ __('partners.back_to_partners') }}
            </a>

            {{-- Form Card --}}
            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/30 p-6 md:p-10">
                {{-- Form Intro --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('partners.distribution_application') }}</h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('partners.form_description') }}</p>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-800 dark:text-green-300">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                {{-- Error Summary --}}
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-red-800 dark:text-red-300 font-medium">{{ __('general.please_correct_errors') }}</p>
                                <ul class="mt-1 text-sm text-red-700 dark:text-red-400 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('partners.distributor-request') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Company & Contact Name Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-field
                            type="text"
                            name="company_name"
                            :label="__('partners.company_name')"
                            :placeholder="__('partners.your_company_name')"
                            required
                            autocomplete="organization"
                        />

                        <x-form-field
                            type="text"
                            name="contact_name"
                            :label="__('partners.contact_name')"
                            :placeholder="__('partners.your_full_name')"
                            required
                            autocomplete="name"
                        />
                    </div>

                    {{-- Email & Phone Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-field
                            type="email"
                            name="email"
                            :label="__('contact.email_address')"
                            placeholder="you@example.com"
                            required
                            autocomplete="email"
                        />

                        <x-form-field
                            type="tel"
                            name="phone"
                            :label="__('contact.phone_number')"
                            placeholder="+235 00 00 00 00"
                            autocomplete="tel"
                        />
                    </div>

                    {{-- City & Country Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-field
                            type="text"
                            name="city"
                            :label="__('partners.city')"
                            :placeholder="__('partners.your_city')"
                        />

                        <x-form-field
                            type="text"
                            name="country"
                            :label="__('partners.country')"
                            :placeholder="__('partners.your_country')"
                        />
                    </div>

                    {{-- Message --}}
                    <x-form-field
                        type="textarea"
                        name="message"
                        :label="__('partners.about_your_business')"
                        :placeholder="__('partners.describe_your_business')"
                        :rows="5"
                    />

                    {{-- Submit Button --}}
                    <div class="pt-4">
                        <button type="submit" class="w-full md:w-auto px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            {{ __('partners.submit_application') }}
                        </button>
                    </div>
                </form>
            </div>

            {{-- Benefits Section --}}
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('partners.quality_products') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('partners.quality_products_desc') }}</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('partners.competitive_margins') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('partners.competitive_margins_desc') }}</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('partners.dedicated_support') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('partners.dedicated_support_desc') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
