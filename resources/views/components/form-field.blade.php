@props([
    'type' => 'text',
    'name',
    'label' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'id' => null,
    'help' => null,
    'rows' => 4,
    'options' => [],
    'emptyOption' => 'Select an option',
    'autocomplete' => null,
    'min' => null,
    'max' => null,
    'step' => null,
    'pattern' => null,
    'accept' => null,
])

@php
    $fieldId = $id ?? $name;
    $hasError = $errors->has($name);
    $fieldValue = old($name, $value);

    $inputClasses = 'block w-full rounded-lg border-gray-300 shadow-sm transition-colors duration-200 focus:border-green-500 focus:ring-green-500 sm:text-sm';

    if ($hasError) {
        $inputClasses = 'block w-full rounded-lg border-red-500 shadow-sm transition-colors duration-200 focus:border-red-500 focus:ring-red-500 sm:text-sm text-red-900 placeholder-red-300';
    }

    if ($disabled) {
        $inputClasses .= ' bg-gray-100 cursor-not-allowed';
    }
@endphp

<div {{ $attributes->merge(['class' => 'form-field']) }}>
    {{-- Label --}}
    @if($label)
        <label for="{{ $fieldId }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Input Field --}}
    @switch($type)
        @case('textarea')
            <textarea
                name="{{ $name }}"
                id="{{ $fieldId }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                class="{{ $inputClasses }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
                @if($readonly) readonly @endif
            >{{ $fieldValue }}</textarea>
            @break

        @case('select')
            <select
                name="{{ $name }}"
                id="{{ $fieldId }}"
                class="{{ $inputClasses }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
            >
                @if($emptyOption)
                    <option value="">{{ $emptyOption }}</option>
                @endif
                @foreach($options as $optionValue => $optionLabel)
                    <option
                        value="{{ $optionValue }}"
                        {{ $fieldValue == $optionValue ? 'selected' : '' }}
                    >
                        {{ $optionLabel }}
                    </option>
                @endforeach
            </select>
            @break

        @case('checkbox')
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="{{ $name }}"
                    id="{{ $fieldId }}"
                    value="1"
                    class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
                    {{ $fieldValue ? 'checked' : '' }}
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                >
                @if($label)
                    <label for="{{ $fieldId }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                        @if($required)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>
                @endif
            </div>
            @break

        @case('radio')
            <div class="space-y-2">
                @foreach($options as $optionValue => $optionLabel)
                    <div class="flex items-center">
                        <input
                            type="radio"
                            name="{{ $name }}"
                            id="{{ $fieldId }}_{{ $optionValue }}"
                            value="{{ $optionValue }}"
                            class="h-4 w-4 border-gray-300 text-green-600 focus:ring-green-500"
                            {{ $fieldValue == $optionValue ? 'checked' : '' }}
                            @if($required) required @endif
                            @if($disabled) disabled @endif
                        >
                        <label for="{{ $fieldId }}_{{ $optionValue }}" class="ml-2 text-sm text-gray-700">
                            {{ $optionLabel }}
                        </label>
                    </div>
                @endforeach
            </div>
            @break

        @case('file')
            <input
                type="file"
                name="{{ $name }}"
                id="{{ $fieldId }}"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 focus:outline-none"
                @if($accept) accept="{{ $accept }}" @endif
                @if($required) required @endif
                @if($disabled) disabled @endif
            >
            @break

        @default
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $fieldId }}"
                value="{{ $fieldValue }}"
                placeholder="{{ $placeholder }}"
                class="{{ $inputClasses }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
                @if($readonly) readonly @endif
                @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                @if($min !== null) min="{{ $min }}" @endif
                @if($max !== null) max="{{ $max }}" @endif
                @if($step !== null) step="{{ $step }}" @endif
                @if($pattern) pattern="{{ $pattern }}" @endif
            >
    @endswitch

    {{-- Help Text --}}
    @if($help && !$hasError)
        <p class="mt-1 text-xs text-gray-500">{{ $help }}</p>
    @endif

    {{-- Error Message --}}
    @error($name)
        <p class="mt-1 text-sm text-red-600 flex items-center">
            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>
