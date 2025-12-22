@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('header', 'Site Settings')

@section('content')
<div class="bg-white shadow rounded-lg">
    {{-- Group Tabs --}}
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
            @foreach($groups as $group)
                <a href="{{ route('admin.settings.index', ['group' => $group]) }}"
                   class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $activeGroup === $group ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    {{ ucfirst($group) }}
                </a>
            @endforeach
        </nav>
    </div>

    {{-- Settings Form --}}
    <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="group" value="{{ $activeGroup }}">

        <div class="space-y-6">
            @forelse($settings as $setting)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start border-b border-gray-100 pb-6">
                    <div>
                        <label for="settings_{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                            {{ $setting->label ?: $setting->key }}
                        </label>
                        @if($setting->description)
                            <p class="mt-1 text-xs text-gray-500">{{ $setting->description }}</p>
                        @endif
                        <p class="mt-1 text-xs text-gray-400">Key: {{ $setting->key }}</p>
                    </div>

                    <div class="lg:col-span-2">
                        @switch($setting->type)
                            @case('textarea')
                                <textarea
                                    name="settings[{{ $setting->key }}]"
                                    id="settings_{{ $setting->key }}"
                                    rows="4"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                >{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                @break

                            @case('boolean')
                                <div class="flex items-center">
                                    <input
                                        type="hidden"
                                        name="settings[{{ $setting->key }}]"
                                        value="0"
                                    >
                                    <input
                                        type="checkbox"
                                        name="settings[{{ $setting->key }}]"
                                        id="settings_{{ $setting->key }}"
                                        value="1"
                                        {{ old("settings.{$setting->key}", $setting->value) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    >
                                    <label for="settings_{{ $setting->key }}" class="ml-2 text-sm text-gray-600">
                                        Enabled
                                    </label>
                                </div>
                                @break

                            @case('number')
                                <input
                                    type="number"
                                    name="settings[{{ $setting->key }}]"
                                    id="settings_{{ $setting->key }}"
                                    value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                    step="any"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                >
                                @break

                            @case('email')
                                <input
                                    type="email"
                                    name="settings[{{ $setting->key }}]"
                                    id="settings_{{ $setting->key }}"
                                    value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                >
                                @break

                            @case('url')
                                <input
                                    type="url"
                                    name="settings[{{ $setting->key }}]"
                                    id="settings_{{ $setting->key }}"
                                    value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                    placeholder="https://"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                >
                                @break

                            @case('json')
                                <textarea
                                    name="settings[{{ $setting->key }}]"
                                    id="settings_{{ $setting->key }}"
                                    rows="6"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md font-mono text-xs"
                                    placeholder='{"key": "value"}'
                                >{{ old("settings.{$setting->key}", is_array($setting->value) ? json_encode($setting->value, JSON_PRETTY_PRINT) : $setting->value) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Enter valid JSON format</p>
                                @break

                            @default
                                <input
                                    type="text"
                                    name="settings[{{ $setting->key }}]"
                                    id="settings_{{ $setting->key }}"
                                    value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                >
                        @endswitch

                        {{-- Edit/Delete buttons --}}
                        <div class="mt-2 flex items-center space-x-4">
                            <a href="{{ route('admin.settings.edit', $setting) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                Edit setting
                            </a>
                            <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this setting?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No settings in this group</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new setting.</p>
                </div>
            @endforelse
        </div>

        @if($settings->count() > 0)
            <div class="mt-6 flex items-center justify-between border-t border-gray-200 pt-6">
                <a href="{{ route('admin.settings.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Setting
                </a>

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Settings
                </button>
            </div>
        @else
            <div class="mt-6 text-center">
                <a href="{{ route('admin.settings.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add First Setting
                </a>
            </div>
        @endif
    </form>
</div>
@endsection
