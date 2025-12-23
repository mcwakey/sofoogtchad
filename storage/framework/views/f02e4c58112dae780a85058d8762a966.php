<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'summary' => '',
    'description' => null,
    'image' => null,
    'link' => null,
    'publishedDate' => null,
    'published_date' => null,
    'author' => null,
    'category' => null,
    'categoryLink' => null,
    'layout' => 'vertical',
    'featured' => false,
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
    'title' => '',
    'summary' => '',
    'description' => null,
    'image' => null,
    'link' => null,
    'publishedDate' => null,
    'published_date' => null,
    'author' => null,
    'category' => null,
    'categoryLink' => null,
    'layout' => 'vertical',
    'featured' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $date = $publishedDate ?? $published_date;
    $desc = $summary ?: $description;
    $formattedDate = $date ? \Carbon\Carbon::parse($date)->format('M d, Y') : null;
?>

<?php if($layout === 'horizontal'): ?>
    
    <article <?php echo e($attributes->merge(['class' => 'post-card bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md dark:shadow-gray-900/30 hover:shadow-xl dark:hover:shadow-gray-900/50 transition-all duration-300 flex flex-col md:flex-row'])); ?>>
        
        <?php if($image): ?>
            <div class="md:w-2/5 flex-shrink-0">
                <?php if($link): ?>
                    <a href="<?php echo e($link); ?>" class="block h-full">
                <?php endif; ?>
                <img
                    src="<?php echo e($image); ?>"
                    alt="<?php echo e($title); ?>"
                    class="w-full h-48 md:h-full object-cover"
                    loading="lazy"
                >
                <?php if($link): ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <div class="p-5 md:p-6 flex flex-col justify-center flex-1">
            
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-3">
                <?php if($category): ?>
                    <?php if($categoryLink): ?>
                        <a href="<?php echo e($categoryLink); ?>" class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium">
                            <?php echo e($category); ?>

                        </a>
                    <?php else: ?>
                        <span class="text-green-600 dark:text-green-400 font-medium"><?php echo e($category); ?></span>
                    <?php endif; ?>
                    <span>•</span>
                <?php endif; ?>
                <?php if($formattedDate): ?>
                    <time datetime="<?php echo e($date); ?>"><?php echo e($formattedDate); ?></time>
                <?php endif; ?>
                <?php if($author): ?>
                    <span>•</span>
                    <span><?php echo e($author); ?></span>
                <?php endif; ?>
            </div>

            
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                <?php if($link): ?>
                    <a href="<?php echo e($link); ?>" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        <?php echo e($title); ?>

                    </a>
                <?php else: ?>
                    <?php echo e($title); ?>

                <?php endif; ?>
            </h3>

            
            <?php if($desc): ?>
                <p class="text-gray-600 dark:text-gray-300 line-clamp-2 mb-4"><?php echo e($desc); ?></p>
            <?php endif; ?>

            
            <?php if($link): ?>
                <a href="<?php echo e($link); ?>" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 transition-colors mt-auto">
                    <?php echo e(__('blog.read_more')); ?>

                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </article>
<?php else: ?>
    
    <article <?php echo e($attributes->merge(['class' => 'post-card bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md dark:shadow-gray-900/30 hover:shadow-xl dark:hover:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1' . ($featured ? ' md:col-span-2' : '')])); ?>>
        
        <?php if($image): ?>
            <div class="relative">
                <?php if($link): ?>
                    <a href="<?php echo e($link); ?>" class="block">
                <?php endif; ?>
                <img
                    src="<?php echo e($image); ?>"
                    alt="<?php echo e($title); ?>"
                    class="w-full h-48 <?php echo e($featured ? 'md:h-64' : ''); ?> object-cover"
                    loading="lazy"
                >
                <?php if($category): ?>
                    <span class="absolute top-3 left-3 px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                        <?php echo e($category); ?>

                    </span>
                <?php endif; ?>
                <?php if($link): ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <div class="p-5">
            
            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-3">
                <?php if($formattedDate): ?>
                    <time datetime="<?php echo e($date); ?>" class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php echo e($formattedDate); ?>

                    </time>
                <?php endif; ?>
                <?php if($author): ?>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <?php echo e($author); ?>

                    </span>
                <?php endif; ?>
            </div>

            
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                <?php if($link): ?>
                    <a href="<?php echo e($link); ?>" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        <?php echo e($title); ?>

                    </a>
                <?php else: ?>
                    <?php echo e($title); ?>

                <?php endif; ?>
            </h3>

            
            <?php if($desc): ?>
                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4"><?php echo e($desc); ?></p>
            <?php endif; ?>

            
            <?php if($slot->isNotEmpty()): ?>
                <div class="mb-4">
                    <?php echo e($slot); ?>

                </div>
            <?php endif; ?>

            
            <?php if($link): ?>
                <a href="<?php echo e($link); ?>" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium text-sm hover:text-green-700 dark:hover:text-green-300 transition-colors">
                    <?php echo e(__('blog.read_more')); ?>

                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </article>
<?php endif; ?>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/post-card.blade.php ENDPATH**/ ?>