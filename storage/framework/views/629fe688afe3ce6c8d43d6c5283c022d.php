<?php $__env->startSection('title', 'Edit Product: ' . $product->name); ?>
<?php $__env->startSection('page-title', 'Edit Product'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="<?php echo e(route('admin.products.index')); ?>" class="hover:text-gray-700">Products</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900"><?php echo e($product->name); ?></span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
        </div>
        <?php if($product->is_active): ?>
            <div class="mt-4 sm:mt-0">
                <a href="<?php echo e(route('products.show', $product->slug)); ?>" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Product
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            
            <form method="POST" action="<?php echo e(route('admin.products.update', $product)); ?>" enctype="multipart/form-data" id="product-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>

                    
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="<?php echo e(old('slug', $product->slug)); ?>"
                            required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 <?php $__errorArgs = ['slug'];
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-input','data' => ['name' => 'name','label' => 'Product Name','model' => $product,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','label' => 'Product Name','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'short_description','label' => 'Short Description','model' => $product,'rows' => 2]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'short_description','label' => 'Short Description','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product),'rows' => 2]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.translatable-textarea','data' => ['name' => 'description','label' => 'Full Description','model' => $product,'rows' => 6]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.translatable-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'description','label' => 'Full Description','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product),'rows' => 6]); ?>
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

                        
                        <input type="hidden" name="category_id" id="form_category_id" value="<?php echo e(old('category_id', $product->category_id)); ?>">
                        <input type="hidden" name="type" id="form_type" value="<?php echo e(old('type', $product->type)); ?>">
                        <input type="hidden" name="sku" id="form_sku" value="<?php echo e(old('sku', $product->sku)); ?>">
                        <input type="hidden" name="sort_order" id="form_sort_order" value="<?php echo e(old('sort_order', $product->sort_order)); ?>">
                        <input type="hidden" name="is_active" id="form_is_active" value="<?php echo e(old('is_active', $product->is_active) ? '1' : '0'); ?>">
                        <input type="hidden" name="is_featured" id="form_is_featured" value="<?php echo e(old('is_featured', $product->is_featured) ? '1' : '0'); ?>">
                </div>
            </form>

            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Product Images</h2>
                </div>

                
                <?php if($product->images->count() > 0): ?>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative group">
                                <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                    <img src="<?php echo e($image->image_path); ?>" alt="<?php echo e($image->alt_text); ?>" class="w-full h-full object-cover">
                                </div>
                                <?php if($image->is_primary): ?>
                                    <span class="absolute top-2 left-2 px-2 py-0.5 bg-green-500 text-white text-xs font-medium rounded">Primary</span>
                                <?php endif; ?>
                                <form action="<?php echo e(route('admin.products.images.destroy', [$product, $image])); ?>" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" onclick="return confirm('Delete this image?')" class="p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8 mb-6 bg-gray-50 rounded-lg">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-gray-500">No images uploaded yet</p>
                    </div>
                <?php endif; ?>

                
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Add New Image</h3>
                    <form method="POST" action="<?php echo e(route('admin.products.images.store', $product)); ?>" enctype="multipart/form-data" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                Image File <span class="text-red-500">*</span>
                            </label>
                            <div 
                                x-data="{ 
                                    isDragging: false, 
                                    fileName: '',
                                    preview: null,
                                    handleDrop(e) {
                                        this.isDragging = false;
                                        const file = e.dataTransfer.files[0];
                                        if (file && file.type.startsWith('image/')) {
                                            this.$refs.fileInput.files = e.dataTransfer.files;
                                            this.fileName = file.name;
                                            this.preview = URL.createObjectURL(file);
                                        }
                                    },
                                    handleSelect(e) {
                                        const file = e.target.files[0];
                                        if (file) {
                                            this.fileName = file.name;
                                            this.preview = URL.createObjectURL(file);
                                        }
                                    }
                                }"
                                @dragover.prevent="isDragging = true"
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="handleDrop($event)"
                                :class="isDragging ? 'border-green-500 bg-green-50' : 'border-gray-300 bg-gray-50'"
                                class="relative border-2 border-dashed rounded-lg p-6 text-center hover:bg-gray-100 transition-colors cursor-pointer"
                                @click="$refs.fileInput.click()"
                            >
                                <input 
                                    type="file" 
                                    name="image" 
                                    id="image"
                                    x-ref="fileInput"
                                    @change="handleSelect($event)"
                                    accept="image/*"
                                    required
                                    class="hidden"
                                >
                                <template x-if="!preview">
                                    <div>
                                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP up to 2MB</p>
                                    </div>
                                </template>
                                <template x-if="preview">
                                    <div>
                                        <img :src="preview" class="w-24 h-24 object-cover rounded-lg mx-auto mb-2">
                                        <p class="text-sm text-gray-600" x-text="fileName"></p>
                                        <p class="text-xs text-green-600 mt-1">Click to change</p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-1">
                                    Alt Text
                                </label>
                                <input
                                    type="text"
                                    id="alt_text"
                                    name="alt_text"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Image description"
                                >
                            </div>
                            <div class="flex items-end gap-3 pb-0.5">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_primary" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                    <span class="text-sm text-gray-600">Primary</span>
                                </label>
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                    Upload Image
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Sizes</h2>

                <?php if($product->sizes->count() > 0): ?>
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase">Value</th>
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase">Price Adj.</th>
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase">Default</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900"><?php echo e($size->name); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($size->value ?? '-'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            <?php if($size->price_adjustment != 0): ?>
                                                <?php echo e($size->price_adjustment > 0 ? '+' : ''); ?><?php echo e(number_format($size->price_adjustment, 0)); ?> FCFA
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <?php if($size->is_default): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Default</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <form action="<?php echo e(route('admin.products.sizes.destroy', [$product, $size])); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" onclick="return confirm('Delete this size?')" class="text-red-500 hover:text-red-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6 mb-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">No sizes configured</p>
                    </div>
                <?php endif; ?>

                
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Add New Size</h3>
                    <form method="POST" action="<?php echo e(route('admin.products.sizes.store', $product)); ?>" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <input
                                type="text"
                                name="name"
                                required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                                placeholder="Size name (e.g., Small)"
                            >
                        </div>
                        <div>
                            <input
                                type="text"
                                name="value"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                                placeholder="Value (e.g., 500g)"
                            >
                        </div>
                        <div>
                            <input
                                type="number"
                                name="price_adjustment"
                                value="0"
                                step="1"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                                placeholder="Price adjustment"
                            >
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_default" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-600">Default</span>
                            </label>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Publish</h2>

                <div class="space-y-4">
                    
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-600">Status</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                class="sr-only peer"
                                <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?>

                                onchange="document.getElementById('form_is_active').value = this.checked ? '1' : '0'"
                            >
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                            <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>

                    
                    <div class="flex items-center justify-between py-2 border-t border-gray-100">
                        <span class="text-sm text-gray-600">Featured</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                class="sr-only peer"
                                <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?>

                                onchange="document.getElementById('form_is_featured').value = this.checked ? '1' : '0'"
                            >
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                            <span class="ml-2 text-sm font-medium text-gray-700">Featured</span>
                        </label>
                    </div>

                    
                    <div class="py-2 border-t border-gray-100 text-sm text-gray-500">
                        <p>Created: <?php echo e($product->created_at->format('M d, Y')); ?></p>
                        <p>Updated: <?php echo e($product->updated_at->format('M d, Y')); ?></p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" form="product-form" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update
                    </button>
                </div>

                <div class="mt-3">
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Organization</h2>

                <div class="space-y-4">
                    
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Category
                        </label>
                        <select
                            id="category_id"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            onchange="document.getElementById('form_category_id').value = this.value"
                        >
                            <option value="">No Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="type"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            onchange="document.getElementById('form_type').value = this.value"
                        >
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value); ?>" <?php echo e(old('type', $product->type) === $value ? 'selected' : ''); ?>>
                                    <?php echo e($label); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                            SKU
                        </label>
                        <input
                            type="text"
                            id="sku"
                            value="<?php echo e(old('sku', $product->sku)); ?>"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            oninput="document.getElementById('form_sku').value = this.value"
                        >
                    </div>

                    
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">
                            Sort Order
                        </label>
                        <input
                            type="number"
                            id="sort_order"
                            value="<?php echo e(old('sort_order', $product->sort_order)); ?>"
                            min="0"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            oninput="document.getElementById('form_sort_order').value = this.value"
                        >
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6" x-data="{ showDeleteModal: false }">
                <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
                <p class="text-sm text-gray-600 mb-4">Once you delete a product, there is no going back.</p>
                <button
                    type="button"
                    @click="showDeleteModal = true"
                    class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete Product
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
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Product</h3>
                                <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                                <p class="text-lg font-medium text-gray-900 mb-4">"<?php echo e($product->name); ?>"?</p>
                                <p class="text-sm text-gray-500">This action cannot be undone. All associated images and sizes will also be removed.</p>
                            </div>

                            
                            <div class="p-6 pt-0 flex gap-3">
                                <button
                                    type="button"
                                    @click="showDeleteModal = false"
                                    class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors"
                                >
                                    Cancel
                                </button>
                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button
                                        type="submit"
                                        class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors"
                                    >
                                        Yes, Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>