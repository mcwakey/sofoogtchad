<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'stepNumber' => null,
    'step_number' => null,
    'title' => '',
    'description' => '',
    'icon' => null,
    'image' => null,
    'layout' => 'vertical',
    'iconBgColor' => 'green',
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
    'stepNumber' => null,
    'step_number' => null,
    'title' => '',
    'description' => '',
    'icon' => null,
    'image' => null,
    'layout' => 'vertical',
    'iconBgColor' => 'green',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $number = $stepNumber ?? $step_number;
    $iconOrImage = $icon ?? $image;

    $bgColors = [
        'green' => 'bg-green-100 text-green-600',
        'blue' => 'bg-blue-100 text-blue-600',
        'orange' => 'bg-orange-100 text-orange-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
        'red' => 'bg-red-100 text-red-600',
        'purple' => 'bg-purple-100 text-purple-600',
    ];

    $bgClass = $bgColors[$iconBgColor] ?? $bgColors['green'];
?>

<?php if($layout === 'horizontal'): ?>
    
    <div <?php echo e($attributes->merge(['class' => 'process-step flex flex-col sm:flex-row items-start gap-4 sm:gap-6'])); ?>>
        
        <div class="flex-shrink-0 flex items-center gap-4">
            <?php if($number): ?>
                <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center text-xl font-bold shadow-lg">
                    <?php echo e($number); ?>

                </div>
            <?php endif; ?>

            <?php if($iconOrImage): ?>
                <div class="w-16 h-16 rounded-xl <?php echo e($bgClass); ?> flex items-center justify-center">
                    <?php if(Str::startsWith($iconOrImage, '<svg') || Str::startsWith($iconOrImage, '<img')): ?>
                        <?php echo $iconOrImage; ?>

                    <?php elseif(Str::startsWith($iconOrImage, 'http') || Str::startsWith($iconOrImage, '/storage') || Str::startsWith($iconOrImage, '/images')): ?>
                        <img src="<?php echo e($iconOrImage); ?>" alt="<?php echo e($title); ?>" class="w-10 h-10 object-contain">
                    <?php else: ?>
                        
                        <span class="text-3xl"><?php echo e($iconOrImage); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="flex-1">
            <?php if($title): ?>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white mb-2"><?php echo e($title); ?></h3>
            <?php endif; ?>
            <?php if($description): ?>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed"><?php echo e($description); ?></p>
            <?php endif; ?>

            <?php if($slot->isNotEmpty()): ?>
                <div class="mt-3">
                    <?php echo e($slot); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    
    <div <?php echo e($attributes->merge(['class' => 'process-step text-center'])); ?>>
        
        <?php if($number): ?>
            <div class="w-14 h-14 mx-auto rounded-full bg-green-600 text-white flex items-center justify-center text-2xl font-bold shadow-lg mb-4">
                <?php echo e($number); ?>

            </div>
        <?php endif; ?>

        
        <?php if($iconOrImage): ?>
            <div class="w-20 h-20 mx-auto rounded-2xl <?php echo e($bgClass); ?> flex items-center justify-center mb-4">
                <?php if(Str::startsWith($iconOrImage, '<svg') || Str::startsWith($iconOrImage, '<img')): ?>
                    <?php echo $iconOrImage; ?>

                <?php elseif(Str::startsWith($iconOrImage, 'http') || Str::startsWith($iconOrImage, '/storage') || Str::startsWith($iconOrImage, '/images')): ?>
                    <img src="<?php echo e($iconOrImage); ?>" alt="<?php echo e($title); ?>" class="w-12 h-12 object-contain">
                <?php else: ?>
                    
                    <span class="text-4xl"><?php echo e($iconOrImage); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <?php if($title): ?>
            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white mb-2"><?php echo e($title); ?></h3>
        <?php endif; ?>

        
        <?php if($description): ?>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed"><?php echo e($description); ?></p>
        <?php endif; ?>

        
        <?php if($slot->isNotEmpty()): ?>
            <div class="mt-4">
                <?php echo e($slot); ?>

            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/process-step.blade.php ENDPATH**/ ?>