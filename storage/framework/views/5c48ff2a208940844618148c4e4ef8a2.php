<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('page-title', 'Products'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Products</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your product catalog</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="<?php echo e(route('admin.products.create')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Product
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="<?php echo e(route('admin.products.index')); ?>" class="flex flex-col sm:flex-row gap-4">
            
            <div class="flex-1">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        placeholder="Search products..."
                        class="block w-full rounded-lg border-gray-300 pl-10 text-sm focus:border-green-500 focus:ring-green-500"
                    >
                </div>
            </div>

            
            <div class="sm:w-48">
                <select name="category" class="block w-full rounded-lg border-gray-300 text-sm focus:border-green-500 focus:ring-green-500">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div class="sm:w-40">
                <select name="type" class="block w-full rounded-lg border-gray-300 text-sm focus:border-green-500 focus:ring-green-500">
                    <option value="">All Types</option>
                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(request('type') === $value ? 'selected' : ''); ?>>
                            <?php echo e($label); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div class="sm:w-36">
                <select name="status" class="block w-full rounded-lg border-gray-300 text-sm focus:border-green-500 focus:ring-green-500">
                    <option value="">All Status</option>
                    <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                    <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>

            
            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <?php if(request()->hasAny(['search', 'category', 'type', 'status'])): ?>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                        Clear
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Created
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-gray-100 overflow-hidden">
                                        <?php if($product->image_url): ?>
                                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" class="h-full w-full object-cover">
                                        <?php else: ?>
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($product->name); ?></div>
                                        <?php if($product->sku): ?>
                                            <div class="text-xs text-gray-500">SKU: <?php echo e($product->sku); ?></div>
                                        <?php endif; ?>
                                        <?php if($product->is_featured): ?>
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                                                ★ Featured
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($product->category): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?php echo e($product->category->name); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-sm text-gray-400">Uncategorized</span>
                                <?php endif; ?>
                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo e($product->type_label); ?>

                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($product->is_active): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Active
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        Draft
                                    </span>
                                <?php endif; ?>
                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e($product->created_at->format('M d, Y')); ?>

                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" x-data="{ showDeleteModal: false }">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?php echo e(route('admin.products.show', $product)); ?>" class="text-blue-500 hover:text-blue-700 transition-colors" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="text-green-600 hover:text-green-700 transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button type="button" @click="showDeleteModal = true" class="text-red-500 hover:text-red-700 transition-colors" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
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
                                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Product</h3>
                                                    <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                                                    <p class="text-lg font-medium text-gray-900 mb-4">"<?php echo e($product->name); ?>"?</p>
                                                    <p class="text-sm text-gray-500">This action cannot be undone.</p>
                                                </div>
                                                <div class="p-6 pt-0 flex gap-3">
                                                    <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                                        Cancel
                                                    </button>
                                                    <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="flex-1">
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
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <h3 class="text-sm font-medium text-gray-900 mb-1">No products found</h3>
                                    <p class="text-sm text-gray-500 mb-4">Get started by creating a new product.</p>
                                    <a href="<?php echo e(route('admin.products.create')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Add Product
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($products->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <?php echo e($products->withQueryString()->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/products/index.blade.php ENDPATH**/ ?>