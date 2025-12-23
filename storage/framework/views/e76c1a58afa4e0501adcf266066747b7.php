<header class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">

    
    <button
        type="button"
        class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
        @click="sidebarOpen = true"
    >
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    
    <div class="h-6 w-px bg-gray-200 lg:hidden"></div>

    
    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <div class="flex items-center gap-x-4 lg:gap-x-6 flex-1">
            
            <div class="flex-1">
                <h1 class="text-lg font-semibold text-gray-900">
                    <?php echo $__env->yieldContent('page-title', 'Dashboard'); ?>
                </h1>
            </div>
        </div>

        
        <div class="flex items-center gap-x-4 lg:gap-x-6">

            
            <?php
                $unreadMessages = \App\Models\ContactMessage::unread()->count();
            ?>
            <a href="<?php echo e(route('admin.messages.index')); ?>" class="hidden sm:block -m-2.5 p-2.5 text-gray-400 hover:text-gray-500 transition-colors relative" title="Messages">
                <span class="sr-only">View messages</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                <?php if($unreadMessages > 0): ?>
                    <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white">
                        <?php echo e($unreadMessages > 9 ? '9+' : $unreadMessages); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <button type="button" class="hidden sm:block -m-2.5 p-2.5 text-gray-400 hover:text-gray-500 transition-colors">
                <span class="sr-only">View notifications</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>

            
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200"></div>

            
            <div x-data="{ open: false }" class="relative">
                <button
                    type="button"
                    class="-m-1.5 flex items-center p-1.5 hover:bg-gray-50 rounded-lg transition-colors"
                    @click="open = !open"
                    @click.outside="open = false"
                >
                    <span class="sr-only">Open user menu</span>
                    
                    <div class="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold text-sm">
                        <?php echo e(substr(auth()->user()->name ?? 'A', 0, 1)); ?>

                    </div>
                    
                    <span class="hidden lg:flex lg:items-center">
                        <span class="ml-3 text-sm font-semibold text-gray-900">
                            <?php echo e(auth()->user()->name ?? 'Admin'); ?>

                        </span>
                        <svg class="ml-2 h-5 w-5 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

                
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-lg bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                    x-cloak
                >
                    
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900"><?php echo e(auth()->user()->name ?? 'Admin'); ?></p>
                        <p class="text-xs text-gray-500 truncate"><?php echo e(auth()->user()->email ?? ''); ?></p>
                    </div>

                    
                    <a
                        href="<?php echo e(route('admin.users.edit', auth()->user())); ?>"
                        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors"
                    >
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Your Profile
                    </a>

                    
                    <?php if(auth()->user() && auth()->user()->hasRole('admin')): ?>
                        <a
                            href="<?php echo e(route('admin.settings.index')); ?>"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors"
                        >
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>
                    <?php endif; ?>

                    <div class="border-t border-gray-100 my-1"></div>

                    
                    <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button
                            type="submit"
                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Sign out
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</header>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/partials/topbar.blade.php ENDPATH**/ ?>