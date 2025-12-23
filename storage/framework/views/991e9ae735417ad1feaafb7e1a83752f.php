<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label',
    'model' => null,
    'required' => false,
    'type' => 'text',
    'placeholder' => '',
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
    'name',
    'label',
    'model' => null,
    'required' => false,
    'type' => 'text',
    'placeholder' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $locales = ['fr', 'en', 'ar'];
    $isRtl = fn($locale) => $locale === 'ar';
?>

<div <?php echo e($attributes->merge(['class' => 'space-y-3'])); ?>>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        <?php echo e($label); ?>

        <?php if($required): ?>
            <span class="text-red-500">*</span>
        <?php endif; ?>
    </label>

    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
            x-show="activeTab === '<?php echo e($locale); ?>'"
            x-cloak
            class="relative"
        >
            <div class="absolute inset-y-0 <?php echo e($isRtl($locale) ? 'right-0 pr-3' : 'left-0 pl-3'); ?> flex items-center pointer-events-none">
                <span class="text-gray-400 dark:text-gray-500 text-xs uppercase font-medium"><?php echo e(strtoupper($locale)); ?></span>
            </div>
            <input
                type="<?php echo e($type); ?>"
                name="<?php echo e($name); ?>[<?php echo e($locale); ?>]"
                id="<?php echo e($name); ?>_<?php echo e($locale); ?>"
                value="<?php echo e(old("{$name}.{$locale}", $model?->getTranslation($name, $locale, false) ?? '')); ?>"
                placeholder="<?php echo e($placeholder); ?>"
                <?php if($required && $locale === 'fr'): ?> required <?php endif; ?>
                class="<?php echo e($isRtl($locale) ? 'pr-12 text-right' : 'pl-12'); ?> block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                dir="<?php echo e($isRtl($locale) ? 'rtl' : 'ltr'); ?>"
            >
            <?php $__errorArgs = ["{$name}.{$locale}"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/admin/translatable-input.blade.php ENDPATH**/ ?>