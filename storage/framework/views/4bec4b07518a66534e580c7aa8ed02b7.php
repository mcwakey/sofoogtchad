<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'image' => null,
    'imageAlt' => '',
    'title' => '',
    'description' => '',
    'link' => null,
    'linkText' => null,
    'badge' => null,
    'badgeColor' => 'green',
    'variant' => 'default',
    'hover' => true,
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
    'image' => null,
    'imageAlt' => '',
    'title' => '',
    'description' => '',
    'link' => null,
    'linkText' => null,
    'badge' => null,
    'badgeColor' => 'green',
    'variant' => 'default',
    'hover' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $linkText = $linkText ?? __('general.learn_more');

    $badgeColors = [
        'green' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
        'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300',
        'red' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
        'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
        'gray' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'orange' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300',
    ];

    $cardClasses = 'bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md dark:shadow-gray-900/30 border border-gray-100 dark:border-gray-600';
    if ($hover) {
        $cardClasses .= ' transition-all duration-300 hover:shadow-xl dark:hover:shadow-gray-900/50 hover:-translate-y-1';
    }

    $variantClasses = match($variant) {
        'horizontal' => 'flex flex-col md:flex-row',
        'compact' => '',
        default => '',
    };
?>

<article <?php echo e($attributes->merge(['class' => "{$cardClasses} {$variantClasses}"])); ?>>
    
    <?php if($image): ?>
        <div class="relative <?php echo e($variant === 'horizontal' ? 'md:w-1/3 md:flex-shrink-0' : ''); ?>">
            <?php if($link): ?>
                <a href="<?php echo e($link); ?>" class="block">
            <?php endif; ?>

            <img
                src="<?php echo e($image); ?>"
                alt="<?php echo e($imageAlt ?: $title); ?>"
                class="w-full h-48 object-cover <?php echo e($variant === 'horizontal' ? 'md:h-full' : ''); ?>"
                loading="lazy"
            >

            
            <?php if($badge): ?>
                <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full <?php echo e($badgeColors[$badgeColor] ?? $badgeColors['green']); ?>">
                    <?php echo e($badge); ?>

                </span>
            <?php endif; ?>

            <?php if($link): ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <div class="p-5 <?php echo e($variant === 'horizontal' ? 'md:flex md:flex-col md:justify-center' : ''); ?>">
        
        <?php if($title): ?>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                <?php if($link): ?>
                    <a href="<?php echo e($link); ?>" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        <?php echo e($title); ?>

                    </a>
                <?php else: ?>
                    <?php echo e($title); ?>

                <?php endif; ?>
            </h3>
        <?php endif; ?>

        
        <?php if($description): ?>
            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                <?php echo e($description); ?>

            </p>
        <?php endif; ?>

        
        <?php if($slot->isNotEmpty()): ?>
            <div class="card-extra">
                <?php echo e($slot); ?>

            </div>
        <?php endif; ?>

        
        <?php if($link && $linkText): ?>
            <a href="<?php echo e($link); ?>" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium text-sm hover:text-green-700 dark:hover:text-green-300 transition-colors mt-auto">
                <?php echo e($linkText); ?>

                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        <?php endif; ?>
    </div>
</article>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/card.blade.php ENDPATH**/ ?>