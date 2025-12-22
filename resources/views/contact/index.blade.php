@extends('layouts.app')

@section('title', setting('contact_page_title', 'Contact Us') . ' - ' . setting('site_name', 'Sofoodtchad'))
@section('description', setting('contact_page_description', 'Get in touch with Sofoodtchad. We\'re here to answer your questions and hear your feedback.'))

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
                    {{ setting('contact_page_title', 'Contact Us') }}
                </h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    {{ setting('contact_page_subtitle', 'We\'d love to hear from you. Get in touch with our team.') }}
                </p>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    {{-- Main Contact Section --}}
    <section class="py-12 md:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">

                {{-- Contact Form --}}
                <div class="order-2 lg:order-1">
                    <div class="bg-gray-50 rounded-2xl p-6 md:p-8 lg:p-10">
                        <x-contact-form
                            :form-action="$formAction ?? route('contact.submit')"
                            :submit-text="$submitText ?? 'Send Message'"
                            :title="setting('contact_form_title', 'Send us a Message')"
                            :subtitle="setting('contact_form_subtitle', 'Fill out the form below and we\'ll get back to you as soon as possible.')"
                            :show-phone="true"
                            :show-subject="true"
                        />
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="order-1 lg:order-2">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                        {{ setting('contact_info_title', 'Get in Touch') }}
                    </h2>
                    <p class="text-gray-600 mb-8">
                        {{ setting('contact_info_description', 'Have questions about our products? Want to become a distributor? Our team is here to help.') }}
                    </p>

                    {{-- Contact Details --}}
                    <div class="space-y-6">
                        {{-- Address --}}
                        @if(setting('contact_address'))
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Address</h3>
                                    <p class="text-gray-600 mt-1">{{ setting('contact_address') }}</p>
                                </div>
                            </div>
                        @endif

                        {{-- Phone --}}
                        @if(setting('contact_phone'))
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Phone</h3>
                                    <a href="tel:{{ setting('contact_phone') }}" class="text-gray-600 hover:text-green-600 transition-colors mt-1 block">
                                        {{ setting('contact_phone') }}
                                    </a>
                                    @if(setting('contact_phone_alt'))
                                        <a href="tel:{{ setting('contact_phone_alt') }}" class="text-gray-600 hover:text-green-600 transition-colors block">
                                            {{ setting('contact_phone_alt') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Email --}}
                        @if(setting('contact_email'))
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                                    <a href="mailto:{{ setting('contact_email') }}" class="text-gray-600 hover:text-green-600 transition-colors mt-1 block">
                                        {{ setting('contact_email') }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Business Hours --}}
                        @if(setting('contact_hours'))
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Business Hours</h3>
                                    <p class="text-gray-600 mt-1 whitespace-pre-line">{{ setting('contact_hours') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Social Links --}}
                    @if(setting('social_facebook') || setting('social_instagram') || setting('social_twitter') || setting('social_linkedin'))
                        <div class="mt-10 pt-8 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                            <div class="flex gap-4">
                                @if(setting('social_facebook'))
                                    <a href="{{ setting('social_facebook') }}" target="_blank" rel="noopener noreferrer"
                                       class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-green-100 hover:text-green-600 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if(setting('social_instagram'))
                                    <a href="{{ setting('social_instagram') }}" target="_blank" rel="noopener noreferrer"
                                       class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-green-100 hover:text-green-600 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if(setting('social_twitter'))
                                    <a href="{{ setting('social_twitter') }}" target="_blank" rel="noopener noreferrer"
                                       class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-green-100 hover:text-green-600 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if(setting('social_linkedin'))
                                    <a href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener noreferrer"
                                       class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-green-100 hover:text-green-600 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    @if(setting('contact_map_embed') || (setting('contact_latitude') && setting('contact_longitude')))
        <section class="bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                        {{ setting('contact_map_title', 'Find Us') }}
                    </h2>
                    <p class="text-gray-600">
                        {{ setting('contact_map_subtitle', 'Visit our location or use the map for directions') }}
                    </p>
                </div>

                <div class="rounded-2xl overflow-hidden shadow-lg">
                    @if(setting('contact_map_embed'))
                        {{-- Embedded Map (iframe) --}}
                        <div class="aspect-w-16 aspect-h-9 md:aspect-h-6">
                            {!! setting('contact_map_embed') !!}
                        </div>
                    @elseif(setting('contact_latitude') && setting('contact_longitude'))
                        {{-- Map Component with coordinates --}}
                        <x-map
                            :latitude="setting('contact_latitude')"
                            :longitude="setting('contact_longitude')"
                            :zoom="setting('contact_map_zoom', 15)"
                            :marker-title="setting('site_name', 'Sofoodtchad')"
                        />
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- FAQ Section --}}
    @if($faqs ?? false)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                        {{ setting('contact_faq_title', 'Frequently Asked Questions') }}
                    </h2>
                    <p class="text-gray-600">
                        {{ setting('contact_faq_subtitle', 'Find quick answers to common questions') }}
                    </p>
                </div>

                <div class="space-y-4">
                    @foreach($faqs as $index => $faq)
                        <div class="border border-gray-200 rounded-lg" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <span class="font-medium text-gray-900">{{ $faq['question'] }}</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform"
                                     :class="{ 'rotate-180': open }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="px-6 pb-4">
                                <p class="text-gray-600">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- WhatsApp Floating Button --}}
    @if(setting('whatsapp_number'))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}?text={{ urlencode(setting('whatsapp_message', 'Hello! I would like to know more about your products.')) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-green-500 rounded-full shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300 group"
           aria-label="Chat on WhatsApp">
            {{-- WhatsApp Icon --}}
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>

            {{-- Tooltip --}}
            <span class="absolute right-16 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                Chat with us
            </span>
        </a>
    @endif
@endsection
