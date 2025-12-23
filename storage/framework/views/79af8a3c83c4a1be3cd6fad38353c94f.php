<?php $__env->startSection('title', 'Edit Process Step: ' . $processStep->title); ?>
<?php $__env->startSection('page-title', 'Edit Step'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="<?php echo e(route('admin.process-steps.index')); ?>" class="hover:text-gray-700">Process Steps</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900"><?php echo e($processStep->title); ?></span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Edit Process Step</h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('admin.process-steps.update', $processStep)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Step Information</h2>

                    
                    <?php if (isset($component)) { $__componentOriginal232dd19f0e005359d8e9924f05be0c8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal232dd19f0e005359d8e9924f05be0c8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.language-tabs','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.language-tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <div class="space-y-4">
                            <?php if (isset($component)) { $__componentOriginal69e1dd7ca8ebd122d0cb5935f7954f48 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69e1dd7ca8ebd122d0cb5935f7954f48 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-input','data' => ['name' => 'title','label' => 'Title','model' => $processStep,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Title','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($processStep),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69e1dd7ca8ebd122d0cb5935f7954f48)): ?>
<?php $attributes = $__attributesOriginal69e1dd7ca8ebd122d0cb5935f7954f48; ?>
<?php unset($__attributesOriginal69e1dd7ca8ebd122d0cb5935f7954f48); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69e1dd7ca8ebd122d0cb5935f7954f48)): ?>
<?php $component = $__componentOriginal69e1dd7ca8ebd122d0cb5935f7954f48; ?>
<?php unset($__componentOriginal69e1dd7ca8ebd122d0cb5935f7954f48); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal8c954ff3f65735c06e5d1158e2b9f1f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c954ff3f65735c06e5d1158e2b9f1f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'description','label' => 'Description','model' => $processStep,'rows' => 4]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'description','label' => 'Description','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($processStep),'rows' => 4]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c954ff3f65735c06e5d1158e2b9f1f5)): ?>
<?php $attributes = $__attributesOriginal8c954ff3f65735c06e5d1158e2b9f1f5; ?>
<?php unset($__attributesOriginal8c954ff3f65735c06e5d1158e2b9f1f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c954ff3f65735c06e5d1158e2b9f1f5)): ?>
<?php $component = $__componentOriginal8c954ff3f65735c06e5d1158e2b9f1f5; ?>
<?php unset($__componentOriginal8c954ff3f65735c06e5d1158e2b9f1f5); ?>
<?php endif; ?>
                        </div>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal232dd19f0e005359d8e9924f05be0c8f)): ?>
<?php $attributes = $__attributesOriginal232dd19f0e005359d8e9924f05be0c8f; ?>
<?php unset($__attributesOriginal232dd19f0e005359d8e9924f05be0c8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal232dd19f0e005359d8e9924f05be0c8f)): ?>
<?php $component = $__componentOriginal232dd19f0e005359d8e9924f05be0c8f; ?>
<?php unset($__componentOriginal232dd19f0e005359d8e9924f05be0c8f); ?>
<?php endif; ?>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Step Icon</h2>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">
                            Icon / Emoji
                        </label>
                        <div class="flex items-center gap-4">
                            <?php if($processStep->icon): ?>
                                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-2xl">
                                    <?php echo e($processStep->icon); ?>

                                </div>
                            <?php endif; ?>
                            <input
                                type="text"
                                id="icon"
                                name="icon"
                                value="<?php echo e(old('icon', $processStep->icon)); ?>"
                                class="block flex-1 <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="e.g., 🌱 🏭 📦 🚚"
                            >
                        </div>
                        <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="mt-2 text-xs text-gray-500">Enter an emoji to represent this step. If empty, the step number will be displayed.</p>
                    </div>

                    
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Quick Select:</p>
                        <div class="flex flex-wrap gap-2" x-data>
                            <?php $__currentLoopData = ['🌱', '🏭', '📦', '🚚', '✅', '🔬', '⚙️', '🌾', '🍃', '💧', '🔥', '❄️']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emoji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button
                                    type="button"
                                    @click="document.getElementById('icon').value = '<?php echo e($emoji); ?>'"
                                    class="w-10 h-10 text-xl flex items-center justify-center rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition-colors"
                                >
                                    <?php echo e($emoji); ?>

                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6" x-data="{ showDeleteModal: false }">
                    <h2 class="text-lg font-semibold text-red-600 mb-2">Danger Zone</h2>
                    <p class="text-sm text-gray-600 mb-4">Once you delete a step, there is no going back.</p>
                    <button
                        type="button"
                        @click="showDeleteModal = true"
                        class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Step
                    </button>

                    
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
                                        <p class="text-lg font-medium text-gray-900 mb-4">"<?php echo e($processStep->title); ?>"?</p>
                                        <p class="text-sm text-gray-500">This action cannot be undone.</p>
                                    </div>
                                    <div class="p-6 pt-0 flex gap-3">
                                        <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                            Cancel
                                        </button>
                                        <form action="<?php echo e(route('admin.process-steps.destroy', $processStep)); ?>" method="POST" class="flex-1">
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
            </div>

            
            <div class="space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Settings</h2>

                    <div class="space-y-4">
                        
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">
                                Step Number
                            </label>
                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                value="<?php echo e(old('sort_order', $processStep->sort_order)); ?>"
                                min="0"
                                class="block w-full"
                            >
                            <p class="mt-1 text-xs text-gray-500">Determines the order in the process flow</p>
                        </div>

                        
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Active</p>
                                    <p class="text-xs text-gray-500">Show in process flow</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?php echo e(old('is_active', $processStep->is_active) ? 'checked' : ''); ?>>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="<?php echo e(route('admin.process-steps.index')); ?>" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

                
                <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Information</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Created</dt>
                            <dd class="text-gray-900"><?php echo e($processStep->created_at->format('M d, Y')); ?></dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Updated</dt>
                            <dd class="text-gray-900"><?php echo e($processStep->updated_at->format('M d, Y')); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/process-steps/edit.blade.php ENDPATH**/ ?>