<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'text',
    'name',
    'label' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'id' => null,
    'help' => null,
    'rows' => 4,
    'options' => [],
    'emptyOption' => 'Select an option',
    'autocomplete' => null,
    'min' => null,
    'max' => null,
    'step' => null,
    'pattern' => null,
    'accept' => null,
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
    'type' => 'text',
    'name',
    'label' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'id' => null,
    'help' => null,
    'rows' => 4,
    'options' => [],
    'emptyOption' => 'Select an option',
    'autocomplete' => null,
    'min' => null,
    'max' => null,
    'step' => null,
    'pattern' => null,
    'accept' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $fieldId = $id ?? $name;
    $hasError = $errors->has($name);
    $fieldValue = old($name, $value);

    $inputClasses = 'block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm transition-all duration-200 focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 focus:outline-none text-base';

    if ($hasError) {
        $inputClasses = 'block w-full px-4 py-3 rounded-xl border-2 border-red-400 dark:border-red-500 bg-white dark:bg-gray-700 shadow-sm transition-all duration-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/20 focus:outline-none text-base text-red-900 dark:text-red-400 placeholder-red-300 dark:placeholder-red-400';
    }

    if ($disabled) {
        $inputClasses .= ' bg-gray-50 dark:bg-gray-600 cursor-not-allowed opacity-60';
    }
?>

<div <?php echo e($attributes->merge(['class' => 'form-field'])); ?>>
    
    <?php if($label): ?>
        <label for="<?php echo e($fieldId); ?>" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-500">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    
    <?php switch($type):
        case ('textarea'): ?>
            <textarea
                name="<?php echo e($name); ?>"
                id="<?php echo e($fieldId); ?>"
                rows="<?php echo e($rows); ?>"
                placeholder="<?php echo e($placeholder); ?>"
                class="<?php echo e($inputClasses); ?>"
                <?php if($required): ?> required <?php endif; ?>
                <?php if($disabled): ?> disabled <?php endif; ?>
                <?php if($readonly): ?> readonly <?php endif; ?>
            ><?php echo e($fieldValue); ?></textarea>
            <?php break; ?>

        <?php case ('select'): ?>
            <select
                name="<?php echo e($name); ?>"
                id="<?php echo e($fieldId); ?>"
                class="<?php echo e($inputClasses); ?>"
                <?php if($required): ?> required <?php endif; ?>
                <?php if($disabled): ?> disabled <?php endif; ?>
            >
                <?php if($emptyOption): ?>
                    <option value=""><?php echo e($emptyOption); ?></option>
                <?php endif; ?>
                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                        value="<?php echo e($optionValue); ?>"
                        <?php echo e($fieldValue == $optionValue ? 'selected' : ''); ?>

                    >
                        <?php echo e($optionLabel); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php break; ?>

        <?php case ('checkbox'): ?>
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="<?php echo e($name); ?>"
                    id="<?php echo e($fieldId); ?>"
                    value="1"
                    class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-green-600 focus:ring-green-500"
                    <?php echo e($fieldValue ? 'checked' : ''); ?>

                    <?php if($required): ?> required <?php endif; ?>
                    <?php if($disabled): ?> disabled <?php endif; ?>
                >
                <?php if($label): ?>
                    <label for="<?php echo e($fieldId); ?>" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                        <?php echo e($label); ?>

                        <?php if($required): ?>
                            <span class="text-red-500">*</span>
                        <?php endif; ?>
                    </label>
                <?php endif; ?>
            </div>
            <?php break; ?>

        <?php case ('radio'): ?>
            <div class="space-y-2">
                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center">
                        <input
                            type="radio"
                            name="<?php echo e($name); ?>"
                            id="<?php echo e($fieldId); ?>_<?php echo e($optionValue); ?>"
                            value="<?php echo e($optionValue); ?>"
                            class="h-4 w-4 border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-green-600 focus:ring-green-500"
                            <?php echo e($fieldValue == $optionValue ? 'checked' : ''); ?>

                            <?php if($required): ?> required <?php endif; ?>
                            <?php if($disabled): ?> disabled <?php endif; ?>
                        >
                        <label for="<?php echo e($fieldId); ?>_<?php echo e($optionValue); ?>" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                            <?php echo e($optionLabel); ?>

                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php break; ?>

        <?php case ('file'): ?>
            <input
                type="file"
                name="<?php echo e($name); ?>"
                id="<?php echo e($fieldId); ?>"
                class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 dark:file:bg-green-900/50 file:text-green-700 dark:file:text-green-300 hover:file:bg-green-100 dark:hover:file:bg-green-900/70 focus:outline-none"
                <?php if($accept): ?> accept="<?php echo e($accept); ?>" <?php endif; ?>
                <?php if($required): ?> required <?php endif; ?>
                <?php if($disabled): ?> disabled <?php endif; ?>
            >
            <?php break; ?>

        <?php default: ?>
            <input
                type="<?php echo e($type); ?>"
                name="<?php echo e($name); ?>"
                id="<?php echo e($fieldId); ?>"
                value="<?php echo e($fieldValue); ?>"
                placeholder="<?php echo e($placeholder); ?>"
                class="<?php echo e($inputClasses); ?>"
                <?php if($required): ?> required <?php endif; ?>
                <?php if($disabled): ?> disabled <?php endif; ?>
                <?php if($readonly): ?> readonly <?php endif; ?>
                <?php if($autocomplete): ?> autocomplete="<?php echo e($autocomplete); ?>" <?php endif; ?>
                <?php if($min !== null): ?> min="<?php echo e($min); ?>" <?php endif; ?>
                <?php if($max !== null): ?> max="<?php echo e($max); ?>" <?php endif; ?>
                <?php if($step !== null): ?> step="<?php echo e($step); ?>" <?php endif; ?>
                <?php if($pattern): ?> pattern="<?php echo e($pattern); ?>" <?php endif; ?>
            >
    <?php endswitch; ?>

    
    <?php if($help && !$hasError): ?>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400"><?php echo e($help); ?></p>
    <?php endif; ?>

    
    <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/form-field.blade.php ENDPATH**/ ?>