<?php $__env->startSection('title', 'Edit Setting'); ?>
<?php $__env->startSection('header', 'Edit Setting'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <form action="<?php echo e(route('admin.settings.update-setting', $setting)); ?>" method="POST" class="bg-white shadow rounded-lg">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="p-6 space-y-6">
            
            <div>
                <label for="key" class="block text-sm font-medium text-gray-700">
                    Key <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="key"
                       id="key"
                       value="<?php echo e(old('key', $setting->key)); ?>"
                       required
                       pattern="[a-z0-9_]+"
                       title="Only lowercase letters, numbers, and underscores"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="site_name">
                <?php $__errorArgs = ['key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <p class="mt-1 text-xs text-gray-500">Only lowercase letters, numbers, and underscores. This is used to access the setting.</p>
            </div>

            
            <div>
                <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                <input type="text"
                       name="label"
                       id="label"
                       value="<?php echo e(old('label', $setting->label)); ?>"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="Site Name">
                <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <p class="mt-1 text-xs text-gray-500">Human-readable label for the setting.</p>
            </div>

            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">
                    Type <span class="text-red-500">*</span>
                </label>
                <select name="type"
                        id="type"
                        required
                        class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="text" <?php echo e(old('type', $setting->type) === 'text' ? 'selected' : ''); ?>>Text</option>
                    <option value="textarea" <?php echo e(old('type', $setting->type) === 'textarea' ? 'selected' : ''); ?>>Textarea</option>
                    <option value="number" <?php echo e(old('type', $setting->type) === 'number' ? 'selected' : ''); ?>>Number</option>
                    <option value="email" <?php echo e(old('type', $setting->type) === 'email' ? 'selected' : ''); ?>>Email</option>
                    <option value="url" <?php echo e(old('type', $setting->type) === 'url' ? 'selected' : ''); ?>>URL</option>
                    <option value="boolean" <?php echo e(old('type', $setting->type) === 'boolean' ? 'selected' : ''); ?>>Boolean (Yes/No)</option>
                    <option value="json" <?php echo e(old('type', $setting->type) === 'json' ? 'selected' : ''); ?>>JSON</option>
                </select>
                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="group" class="block text-sm font-medium text-gray-700">
                    Group <span class="text-red-500">*</span>
                </label>
                <select name="group"
                        id="group"
                        required
                        class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($grp); ?>" <?php echo e(old('group', $setting->group) === $grp ? 'selected' : ''); ?>><?php echo e(ucfirst($grp)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="_new">+ New Group...</option>
                </select>
                <?php $__errorArgs = ['group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div id="new_group_container" class="hidden">
                <label for="new_group" class="block text-sm font-medium text-gray-700">New Group Name</label>
                <input type="text"
                       name="new_group"
                       id="new_group"
                       value="<?php echo e(old('new_group')); ?>"
                       pattern="[a-z0-9_]+"
                       title="Only lowercase letters, numbers, and underscores"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                       placeholder="new_group">
                <p class="mt-1 text-xs text-gray-500">Only lowercase letters, numbers, and underscores.</p>
            </div>

            
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                <textarea name="value"
                          id="value"
                          rows="3"
                          class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('value', $setting->value)); ?></textarea>
                <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description"
                          id="description"
                          rows="2"
                          class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="Brief description of what this setting controls"><?php echo e(old('description', $setting->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                <input type="number"
                       name="sort_order"
                       id="sort_order"
                       value="<?php echo e(old('sort_order', $setting->sort_order)); ?>"
                       class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-32 sm:text-sm border-gray-300 rounded-md <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3 rounded-b-lg">
            <a href="<?php echo e(route('admin.settings.index', ['group' => $setting->group])); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Update Setting
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
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
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>