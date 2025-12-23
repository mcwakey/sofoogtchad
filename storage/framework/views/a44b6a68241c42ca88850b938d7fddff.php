<?php $__env->startSection('title', isset($category) ? $category->name . ' - Products' : trans_setting('site_name', 'Sofoodtchad') . ' - Our Products'); ?>

<?php $__env->startSection('meta_description', isset($category) ? $category->description : 'Explore our range of premium quality food products from Sofoodtchad.'); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative bg-gradient-to-br from-green-600 to-green-800 py-16 md:py-20 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-block text-green-200 font-semibold text-sm uppercase tracking-wider mb-4">
                    <?php echo e(isset($category) ? __('products.category') : __('products.discover')); ?>

                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                    <?php echo e(isset($category) ? $category->name : __('products.title')); ?>

                </h1>
                <p class="text-lg text-green-100">
                    <?php echo e(isset($category) ? $category->description : trans_setting('homepage_products_subtitle', 'Discover our range of premium quality food products')); ?>

                </p>
            </div>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-gray-50 dark:fill-gray-800"/>
            </svg>
        </div>
    </section>

    
    <section class="py-12 md:py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
        <div class="container mx-auto px-4">
            
            <?php if((isset($categories) && $categories->count() > 0) || (isset($types) && count($types) > 0)): ?>
                <div class="mb-10">
                    
                    <button
                        type="button"
                        class="md:hidden w-full flex items-center justify-between px-4 py-3 bg-white dark:bg-gray-700 rounded-lg shadow mb-4"
                        onclick="document.getElementById('filter-panel').classList.toggle('hidden')"
                    >
                        <span class="font-medium text-gray-900 dark:text-white"><?php echo e(__('products.filters')); ?></span>
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                    </button>

                    
                    <div id="filter-panel" class="hidden md:block bg-white dark:bg-gray-700 rounded-xl shadow-sm dark:shadow-gray-900/30 p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                            
                            <?php if(isset($categories) && $categories->count() > 0): ?>
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3"><?php echo e(__('products.categories')); ?></h3>
                                    <div class="flex flex-wrap gap-2">
                                        <a
                                            href="<?php echo e(route('products.index')); ?>"
                                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors <?php echo e(!isset($category) && !request('category') ? 'bg-green-600 text-white' : 'bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500'); ?>"
                                        >
                                            <?php echo e(__('products.all_products')); ?>

                                        </a>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a
                                                href="<?php echo e(route('products.category', $cat->slug)); ?>"
                                                class="px-4 py-2 rounded-full text-sm font-medium transition-colors <?php echo e((isset($category) && $category->id === $cat->id) || request('category') === $cat->slug ? 'bg-green-600 text-white' : 'bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500'); ?>"
                                            >
                                                <?php echo e($cat->name); ?>

                                                <?php if($cat->products_count): ?>
                                                    <span class="ml-1 text-xs opacity-75">(<?php echo e($cat->products_count); ?>)</span>
                                                <?php endif; ?>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            
                            <?php if(isset($types) && count($types) > 0): ?>
                                <div class="md:border-l md:border-gray-200 dark:md:border-gray-600 md:pl-6 md:ml-6">
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3"><?php echo e(__('products.type')); ?></h3>
                                    <div class="flex flex-wrap gap-2">
                                        <a
                                            href="<?php echo e(request()->fullUrlWithQuery(['type' => null])); ?>"
                                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors <?php echo e(!request('type') ? 'bg-green-600 text-white' : 'bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500'); ?>"
                                        >
                                            <?php echo e(__('products.all_types')); ?>

                                        </a>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeKey => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a
                                                href="<?php echo e(request()->fullUrlWithQuery(['type' => $typeKey])); ?>"
                                                class="px-4 py-2 rounded-full text-sm font-medium transition-colors <?php echo e(request('type') === $typeKey ? 'bg-green-600 text-white' : 'bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500'); ?>"
                                            >
                                                <?php echo e($typeLabel); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if(request('type') || isset($category)): ?>
                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('products.active_filters')); ?></span>
                    <?php if(isset($category)): ?>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-sm rounded-full">
                            <?php echo e($category->name); ?>

                            <a href="<?php echo e(route('products.index', request()->except('category'))); ?>" class="ml-1 hover:text-green-600 dark:hover:text-green-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if(request('type')): ?>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-sm rounded-full">
                            <?php echo e($types[request('type')] ?? request('type')); ?>

                            <a href="<?php echo e(request()->fullUrlWithQuery(['type' => null])); ?>" class="ml-1 hover:text-green-600 dark:hover:text-green-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        </span>
                    <?php endif; ?>
                    <a href="<?php echo e(route('products.index')); ?>" class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 ml-2">
                        <?php echo e(__('products.clear_all')); ?>

                    </a>
                </div>
            <?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginala87666a6c7dfd023b4375fc379bf394c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala87666a6c7dfd023b4375fc379bf394c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-grid','data' => ['products' => $products,'columns' => 4,'emptyMessage' => ''.e(__('products.no_products_found')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($products),'columns' => 4,'emptyMessage' => ''.e(__('products.no_products_found')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $attributes = $__attributesOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $component = $__componentOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__componentOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>

            
            <?php if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages()): ?>
                <div class="mt-10">
                    <?php echo e($products->withQueryString()->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <?php if(isset($category) && $category->description): ?>
        <section class="py-12 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">About <?php echo e($category->name); ?></h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        <?php echo e($category->description); ?>

                    </p>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <section class="py-16 bg-gradient-to-r from-green-600 to-green-700">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        <?php echo e(trans_setting('products_cta_title', __('products.need_help'))); ?>

                    </h2>
                    <p class="text-green-100">
                        <?php echo e(trans_setting('products_cta_description', __('products.contact_support'))); ?>

                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo e(route('distributor.request')); ?>" class="px-6 py-3 bg-white text-green-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                        <?php echo e(__('home.become_distributor')); ?>

                    </a>
                    <a href="/contact" class="px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-green-600 transition-colors">
                        <?php echo e(__('general.contact_us')); ?>

                    </a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Mobile filter panel persistence
    document.addEventListener('DOMContentLoaded', function() {
        const filterPanel = document.getElementById('filter-panel');
        if (window.innerWidth >= 768) {
            filterPanel.classList.remove('hidden');
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/products/index.blade.php ENDPATH**/ ?>