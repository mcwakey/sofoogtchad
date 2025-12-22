@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Partners</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your business partners, distributors, and suppliers</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Partner
            </a>
        </div>
    </div>
@endsection

@section('content')
    {{-- Filters --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="{{ route('admin.partners.index') }}" class="flex flex-col sm:flex-row gap-4">
            {{-- Type Filter --}}
            <div class="w-full sm:w-48">
                <select name="type" class="block w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">All Types</option>
                    <option value="partner" {{ request('type') === 'partner' ? 'selected' : '' }}>Partner</option>
                    <option value="distributor" {{ request('type') === 'distributor' ? 'selected' : '' }}>Distributor</option>
                    <option value="supplier" {{ request('type') === 'supplier' ? 'selected' : '' }}>Supplier</option>
                </select>
            </div>

            {{-- Filter Button --}}
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['type']))
                    <a href="{{ route('admin.partners.index') }}" class="px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Partners Grid --}}
    @if($partners->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($partners as $partner)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition-shadow" x-data="{ showDeleteModal: false }">
                    {{-- Logo --}}
                    <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-6 relative">
                        @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-3xl font-bold text-gray-400">{{ substr($partner->name, 0, 1) }}</span>
                            </div>
                        @endif

                        {{-- Status Badges --}}
                        <div class="absolute top-3 left-3 flex flex-col gap-1">
                            @if($partner->is_featured)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    Featured
                                </span>
                            @endif
                            @if(!$partner->is_active)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                    Inactive
                                </span>
                            @endif
                        </div>

                        {{-- Type Badge --}}
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                {{ $partner->type === 'partner' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $partner->type === 'distributor' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $partner->type === 'supplier' ? 'bg-green-100 text-green-800' : '' }}
                            ">
                                {{ ucfirst($partner->type) }}
                            </span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $partner->name }}</h3>
                        @if($partner->website)
                            <a href="{{ $partner->website }}" target="_blank" class="text-sm text-green-600 hover:text-green-700 truncate block">
                                {{ parse_url($partner->website, PHP_URL_HOST) }}
                            </a>
                        @else
                            <p class="text-sm text-gray-400">No website</p>
                        @endif

                        {{-- Actions --}}
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.partners.edit', $partner) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                            <button type="button" @click="showDeleteModal = true" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <template x-teleport="body">
                        <div
                            x-show="showDeleteModal"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 z-50 overflow-y-auto"
                            x-cloak
                        >
                            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showDeleteModal = false"></div>
                            <div class="flex min-h-full items-center justify-center p-4">
                                <div
                                    x-show="showDeleteModal"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="relative w-full max-w-md bg-white rounded-2xl shadow-xl"
                                    @click.away="showDeleteModal = false"
                                >
                                    <div class="p-6 pb-0">
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                                            <svg class="h-7 w-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="p-6 text-center">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Partner</h3>
                                        <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                                        <p class="text-lg font-medium text-gray-900 mb-4">"{{ $partner->name }}"?</p>
                                        <p class="text-sm text-gray-500">This action cannot be undone.</p>
                                    </div>
                                    <div class="p-6 pt-0 flex gap-3">
                                        <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                            Cancel
                                        </button>
                                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                                Yes, Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="flex flex-col items-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No partners found</h3>
                <p class="text-sm text-gray-500 mb-6">Get started by adding your first business partner.</p>
                <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Partner
                </a>
            </div>
        </div>
    @endif
@endsection
