@props([
    'name',
    'label',
    'model' => null,
    'required' => false,
    'rows' => 10,
    'placeholder' => '',
])

@php
    $locales = ['fr', 'en', 'ar'];
    $isRtl = fn($locale) => $locale === 'ar';
    $editorId = 'editor_' . $name . '_' . uniqid();
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
            <div class="flex items-center justify-between mb-2">
                <span class="text-gray-400 dark:text-gray-500 text-xs uppercase font-medium">{{ strtoupper($locale) }}</span>
                @if($locale === 'ar')
                    <span class="text-xs text-gray-400 dark:text-gray-500">RTL</span>
                @endif
            </div>
            <textarea
                name="{{ $name }}[{{ $locale }}]"
                id="{{ $name }}_{{ $locale }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                @if($required && $locale === 'fr') required @endif
                class="wysiwyg-editor {{ $isRtl($locale) ? 'text-right' : '' }} block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                dir="{{ $isRtl($locale) ? 'rtl' : 'ltr' }}"
                data-locale="{{ $locale }}"
            >{{ old("{$name}.{$locale}", $model?->getTranslation($name, $locale, false) ?? '') }}</textarea>
            @error("{$name}.{$locale}")
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    @endforeach
</div>
