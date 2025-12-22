@extends('admin.layouts.app')

@section('title', 'Edit Role')
@section('page-title', 'Edit Role')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Role</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($role->name) }}</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-xl">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Role Details</h3>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Role Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Role Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $role->name) }}"
                            required
                            @if(in_array($role->name, ['admin', 'editor'])) readonly @endif
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror @if(in_array($role->name, ['admin', 'editor'])) bg-gray-50 dark:bg-gray-600 cursor-not-allowed @endif"
                            placeholder="e.g., Editor, Moderator, Manager"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @if(in_array($role->name, ['admin', 'editor']))
                            <p class="mt-1 text-xs text-amber-600 dark:text-amber-400">System roles cannot be renamed</p>
                        @else
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Use a clear, descriptive name for the role</p>
                        @endif
                    </div>

                    {{-- Users with this role --}}
                    @if($role->users->count() > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Users with this role
                            </label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($role->users->take(5) as $user)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm rounded-full">
                                        <span class="w-5 h-5 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-xs font-medium">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                        {{ $user->name }}
                                    </span>
                                @endforeach
                                @if($role->users->count() > 5)
                                    <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm rounded-full">
                                        +{{ $role->users->count() - 5 }} more
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.roles.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                    Update Role
                </button>
            </div>
        </form>
    </div>
@endsection
