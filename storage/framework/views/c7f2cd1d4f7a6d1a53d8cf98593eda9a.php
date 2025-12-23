<?php $__env->startSection('title', trans_setting('partners_page_title', 'Our Partners') . ' - ' . trans_setting('site_name', 'Sofoodtchad')); ?>
<?php $__env->startSection('description', trans_setting('partners_page_description', 'Discover our network of trusted partners and distributors across Africa.')); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <?php echo e(trans_setting('partners_page_title', __('partners.title'))); ?>

                </h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    <?php echo e(trans_setting('partners_page_subtitle', __('partners.subtitle'))); ?>

                </p>
            </div>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-gray-50 dark:fill-gray-800"/>
            </svg>
        </div>
    </section>

    
    <?php if($featuredPartners->count()): ?>
        <section class="py-12 md:py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">
                        <?php echo e(trans_setting('partners_featured_title', __('partners.featured_partners'))); ?>

                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-xl mx-auto">
                        <?php echo e(trans_setting('partners_featured_subtitle', __('partners.featured_partners_subtitle'))); ?>

                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <?php $__currentLoopData = $featuredPartners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md dark:shadow-gray-900/30 hover:shadow-xl transition-all duration-300 overflow-hidden group">
                            
                            <div class="p-8 flex items-center justify-center bg-gradient-to-br from-gray-50 dark:from-gray-600 to-white dark:to-gray-700 border-b border-gray-100 dark:border-gray-600">
                                <?php if($partner->logo): ?>
                                    <img
                                        src="<?php echo e($partner->logo_url); ?>"
                                        alt="<?php echo e($partner->name); ?>"
                                        class="max-h-20 max-w-full object-contain grayscale group-hover:grayscale-0 transition-all duration-300"
                                    >
                                <?php else: ?>
                                    <div class="w-20 h-20 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                                        <span class="text-2xl font-bold text-green-600 dark:text-green-400"><?php echo e(substr($partner->name, 0, 2)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2"><?php echo e($partner->name); ?></h3>
                                <?php if($partner->description): ?>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2"><?php echo e($partner->description); ?></p>
                                <?php endif; ?>
                                <?php if($partner->website): ?>
                                    <a href="<?php echo e($partner->website); ?>"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center text-green-600 dark:text-green-400 font-medium text-sm hover:text-green-700 dark:hover:text-green-300 transition-colors">
                                        <?php echo e(__('partners.visit_website')); ?>

                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <section class="py-12 md:py-16 lg:py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">
                    <?php echo e(trans_setting('partners_all_title', __('partners.all_partners'))); ?>

                </h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-xl mx-auto">
                    <?php echo e(trans_setting('partners_all_subtitle', __('partners.all_partners_subtitle'))); ?>

                </p>
            </div>

            <?php if($partners->isEmpty()): ?>
                
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2"><?php echo e(__('partners.partner_info_coming')); ?></h3>
                    <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                        <?php echo e(__('partners.updating_directory')); ?>

                    </p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                    <?php $__currentLoopData = $partners->where('is_featured', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal950c8fbdb9582edca28b5553dcff7ed4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal950c8fbdb9582edca28b5553dcff7ed4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.partner-card','data' => ['name' => $partner->name,'logoImage' => $partner->logo_url,'link' => $partner->website,'description' => $partner->description,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('partner-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->name),'logo-image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->logo_url),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->website),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->description),'size' => 'md']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal950c8fbdb9582edca28b5553dcff7ed4)): ?>
<?php $attributes = $__attributesOriginal950c8fbdb9582edca28b5553dcff7ed4; ?>
<?php unset($__attributesOriginal950c8fbdb9582edca28b5553dcff7ed4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal950c8fbdb9582edca28b5553dcff7ed4)): ?>
<?php $component = $__componentOriginal950c8fbdb9582edca28b5553dcff7ed4; ?>
<?php unset($__componentOriginal950c8fbdb9582edca28b5553dcff7ed4); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="py-12 md:py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">
                    <?php echo e(trans_setting('partners_why_title', __('partners.why_partner'))); ?>

                </h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-xl mx-auto">
                    <?php echo e(trans_setting('partners_why_subtitle', __('partners.join_network'))); ?>

                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 text-center shadow-sm dark:shadow-gray-900/30 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2"><?php echo e(__('partners.quality_products')); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm"><?php echo e(__('partners.quality_products_desc')); ?></p>
                </div>

                
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 text-center shadow-sm dark:shadow-gray-900/30 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2"><?php echo e(__('partners.growth_support')); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm"><?php echo e(__('partners.growth_support_desc')); ?></p>
                </div>

                
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 text-center shadow-sm dark:shadow-gray-900/30 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2"><?php echo e(__('partners.wide_coverage')); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm"><?php echo e(__('partners.wide_coverage_desc')); ?></p>
                </div>

                
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 text-center shadow-sm dark:shadow-gray-900/30 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2"><?php echo e(__('partners.dedicated_support')); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm"><?php echo e(__('partners.dedicated_support_desc')); ?></p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-16 md:py-20 bg-gradient-to-br from-green-700 via-green-600 to-green-500 relative overflow-hidden">
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white rounded-full"></div>
            <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white rounded-full"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="md:flex">
                    
                    <div class="md:w-1/2 p-8 md:p-10 bg-gradient-to-br from-green-800 to-green-700 text-white">
                        <h2 class="text-2xl md:text-3xl font-bold mb-4">
                            <?php echo e(trans_setting('distributor_cta_title', __('partners.become_distributor'))); ?>

                        </h2>
                        <p class="text-green-100 mb-6">
                            <?php echo e(trans_setting('distributor_cta_description', __('partners.distributor_description'))); ?>

                        </p>

                        <ul class="space-y-3">
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo e(__('partners.exclusive_territory')); ?>

                            </li>
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo e(__('partners.competitive_margins')); ?>

                            </li>
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo e(__('partners.marketing_support')); ?>

                            </li>
                            <li class="flex items-center text-green-100">
                                <svg class="w-5 h-5 mr-3 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo e(__('partners.training_support')); ?>

                            </li>
                        </ul>
                    </div>

                    
                    <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-center bg-white dark:bg-gray-800">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3"><?php echo e(__('partners.ready_to_start')); ?></h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            <?php echo e(__('partners.form_description')); ?>

                        </p>
                        <a href="<?php echo e(route('partners.become-distributor')); ?>"
                           class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition-colors duration-200 shadow-lg hover:shadow-xl">
                            <?php echo e(__('partners.apply_now')); ?>

                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>

                        <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                            <?php echo e(__('partners.have_questions')); ?>

                            <a href="<?php echo e(route('contact.index') ?? '#'); ?>" class="text-green-600 dark:text-green-400 hover:underline"><?php echo e(__('general.contact_us')); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/partners/index.blade.php ENDPATH**/ ?>