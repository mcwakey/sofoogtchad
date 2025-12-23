<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class' => '']));

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

foreach (array_filter((['class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $currentLocale = app()->getLocale();
    $locales = [
        'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'short' => 'FR'],
        'en' => ['name' => 'English', 'flag' => '🇬🇧', 'short' => 'EN'],
        'ar' => ['name' => 'العربية', 'flag' => '🇹🇩', 'short' => 'AR'],
    ];
?>

<div x-data="{ open: false }" class="relative <?php echo e($class); ?>" @click.away="open = false">
    <button
        @click="open = !open"
        type="button"
        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
        aria-expanded="false"
        aria-haspopup="true"
    >
        <span class="text-lg"><?php echo e($locales[$currentLocale]['flag']); ?></span>
        <span class="hidden sm:inline"><?php echo e($locales[$currentLocale]['short']); ?></span>
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 rtl:right-auto rtl:left-0 mt-2 w-48 origin-top-right rounded-xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-white/10 focus:outline-none z-50"
        role="menu"
        aria-orientation="vertical"
        x-cloak
    >
        <div class="py-1">
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a
                    href="<?php echo e(request()->fullUrlWithQuery(['lang' => $code])); ?>"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm <?php echo e($currentLocale === $code ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?> transition-colors"
                    role="menuitem"
                >
                    <span class="text-lg"><?php echo e($locale['flag']); ?></span>
                    <span class="flex-1"><?php echo e($locale['name']); ?></span>
                    <?php if($currentLocale === $code): ?>
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/language-switcher.blade.php ENDPATH**/ ?>