<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'primary',
    'text' => '',
    'url' => null,
    'href' => null,
    'target' => null,
    'disabled' => false,
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'submit' => false,
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
    'type' => 'primary',
    'text' => '',
    'url' => null,
    'href' => null,
    'target' => null,
    'disabled' => false,
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'submit' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $link = $url ?? $href;

    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-6 py-3 text-lg',
        'xl' => 'px-8 py-4 text-xl',
        default => 'px-4 py-2 text-base',
    };

    $typeClasses = match($type) {
        'primary' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 active:bg-green-800',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500 active:bg-gray-800',
        'outline' => 'border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white focus:ring-green-500',
        'outline-secondary' => 'border-2 border-gray-600 text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-500',
        'ghost' => 'text-green-600 hover:bg-green-50 focus:ring-green-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 active:bg-red-800',
        'white' => 'bg-white text-gray-900 hover:bg-gray-100 focus:ring-gray-300 shadow-sm',
        default => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 active:bg-green-800',
    };

    $classes = "{$baseClasses} {$sizeClasses} {$typeClasses}";
?>

<?php if($link): ?>
    <a
        href="<?php echo e($link); ?>"
        <?php echo e($attributes->merge(['class' => $classes])); ?>

        <?php if($target): ?> target="<?php echo e($target); ?>" <?php endif; ?>
        <?php if($target === '_blank'): ?> rel="noopener noreferrer" <?php endif; ?>
    >
        <?php if($icon && $iconPosition === 'left'): ?>
            <span class="mr-2"><?php echo $icon; ?></span>
        <?php endif; ?>

        <?php echo e($text ?: $slot); ?>


        <?php if($icon && $iconPosition === 'right'): ?>
            <span class="ml-2"><?php echo $icon; ?></span>
        <?php endif; ?>
    </a>
<?php else: ?>
    <button
        type="<?php echo e($submit ? 'submit' : 'button'); ?>"
        <?php echo e($attributes->merge(['class' => $classes])); ?>

        <?php if($disabled): ?> disabled <?php endif; ?>
    >
        <?php if($icon && $iconPosition === 'left'): ?>
            <span class="mr-2"><?php echo $icon; ?></span>
        <?php endif; ?>

        <?php echo e($text ?: $slot); ?>


        <?php if($icon && $iconPosition === 'right'): ?>
            <span class="ml-2"><?php echo $icon; ?></span>
        <?php endif; ?>
    </button>
<?php endif; ?>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/button.blade.php ENDPATH**/ ?>