@props([
    'formAction' => null,
    'form_action' => null,
    'submitText' => 'Send Message',
    'submit_text' => null,
    'method' => 'POST',
    'showSubject' => true,
    'showPhone' => false,
    'showCompany' => false,
    'title' => null,
    'subtitle' => null,
    'successMessage' => 'Thank you! Your message has been sent successfully.',
    'extraFields' => [],
])

@php
    $action = $formAction ?? $form_action;
    $buttonText = $submit_text ?? $submitText;
@endphp

<div {{ $attributes->merge(['class' => 'contact-form']) }}>
    {{-- Form Header --}}
    @if($title || $subtitle)
        <div class="mb-6">
            @if($title)
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-green-800 dark:text-green-300">{{ session('success') ?: $successMessage }}</span>
            </div>
        </div>
    @endif

    {{-- Error Summary --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
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

    <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" class="space-y-5">
        @csrf
        @if(!in_array($method, ['GET', 'POST']))
            @method($method)
        @endif

        {{-- Name & Email Row --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <x-form-field
                type="text"
                name="name"
                :label="__('contact.full_name')"
                :placeholder="__('contact.your_name')"
                required
                autocomplete="name"
            />

            <x-form-field
                type="email"
                name="email"
                :label="__('contact.email_address')"
                placeholder="you@example.com"
                required
                autocomplete="email"
            />
        </div>

        {{-- Phone & Company Row (optional) --}}
        @if($showPhone || $showCompany)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @if($showPhone)
                    <x-form-field
                        type="tel"
                        name="phone"
                        :label="__('contact.phone_number')"
                        :placeholder="__('contact.your_phone')"
                        autocomplete="tel"
                    />
                @endif

                @if($showCompany)
                    <x-form-field
                        type="text"
                        name="company"
                        :label="__('contact.company_name')"
                        :placeholder="__('contact.your_company')"
                        autocomplete="organization"
                    />
                @endif
            </div>
        @endif

        {{-- Subject --}}
        @if($showSubject)
            <x-form-field
                type="text"
                name="subject"
                :label="__('contact.subject')"
                :placeholder="__('contact.message_subject')"
                required
            />
        @endif

        {{-- Extra Fields Slot --}}
        @if($slot->isNotEmpty())
            {{ $slot }}
        @endif

        {{-- Message --}}
        <x-form-field
            type="textarea"
            name="message"
            :label="__('contact.message')"
            :placeholder="__('contact.your_message')"
            required
            :rows="5"
        />

        {{-- Privacy Consent --}}
        <div class="flex items-start">
            <input
                type="checkbox"
                name="privacy_consent"
                id="privacy_consent"
                required
                class="mt-1 h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-green-600 focus:ring-green-500"
            >
            <label for="privacy_consent" class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                {{ __('contact.privacy_notice') }} <a href="{{ url('/privacy-policy') }}" class="text-green-600 dark:text-green-400 hover:underline">{{ __('contact.privacy_policy') }}</a>.
                <span class="text-red-500">*</span>
            </label>
        </div>
        @error('privacy_consent')
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror

        {{-- Submit Button --}}
        <div class="pt-2">
            <x-button
                type="primary"
                :text="$buttonText"
                submit
                size="lg"
                class="w-full sm:w-auto"
            />
        </div>
    </form>
</div>
