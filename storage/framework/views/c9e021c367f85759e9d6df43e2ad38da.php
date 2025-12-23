<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'products' => [],
    'columns' => 4,
    'title' => null,
    'subtitle' => null,
    'viewAllUrl' => null,
    'viewAllText' => null,
    'emptyMessage' => null,
    'showBadge' => true,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'products' => [],
    'columns' => 4,
    'title' => null,
    'subtitle' => null,
    'viewAllUrl' => null,
    'viewAllText' => null,
    'emptyMessage' => null,
    'showBadge' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $viewAllText = $viewAllText ?? __('products.view_all_products');
    $emptyMessage = $emptyMessage ?? __('products.no_products_found');

    $gridCols = match($columns) {
        2 => 'grid-cols-1 sm:grid-cols-2',
        3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        5 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5',
        6 => 'grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6',
        default => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4', // 4 columns
    };
?>

<section <?php echo e($attributes->merge(['class' => 'product-grid-section'])); ?>>
    
    <?php if($title || $subtitle || $viewAllUrl): ?>
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 gap-4">
            <div>
                <?php if($title): ?>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white"><?php echo e($title); ?></h2>
                <?php endif; ?>
                <?php if($subtitle): ?>
                    <p class="mt-2 text-gray-600 dark:text-gray-300"><?php echo e($subtitle); ?></p>
                <?php endif; ?>
            </div>

            <?php if($viewAllUrl): ?>
                <a href="<?php echo e($viewAllUrl); ?>" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 transition-colors whitespace-nowrap">
                    <?php echo e($viewAllText); ?>

                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php if(count($products) > 0): ?>
        <div class="grid <?php echo e($gridCols); ?> gap-6">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // Support both array and object formats
                    $isArray = is_array($product);
                    $name = $isArray ? ($product['name'] ?? '') : ($product->name ?? '');
                    $description = $isArray
                        ? ($product['description'] ?? '')
                        : Str::limit($product->short_description ?? $product->description ?? '', 100);
                    $image = $isArray
                        ? ($product['image'] ?? '/images/placeholder-product.jpg')
                        : ($product->featured_image ?? $product->image ?? '/images/placeholder-product.jpg');
                    $url = $isArray
                        ? ($product['url'] ?? '#')
                        : route('products.show', $product->slug);
                    $badge = $isArray
                        ? ($product['badge'] ?? null)
                        : ($showBadge && $product->category ? $product->category->name : null);
                    $price = $isArray ? ($product['price'] ?? null) : ($product->price ?? null);
                    $salePrice = $isArray ? ($product['sale_price'] ?? null) : ($product->sale_price ?? null);
                    $sizes = $isArray ? null : ($product->sizes ?? null);
                ?>
                <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['image' => $image,'imageAlt' => $name,'title' => $name,'description' => $description,'link' => $url,'linkText' => __('products.view_product'),'badge' => $badge,'badgeColor' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image),'imageAlt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'linkText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('products.view_product')),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge),'badgeColor' => 'green']); ?>
                    
                    <?php if($price): ?>
                        <div class="flex items-center gap-2 mt-2">
                            <?php if($salePrice): ?>
                                <span class="text-lg font-bold text-green-600">
                                    <?php echo e(number_format($salePrice, 0)); ?> FCFA
                                </span>
                                <span class="text-sm text-gray-400 line-through">
                                    <?php echo e(number_format($price, 0)); ?> FCFA
                                </span>
                            <?php else: ?>
                                <span class="text-lg font-bold text-green-600">
                                    <?php echo e(number_format($price, 0)); ?> FCFA
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    
                    <?php if($sizes && $sizes->count() > 0): ?>
                        <p class="text-xs text-gray-500 mt-1">
                            <?php echo e($sizes->count()); ?> size<?php echo e($sizes->count() > 1 ? 's' : ''); ?> available
                        </p>
                    <?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        
        <div class="text-center py-12 bg-gray-50 dark:bg-gray-800 rounded-lg">
            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white"><?php echo e($emptyMessage); ?></h3>
            <?php if($viewAllUrl): ?>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    <a href="<?php echo e($viewAllUrl); ?>" class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300">Browse our catalog</a>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php if($slot->isNotEmpty()): ?>
        <div class="mt-8">
            <?php echo e($slot); ?>

        </div>
    <?php endif; ?>
</section>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/product-grid.blade.php ENDPATH**/ ?>