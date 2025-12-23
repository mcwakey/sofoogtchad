<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'activeTab' => 'fr',
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
    'activeTab' => 'fr',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $locales = [
        'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'required' => true],
        'en' => ['name' => 'English', 'flag' => '🇬🇧', 'required' => false],
        'ar' => ['name' => 'العربية', 'flag' => '🇹🇩', 'required' => false],
    ];
?>

<div x-data="{ activeTab: '<?php echo e($activeTab); ?>' }" <?php echo e($attributes); ?>>
    
    <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
        <nav class="flex gap-2" aria-label="Language tabs">
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button
                    type="button"
                    @click="activeTab = '<?php echo e($code); ?>'"
                    :class="{
                        'border-green-500 text-green-600 dark:text-green-400': activeTab === '<?php echo e($code); ?>',
                        'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': activeTab !== '<?php echo e($code); ?>'
                    }"
                    class="flex items-center gap-2 px-4 py-2.5 border-b-2 font-medium text-sm transition-colors -mb-px"
                >
                    <span class="text-lg"><?php echo e($locale['flag']); ?></span>
                    <span><?php echo e($locale['name']); ?></span>
                    <?php if($locale['required']): ?>
                        <span class="text-red-500 text-xs">*</span>
                    <?php endif; ?>
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>

    
    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/admin/language-tabs.blade.php ENDPATH**/ ?>