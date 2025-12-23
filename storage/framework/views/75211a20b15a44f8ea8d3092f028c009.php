<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> - <?php echo e(config('app.name', 'Sofoodtchad')); ?></title>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">
    <div id="app" class="min-h-full">

        
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak
        ></div>

        
        <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        
        <div class="lg:pl-64 flex flex-col min-h-screen">

            
            <?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <main class="flex-1 py-6">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    
                    <?php echo $__env->make('admin.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    
                    <?php if (! empty(trim($__env->yieldContent('page-header')))): ?>
                        <div class="mb-6">
                            <?php echo $__env->yieldContent('page-header'); ?>
                        </div>
                    <?php endif; ?>

                    
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
            </main>

            
            <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                        <p class="text-sm text-gray-500">
                            &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Sofoodtchad')); ?>. All rights reserved.
                        </p>
                        <p class="text-sm text-gray-400">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <?php echo e(config('app.name', 'Sofoodtchad')); ?> <?php echo e(app_version('formatted')); ?>

                            </span>
                        </p>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>