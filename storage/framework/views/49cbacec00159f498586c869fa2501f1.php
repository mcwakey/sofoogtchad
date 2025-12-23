<?php $__env->startSection('title', 'Edit Post: ' . $post->title); ?>
<?php $__env->startSection('page-title', 'Edit Post'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="<?php echo e(route('admin.posts.index')); ?>" class="hover:text-gray-700">Blog Posts</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900"><?php echo e(Str::limit($post->title, 30)); ?></span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Edit Post</h1>
        </div>
        <?php if($post->isPublished()): ?>
            <div class="mt-4 sm:mt-0">
                <a href="<?php echo e(route('blog.show', $post->slug)); ?>" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Post
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('admin.posts.update', $post)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Post Content</h2>

                    
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                            Slug
                        </label>
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="<?php echo e(old('slug', $post->slug)); ?>"
                            class="block w-full <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-input','data' => ['name' => 'title','label' => 'Title','model' => $post,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Title','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'excerpt','label' => 'Summary / Excerpt','model' => $post,'rows' => 3]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'excerpt','label' => 'Summary / Excerpt','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post),'rows' => 3]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'content','label' => 'Content','model' => $post,'required' => true,'rows' => 15]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'content','label' => 'Content','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post),'required' => true,'rows' => 15]); ?>
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
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Featured Image</h2>

                    
                    <?php if($post->featured_image): ?>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Current Image:</p>
                            <div class="relative inline-block">
                                <img src="<?php echo e($post->image_url); ?>" alt="<?php echo e($post->title); ?>" class="h-40 w-auto rounded-lg object-cover">
                                <span class="absolute bottom-2 left-2 px-2 py-1 bg-black/60 text-white text-xs rounded">Current</span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div x-data="{ imagePreview: null }">
                        <p class="text-sm text-gray-500 mb-2"><?php echo e($post->featured_image ? 'Replace with new image:' : 'Upload image:'); ?></p>
                        <div class="flex items-center justify-center w-full">
                            <label
                                for="featured_image"
                                class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                                x-show="!imagePreview"
                            >
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
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
                                <img :src="imagePreview" class="w-full h-36 object-cover rounded-lg">
                                <span class="absolute bottom-2 left-2 px-2 py-1 bg-green-600 text-white text-xs rounded">New</span>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-input','data' => ['name' => 'meta_title','label' => 'Meta Title','model' => $post,'placeholder' => 'SEO title (defaults to post title)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'meta_title','label' => 'Meta Title','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post),'placeholder' => 'SEO title (defaults to post title)']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'meta_description','label' => 'Meta Description','model' => $post,'rows' => 2]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'meta_description','label' => 'Meta Description','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post),'rows' => 2]); ?>
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
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Publish</h2>

                    <div class="space-y-4">
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select id="status" name="status" class="block w-full">
                                <option value="draft" <?php echo e(old('status', $post->status) === 'draft' ? 'selected' : ''); ?>>Draft</option>
                                <option value="published" <?php echo e(old('status', $post->status) === 'published' ? 'selected' : ''); ?>>Published</option>
                                <option value="archived" <?php echo e(old('status', $post->status) === 'archived' ? 'selected' : ''); ?>>Archived</option>
                            </select>
                        </div>

                        
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                Type
                            </label>
                            <select id="type" name="type" class="block w-full">
                                <option value="blog" <?php echo e(old('type', $post->type) === 'blog' ? 'selected' : ''); ?>>Blog</option>
                                <option value="news" <?php echo e(old('type', $post->type) === 'news' ? 'selected' : ''); ?>>News</option>
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
                                value="<?php echo e(old('published_at', $post->published_at?->format('Y-m-d\TH:i'))); ?>"
                                class="block w-full"
                            >
                        </div>

                        
                        <div class="py-2 border-t border-gray-100 text-sm text-gray-500">
                            <p>Created: <?php echo e($post->created_at->format('M d, Y')); ?></p>
                            <p>Updated: <?php echo e($post->updated_at->format('M d, Y')); ?></p>
                            <?php if($post->author): ?>
                                <p>Author: <?php echo e($post->author->name); ?></p>
                            <?php endif; ?>
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
                        <a href="<?php echo e(route('admin.posts.index')); ?>" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    
    <div class="mt-6 max-w-sm ml-auto lg:mr-0" x-data="{ showDeleteModal: false }">
        <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6">
            <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
            <p class="text-sm text-gray-600 mb-4">Once you delete a post, there is no going back.</p>
            <button
                type="button"
                @click="showDeleteModal = true"
                class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Post
            </button>

            
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
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Post</h3>
                            <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                            <p class="text-lg font-medium text-gray-900 mb-4">"<?php echo e($post->title); ?>"?</p>
                            <p class="text-sm text-gray-500">This action cannot be undone.</p>
                        </div>
                        <div class="p-6 pt-0 flex gap-3">
                            <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <form action="<?php echo e(route('admin.posts.destroy', $post)); ?>" method="POST" class="flex-1">
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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/posts/edit.blade.php ENDPATH**/ ?>