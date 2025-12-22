@props([
    'activeTab' => 'fr',
])

@php
    $locales = [
        'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'required' => true],
        'en' => ['name' => 'English', 'flag' => '🇬🇧', 'required' => false],
        'ar' => ['name' => 'العربية', 'flag' => '🇹🇩', 'required' => false],
    ];
@endphp

<div x-data="{ activeTab: '{{ $activeTab }}' }" {{ $attributes }}>
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
        <nav class="flex gap-2" aria-label="Language tabs">
            @foreach($locales as $code => $locale)
                <button
                    type="button"
                    @click="activeTab = '{{ $code }}'"
                    :class="{
                        'border-green-500 text-green-600 dark:text-green-400': activeTab === '{{ $code }}',
                        'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== '{{ $code }}'
                    }"
                    class="flex items-center gap-2 px-4 py-2.5 border-b-2 font-medium text-sm transition-colors -mb-px"
                >
                    <span class="text-lg">{{ $locale['flag'] }}</span>
                    <span>{{ $locale['name'] }}</span>
                    @if($locale['required'])
                        <span class="text-red-500 text-xs">*</span>
                    @endif
                </button>
            @endforeach
        </nav>
    </div>

    {{-- Tab Content --}}
    {{ $slot }}
</div>
