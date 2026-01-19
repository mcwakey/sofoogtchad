<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'logoImage' => null,
    'logo_image' => null,
    'link' => null,
    'description' => null,
    'size' => 'md',
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
    'name' => '',
    'logoImage' => null,
    'logo_image' => null,
    'link' => null,
    'description' => null,
    'size' => 'md',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $logo = $logoImage ?? $logo_image;

    $sizeClasses = match($size) {
        'sm' => 'p-4 h-20',
        'lg' => 'p-8 h-40',
        default => 'p-6 h-28',
    };

    $imgSizeClasses = match($size) {
        'sm' => 'max-h-12',
        'lg' => 'max-h-24',
        default => 'max-h-16',
    };
?>

<div <?php echo e($attributes->merge(['class' => 'partner-card bg-white dark:bg-gray-700 rounded-xl shadow-sm dark:shadow-gray-900/30 border border-gray-100 dark:border-gray-600 hover:shadow-md dark:hover:shadow-gray-900/50 transition-all duration-300 ' . $sizeClasses])); ?>>
    <?php if($link): ?>
        <a
            href="<?php echo e($link); ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center justify-center h-full w-full group"
            title="<?php echo e($name); ?>"
        >
    <?php else: ?>
        <div class="flex items-center justify-center h-full w-full">
    <?php endif; ?>

        <?php if($logo): ?>
            <?php
                if (Str::startsWith($logo, ['http://', 'https://'])) {
                    $logoUrl = $logo;
                } elseif (Str::startsWith($logo, '/storage/')) {
                    $logoUrl = asset($logo);
                } else {
                    $logoUrl = asset('storage/' . ltrim($logo, '/'));
                }
            ?>
            <img
                src="<?php echo e($logoUrl); ?>"
                alt="<?php echo e($name); ?>"
                class="<?php echo e($imgSizeClasses); ?> max-w-full object-contain grayscale hover:grayscale-0 opacity-70 hover:opacity-100 transition-all duration-300"
                loading="lazy"
            >
        <?php else: ?>
            <span class="text-gray-600 dark:text-gray-300 font-semibold text-center"><?php echo e($name); ?></span>
        <?php endif; ?>

    <?php if($link): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>

    
    <?php if($description): ?>
        <div class="sr-only"><?php echo e($description); ?></div>
    <?php endif; ?>
</div>


<?php if($slot->isNotEmpty()): ?>
    <div class="mt-2 text-center">
        <?php echo e($slot); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/partner-card.blade.php ENDPATH**/ ?>