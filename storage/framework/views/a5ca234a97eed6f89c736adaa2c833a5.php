<?php $__env->startSection('title', 'Create Blog Post'); ?>
<?php $__env->startSection('page-title', 'Create Post'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="<?php echo e(route('admin.posts.index')); ?>" class="hover:text-gray-700">Blog Posts</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">Create Post</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Create New Post</h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('admin.posts.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Post Content</h2>

                    
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                            Slug <span class="text-gray-400 text-xs font-normal">(auto-generated from French title if empty)</span>
                        </label>
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="<?php echo e(old('slug')); ?>"
                            class="block w-full <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="post-url-slug"
                        >
                        <?php $__errorArgs = ['slug'];
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-input','data' => ['name' => 'title','label' => 'Title','required' => true,'placeholder' => 'Enter post title']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Title','required' => true,'placeholder' => 'Enter post title']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'excerpt','label' => 'Summary / Excerpt','rows' => 3,'placeholder' => 'Brief summary for listings and SEO']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'excerpt','label' => 'Summary / Excerpt','rows' => 3,'placeholder' => 'Brief summary for listings and SEO']); ?>
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

                            <?php if (isset($component)) { $__componentOriginal8c954ff3f65735c06e5d1158e2b9f1f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c954ff3f65735c06e5d1158e2b9f1f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'content','label' => 'Content','required' => true,'rows' => 15,'placeholder' => 'Write your post content here... HTML is supported.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'content','label' => 'Content','required' => true,'rows' => 15,'placeholder' => 'Write your post content here... HTML is supported.']); ?>
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
                    <p class="mt-2 text-xs text-gray-500">You can use HTML for formatting. A rich text editor can be integrated later.</p>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Featured Image</h2>

                    <div x-data="{ imagePreview: null }">
                        <div class="flex items-center justify-center w-full">
                            <label
                                for="featured_image"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                                x-show="!imagePreview"
                            >
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <input
                                    id="featured_image"
                                    name="featured_image"
                                    type="file"
                                    class="hidden"
                                    accept="image/*"
                                    @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = (e) => imagePreview = e.target.result; reader.readAsDataURL(file); }"
                                >
                            </label>

                            
                            <div x-show="imagePreview" class="relative w-full">
                                <img :src="imagePreview" class="w-full h-48 object-cover rounded-lg">
                                <button
                                    type="button"
                                    @click="imagePreview = null; document.getElementById('featured_image').value = ''"
                                    class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php $__errorArgs = ['featured_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h2>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-input','data' => ['name' => 'meta_title','label' => 'Meta Title','placeholder' => 'SEO title (defaults to post title)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'meta_title','label' => 'Meta Title','placeholder' => 'SEO title (defaults to post title)']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'meta_description','label' => 'Meta Description','rows' => 2,'placeholder' => 'SEO description for search engines']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'meta_description','label' => 'Meta Description','rows' => 2,'placeholder' => 'SEO description for search engines']); ?>
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
            </div>

            
            <div class="space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Publish Settings</h2>

                    <div class="space-y-4">
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select id="status" name="status" class="block w-full">
                                <option value="draft" <?php echo e(old('status', 'draft') === 'draft' ? 'selected' : ''); ?>>Draft</option>
                                <option value="published" <?php echo e(old('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                                <option value="archived" <?php echo e(old('status') === 'archived' ? 'selected' : ''); ?>>Archived</option>
                            </select>
                        </div>

                        
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                Type
                            </label>
                            <select id="type" name="type" class="block w-full">
                                <option value="blog" <?php echo e(old('type', 'blog') === 'blog' ? 'selected' : ''); ?>>Blog</option>
                                <option value="news" <?php echo e(old('type') === 'news' ? 'selected' : ''); ?>>News</option>
                            </select>
                        </div>

                        
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">
                                Publish Date
                            </label>
                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                value="<?php echo e(old('published_at')); ?>"
                                class="block w-full"
                            >
                            <p class="mt-1 text-xs text-gray-500">Leave empty for immediate publish</p>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Post
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="<?php echo e(route('admin.posts.index')); ?>" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

                
                <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-blue-900">Writing Tips</h3>
                            <ul class="mt-2 text-sm text-blue-800 space-y-1">
                                <li>• Use a compelling headline</li>
                                <li>• Add a featured image</li>
                                <li>• Write a clear summary</li>
                                <li>• Include relevant keywords</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>