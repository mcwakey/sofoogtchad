@props([
    'name',
    'label',
    'model' => null,
    'required' => false,
    'type' => 'text',
    'placeholder' => '',
])

@php
    $locales = ['fr', 'en', 'ar'];
    $isRtl = fn($locale) => $locale === 'ar';
@endphp

<div {{ $attributes->merge(['class' => 'space-y-3']) }}>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    @foreach($locales as $locale)
        <div
            x-show="activeTab === '{{ $locale }}'"
            x-cloak
            class="relative"
        >
            <div class="absolute inset-y-0 {{ $isRtl($locale) ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                <span class="text-gray-400 dark:text-gray-500 text-xs uppercase font-medium">{{ strtoupper($locale) }}</span>
            </div>
            <input
                type="{{ $type }}"
                name="{{ $name }}[{{ $locale }}]"
                id="{{ $name }}_{{ $locale }}"
                value="{{ old("{$name}.{$locale}", $model?->getTranslation($name, $locale, false) ?? '') }}"
                placeholder="{{ $placeholder }}"
                @if($required && $locale === 'fr') required @endif
                class="{{ $isRtl($locale) ? 'pr-12 text-right' : 'pl-12' }} block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                dir="{{ $isRtl($locale) ? 'rtl' : 'ltr' }}"
            >
            @error("{$name}.{$locale}")
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    @endforeach
</div>
