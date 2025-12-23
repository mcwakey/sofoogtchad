<?php $__env->startSection('title', 'Process Steps'); ?>
<?php $__env->startSection('page-title', 'Process Steps'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Process Steps</h1>
            <p class="mt-1 text-sm text-gray-500">Define the steps in your production or business process</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="<?php echo e(route('admin.process-steps.create')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Step
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($steps->count() > 0): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700"><?php echo e($steps->count()); ?> <?php echo e(Str::plural('step', $steps->count())); ?> defined</span>
                </div>
            </div>

            
            <div class="divide-y divide-gray-200">
                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-6 hover:bg-gray-50 transition-colors" x-data="{ showDeleteModal: false }">
                        <div class="flex items-start gap-6">
                            
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <?php if($step->icon): ?>
                                        <span class="text-2xl"><?php echo e($step->icon); ?></span>
                                    <?php else: ?>
                                        <span class="text-lg font-bold text-green-600"><?php echo e($step->sort_order); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <div class="flex items-center gap-3">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-200 text-xs font-semibold text-gray-700">
                                                <?php echo e($step->sort_order); ?>

                                            </span>
                                            <h3 class="text-lg font-semibold text-gray-900"><?php echo e($step->title); ?></h3>
                                            <?php if(!$step->is_active): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                                    Inactive
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($step->description): ?>
                                            <p class="mt-2 text-sm text-gray-600 line-clamp-2"><?php echo e($step->description); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <a href="<?php echo e(route('admin.process-steps.edit', $step)); ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button" @click="showDeleteModal = true" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
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
                                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Step</h3>
                                            <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                                            <p class="text-lg font-medium text-gray-900 mb-4">"<?php echo e($step->title); ?>"?</p>
                                            <p class="text-sm text-gray-500">This action cannot be undone.</p>
                                        </div>
                                        <div class="p-6 pt-0 flex gap-3">
                                            <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                                Cancel
                                            </button>
                                            <form action="<?php echo e(route('admin.process-steps.destroy', $step)); ?>" method="POST" class="flex-1">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Process Flow Preview</h2>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-center flex-wrap gap-4">
                    <?php $__currentLoopData = $steps->where('is_active', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-2">
                                    <?php if($step->icon): ?>
                                        <span class="text-2xl"><?php echo e($step->icon); ?></span>
                                    <?php else: ?>
                                        <span class="text-xl font-bold text-green-600"><?php echo e($step->sort_order); ?></span>
                                    <?php endif; ?>
                                </div>
                                <span class="text-sm font-medium text-gray-900 text-center max-w-[100px] truncate"><?php echo e($step->title); ?></span>
                            </div>
                            <?php if(!$loop->last): ?>
                                <svg class="w-8 h-8 text-gray-300 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="flex flex-col items-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No process steps defined</h3>
                <p class="text-sm text-gray-500 mb-6">Get started by adding your first process step.</p>
                <a href="<?php echo e(route('admin.process-steps.create')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add First Step
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/process-steps/index.blade.php ENDPATH**/ ?>