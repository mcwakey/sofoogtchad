{{-- Mobile Sidebar --}}
<aside
    x-show="sidebarOpen"
    x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 lg:hidden"
    x-cloak
>
    <div class="flex h-full flex-col">
        {{-- Logo & Close Button --}}
        <div class="flex h-16 items-center justify-between px-4 border-b border-gray-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-lg">Sofoodtchad</span>
            </a>
            <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3">
            @include('admin.partials._sidebar-nav')
        </nav>

        {{-- User Info at Bottom --}}
        <div class="border-t border-gray-800 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>

{{-- Desktop Sidebar --}}
<aside class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-64 lg:flex-col">
    <div class="flex h-full flex-col bg-gray-900">
        {{-- Logo --}}
        <div class="flex h-16 items-center px-4 border-b border-gray-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-lg">Sofoodtchad</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3">
            @include('admin.partials._sidebar-nav')
        </nav>

        {{-- User Info at Bottom --}}
        <div class="border-t border-gray-800 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>
