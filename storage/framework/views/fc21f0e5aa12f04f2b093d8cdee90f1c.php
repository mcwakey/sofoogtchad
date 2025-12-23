<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'subtitle' => null,
    'description' => '',
    'image' => null,
    'imageAlt' => null,
    'imagePosition' => 'left',
    'reverse' => false,
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
    'subtitle' => null,
    'description' => '',
    'image' => null,
    'imageAlt' => null,
    'imagePosition' => 'left',
    'reverse' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $isReversed = $reverse || $imagePosition === 'right';
?>

<section <?php echo e($attributes->merge(['class' => 'about-snippet py-12 md:py-16 bg-white dark:bg-gray-900 transition-colors duration-200'])); ?>>
    <div class="container mx-auto px-4">
        <div class="flex flex-col <?php echo e($isReversed ? 'lg:flex-row-reverse' : 'lg:flex-row'); ?> items-center gap-8 lg:gap-12">
            
            <?php if($image): ?>
                <div class="w-full lg:w-1/2">
                    <div class="relative rounded-2xl overflow-hidden shadow-lg dark:shadow-gray-800/30">
                        <img
                            src="<?php echo e($image); ?>"
                            alt="<?php echo e($imageAlt ?? $title); ?>"
                            class="w-full h-64 sm:h-80 lg:h-96 object-cover"
                            loading="lazy"
                        >
                        
                        <div class="absolute -bottom-4 <?php echo e($isReversed ? '-left-4' : '-right-4'); ?> w-24 h-24 bg-green-500/20 rounded-full blur-2xl"></div>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="w-full <?php echo e($image ? 'lg:w-1/2' : ''); ?>">
                
                <?php if($subtitle): ?>
                    <span class="inline-block text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider mb-2">
                        <?php echo e($subtitle); ?>

                    </span>
                <?php endif; ?>

                
                <?php if($title): ?>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        <?php echo e($title); ?>

                    </h2>
                <?php endif; ?>

                
                <?php if($description): ?>
                    <div class="text-gray-600 dark:text-gray-300 leading-relaxed space-y-4">
                        <?php echo nl2br(e($description)); ?>

                    </div>
                <?php endif; ?>

                
                <?php if($slot->isNotEmpty()): ?>
                    <div class="mt-6">
                        <?php echo e($slot); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/about-snippet.blade.php ENDPATH**/ ?>