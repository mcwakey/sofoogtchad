@extends('admin.layouts.app')

@section('title', 'Add Setting')
@section('header', 'Add Setting')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="bg-white shadow rounded-lg">
        @csrf

        <div class="p-6 space-y-6">
            {{-- Key --}}
            <div>
                <label for="key" class="block text-sm font-medium text-gray-700">
                    Key <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="key"
                       id="key"
                       value="{{ old('key') }}"
                       required
                       pattern="[a-z0-9_]+"
                       title="Only lowercase letters, numbers, and underscores"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('key') border-red-500 @enderror"
                       placeholder="site_name">
                @error('key')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Only lowercase letters, numbers, and underscores. This is used to access the setting.</p>
            </div>

            {{-- Label --}}
            <div>
                <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                <input type="text"
                       name="label"
                       id="label"
                       value="{{ old('label') }}"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('label') border-red-500 @enderror"
                       placeholder="Site Name">
                @error('label')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Human-readable label for the setting.</p>
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">
                    Type <span class="text-red-500">*</span>
                </label>
                <select name="type"
                        id="type"
                        required
                        class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('type') border-red-500 @enderror">
                    <option value="text" {{ old('type') === 'text' ? 'selected' : '' }}>Text</option>
                    <option value="textarea" {{ old('type') === 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="number" {{ old('type') === 'number' ? 'selected' : '' }}>Number</option>
                    <option value="email" {{ old('type') === 'email' ? 'selected' : '' }}>Email</option>
                    <option value="url" {{ old('type') === 'url' ? 'selected' : '' }}>URL</option>
                    <option value="boolean" {{ old('type') === 'boolean' ? 'selected' : '' }}>Boolean (Yes/No)</option>
                    <option value="json" {{ old('type') === 'json' ? 'selected' : '' }}>JSON</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Group --}}
            <div>
                <label for="group" class="block text-sm font-medium text-gray-700">
                    Group <span class="text-red-500">*</span>
                </label>
                <select name="group"
                        id="group"
                        required
                        class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('group') border-red-500 @enderror">
                    @foreach($groups as $grp)
                        <option value="{{ $grp }}" {{ old('group') === $grp ? 'selected' : '' }}>{{ ucfirst($grp) }}</option>
                    @endforeach
                    <option value="_new">+ New Group...</option>
                </select>
                @error('group')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- New Group --}}
            <div id="new_group_container" class="hidden">
                <label for="new_group" class="block text-sm font-medium text-gray-700">New Group Name</label>
                <input type="text"
                       name="new_group"
                       id="new_group"
                       value="{{ old('new_group') }}"
                       pattern="[a-z0-9_]+"
                       title="Only lowercase letters, numbers, and underscores"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                       placeholder="new_group">
                <p class="mt-1 text-xs text-gray-500">Only lowercase letters, numbers, and underscores.</p>
            </div>

            {{-- Value --}}
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700">Default Value</label>
                <textarea name="value"
                          id="value"
                          rows="3"
                          class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('value') border-red-500 @enderror">{{ old('value') }}</textarea>
                @error('value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description"
                          id="description"
                          rows="2"
                          class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror"
                          placeholder="Brief description of what this setting controls">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                <input type="number"
                       name="sort_order"
                       id="sort_order"
                       value="{{ old('sort_order', 0) }}"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-32 sm:text-sm border-gray-300 rounded-md @error('sort_order') border-red-500 @enderror">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3 rounded-b-lg">
            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Create Setting
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('group').addEventListener('change', function() {
    const newGroupContainer = document.getElementById('new_group_container');
    const newGroupInput = document.getElementById('new_group');

    if (this.value === '_new') {
        newGroupContainer.classList.remove('hidden');
        newGroupInput.required = true;
    } else {
        newGroupContainer.classList.add('hidden');
        newGroupInput.required = false;
        newGroupInput.value = '';
    }
});

// Trigger on page load if already set to new
if (document.getElementById('group').value === '_new') {
    document.getElementById('new_group_container').classList.remove('hidden');
    document.getElementById('new_group').required = true;
}
</script>
@endpush
@endsection
