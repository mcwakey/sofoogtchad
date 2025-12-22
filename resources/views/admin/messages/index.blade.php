@extends('admin.layouts.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Contact Messages</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                View and manage messages from your contact form
                @if($unreadCount > 0)
                    <span class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ $unreadCount }} unread
                    </span>
                @endif
            </p>
        </div>
    </div>
@endsection

@section('content')
    {{-- Filters & Search --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <form method="GET" action="{{ route('admin.messages.index') }}" class="flex flex-col sm:flex-row gap-4">
            {{-- Search --}}
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search messages..."
                        class="block w-full pl-10 pr-4 py-2.5 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500"
                    >
                </div>
            </div>

            {{-- Status Filter --}}
            <div class="w-full sm:w-40">
                <select name="status" class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">All Messages</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                </select>
            </div>

            {{-- Filter Button --}}
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2.5 bg-gray-900 dark:bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-800 dark:hover:bg-gray-500 transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.messages.index') }}" class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Messages Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Sender
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Subject
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ !$message->is_read ? 'bg-green-50 dark:bg-green-900/20' : '' }}">
                            {{-- Sender Info --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($message->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white {{ !$message->is_read ? 'font-bold' : '' }}">
                                            {{ $message->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                            {{ $message->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Subject --}}
                            <td class="px-6 py-4">
                                <div class="min-w-0">
                                    <div class="text-sm text-gray-900 dark:text-white truncate max-w-xs {{ !$message->is_read ? 'font-semibold' : '' }}">
                                        {{ $message->subject }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                        {{ Str::limit($message->message, 60) }}
                                    </div>
                                </div>
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $message->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $message->created_at->format('H:i') }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($message->is_read)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                                        </svg>
                                        Read
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        Unread
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" x-data="{ showViewModal: false, showDeleteModal: false }">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- View Button --}}
                                    <button type="button" @click="showViewModal = true" class="text-blue-500 hover:text-blue-700 transition-colors" title="View Message">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>

                                    {{-- Toggle Read Status --}}
                                    <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" title="{{ $message->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                            @if($message->is_read)
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>

                                    {{-- Delete Button --}}
                                    <button type="button" @click="showDeleteModal = true" class="text-red-500 hover:text-red-700 transition-colors" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>

                                {{-- View Modal --}}
                                <template x-teleport="body">
                                    <div
                                        x-show="showViewModal"
                                        x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 z-50 overflow-y-auto"
                                        x-cloak
                                    >
                                        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showViewModal = false"></div>
                                        <div class="flex min-h-full items-center justify-center p-4">
                                            <div
                                                x-show="showViewModal"
                                                x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-95"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-95"
                                                class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl"
                                                @click.away="showViewModal = false"
                                            >
                                                {{-- Modal Header --}}
                                                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                                                    <div class="flex items-center gap-4">
                                                        <div class="h-12 w-12 flex-shrink-0 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                                            <span class="text-white font-bold text-lg">{{ strtoupper(substr($message->name, 0, 1)) }}</span>
                                                        </div>
                                                        <div>
                                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $message->name }}</h3>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $message->email }}</p>
                                                        </div>
                                                    </div>
                                                    <button type="button" @click="showViewModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                                {{-- Modal Body --}}
                                                <div class="p-6">
                                                    {{-- Meta Info --}}
                                                    <div class="flex flex-wrap gap-4 mb-4 text-sm text-gray-500 dark:text-gray-400">
                                                        @if($message->phone)
                                                            <div class="flex items-center gap-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                                </svg>
                                                                {{ $message->phone }}
                                                            </div>
                                                        @endif
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            {{ $message->created_at->format('M d, Y \a\t H:i') }}
                                                        </div>
                                                    </div>

                                                    {{-- Subject --}}
                                                    <div class="mb-4">
                                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Subject</h4>
                                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $message->subject }}</p>
                                                    </div>

                                                    {{-- Message --}}
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Message</h4>
                                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-sm leading-relaxed">{{ $message->message }}</div>
                                                    </div>
                                                </div>

                                                {{-- Modal Footer --}}
                                                <div class="flex items-center justify-between p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 rounded-b-2xl">
                                                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                        </svg>
                                                        Reply via Email
                                                    </a>
                                                    <button type="button" @click="showViewModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

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
                                                class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl"
                                                @click.away="showDeleteModal = false"
                                            >
                                                <div class="p-6 pb-0">
                                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/50">
                                                        <svg class="h-7 w-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="p-6 text-center">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Delete Message</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 mb-2">Are you sure you want to delete this message from</p>
                                                    <p class="text-lg font-medium text-gray-900 dark:text-white mb-4">"{{ $message->name }}"?</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-500">This action cannot be undone.</p>
                                                </div>
                                                <div class="p-6 pt-0 flex gap-3">
                                                    <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                        Cancel
                                                    </button>
                                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="flex-1">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">No messages found</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Messages from your contact form will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $messages->withQueryString()->links() }}
            </div>
        @endif
    </div>

    {{-- Stats Cards --}}
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $messages->total() }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Messages</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $unreadCount }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Unread Messages</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $messages->total() - $unreadCount }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Read Messages</p>
                </div>
            </div>
        </div>
    </div>
@endsection
