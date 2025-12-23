<?php $__env->startSection('title', $pageTitle ?? trans_setting('site_name', 'Sofoodtchad') . ' - About Us'); ?>

<?php $__env->startSection('meta_description', $metaDescription ?? 'Learn about Sofoodtchad, our mission, vision, and the story behind Chad\'s premier food company.'); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative bg-gradient-to-br from-green-600 to-green-800 py-16 md:py-24 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <?php if(isset($pageSubtitle) && $pageSubtitle): ?>
                    <span class="inline-block text-green-200 font-semibold text-sm uppercase tracking-wider mb-4">
                        <?php echo e($pageSubtitle); ?>

                    </span>
                <?php endif; ?>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                    <?php echo e($pageTitle ?? 'About Us'); ?>

                </h1>
                <?php if(isset($pageDescription) && $pageDescription): ?>
                    <p class="text-lg text-green-100">
                        <?php echo e($pageDescription); ?>

                    </p>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-white dark:fill-gray-900"/>
            </svg>
        </div>
    </section>

    
    <?php if(isset($aboutSections) && count($aboutSections) > 0): ?>
        <?php $__currentLoopData = $aboutSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Handle translatable fields that might be arrays
                $sectionTitle = is_array($section['title'] ?? '') ? ($section['title'][app()->getLocale()] ?? $section['title']['en'] ?? '') : ($section['title'] ?? '');
                $sectionSubtitle = is_array($section['subtitle'] ?? null) ? ($section['subtitle'][app()->getLocale()] ?? $section['subtitle']['en'] ?? null) : ($section['subtitle'] ?? null);
                $sectionDescription = is_array($section['description'] ?? '') ? ($section['description'][app()->getLocale()] ?? $section['description']['en'] ?? '') : ($section['description'] ?? '');
                $sectionImageAlt = is_array($section['image_alt'] ?? null) ? ($section['image_alt'][app()->getLocale()] ?? $section['image_alt']['en'] ?? $sectionTitle) : ($section['image_alt'] ?? $sectionTitle);
                $sectionCtaText = is_array($section['cta_text'] ?? null) ? ($section['cta_text'][app()->getLocale()] ?? $section['cta_text']['en'] ?? null) : ($section['cta_text'] ?? null);
            ?>
            <?php if (isset($component)) { $__componentOriginalf5fd552fdc4c1265f5f1e93789ed55d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf5fd552fdc4c1265f5f1e93789ed55d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.about-snippet','data' => ['title' => $sectionTitle,'subtitle' => $sectionSubtitle,'description' => $sectionDescription,'image' => $section['image'] ?? null,'imageAlt' => $sectionImageAlt,'reverse' => $index % 2 !== 0,'class' => ''.e($index === 0 ? 'pt-16' : '').' '.e($loop->last ? 'pb-16' : '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('about-snippet'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sectionTitle),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sectionSubtitle),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sectionDescription),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section['image'] ?? null),'imageAlt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sectionImageAlt),'reverse' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($index % 2 !== 0),'class' => ''.e($index === 0 ? 'pt-16' : '').' '.e($loop->last ? 'pb-16' : '').'']); ?>
                <?php if(isset($section['features']) && is_array($section['features']) && count($section['features']) > 0): ?>
                    <ul class="mt-6 space-y-3">
                        <?php $__currentLoopData = $section['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $locale = app()->getLocale();
                                // Handle different feature formats: translatable array, object with title, or plain string
                                if (is_array($feature)) {
                                    if (isset($feature['title'])) {
                                        // Object with title key - may be translatable
                                        $featureText = is_array($feature['title'])
                                            ? ($feature['title'][$locale] ?? $feature['title']['en'] ?? $feature['title']['fr'] ?? '')
                                            : $feature['title'];
                                    } elseif (isset($feature['text'])) {
                                        // Object with text key - may be translatable
                                        $featureText = is_array($feature['text'])
                                            ? ($feature['text'][$locale] ?? $feature['text']['en'] ?? $feature['text']['fr'] ?? '')
                                            : $feature['text'];
                                    } elseif (isset($feature[$locale])) {
                                        // Translatable array like {"en": "...", "fr": "..."}
                                        $featureText = $feature[$locale];
                                    } elseif (isset($feature['en'])) {
                                        $featureText = $feature['en'];
                                    } elseif (isset($feature['fr'])) {
                                        $featureText = $feature['fr'];
                                    } else {
                                        // Unknown array structure - convert to string safely
                                        $featureText = reset($feature) ?: '';
                                        if (is_array($featureText)) {
                                            $featureText = json_encode($feature);
                                        }
                                    }
                                } else {
                                    $featureText = (string) $feature;
                                }
                            ?>
                            <li class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300"><?php echo e($featureText); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>

                <?php if($sectionCtaText && isset($section['cta_url'])): ?>
                    <a href="<?php echo e($section['cta_url']); ?>" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-green-600 dark:bg-green-500 text-white font-semibold rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-colors duration-200">
                        <?php echo e($sectionCtaText); ?>

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf5fd552fdc4c1265f5f1e93789ed55d7)): ?>
<?php $attributes = $__attributesOriginalf5fd552fdc4c1265f5f1e93789ed55d7; ?>
<?php unset($__attributesOriginalf5fd552fdc4c1265f5f1e93789ed55d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf5fd552fdc4c1265f5f1e93789ed55d7)): ?>
<?php $component = $__componentOriginalf5fd552fdc4c1265f5f1e93789ed55d7; ?>
<?php unset($__componentOriginalf5fd552fdc4c1265f5f1e93789ed55d7); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    
    <?php if((isset($mission) && $mission) || (isset($vision) && $vision)): ?>
        <?php
            // Extract locale-specific strings for mission/vision
            $locale = app()->getLocale();

            // Mission
            $missionTitle = null;
            $missionDescription = null;
            if (isset($mission) && $mission) {
                if (is_array($mission)) {
                    $missionTitle = isset($mission['title'])
                        ? (is_array($mission['title']) ? ($mission['title'][$locale] ?? $mission['title']['en'] ?? '') : $mission['title'])
                        : __('about.our_mission');
                    $missionDescription = isset($mission['description'])
                        ? (is_array($mission['description']) ? ($mission['description'][$locale] ?? $mission['description']['en'] ?? '') : $mission['description'])
                        : '';
                } else {
                    $missionTitle = __('about.our_mission');
                    $missionDescription = is_string($mission) ? $mission : '';
                }
            }

            // Vision
            $visionTitle = null;
            $visionDescription = null;
            if (isset($vision) && $vision) {
                if (is_array($vision)) {
                    $visionTitle = isset($vision['title'])
                        ? (is_array($vision['title']) ? ($vision['title'][$locale] ?? $vision['title']['en'] ?? '') : $vision['title'])
                        : __('about.our_vision');
                    $visionDescription = isset($vision['description'])
                        ? (is_array($vision['description']) ? ($vision['description'][$locale] ?? $vision['description']['en'] ?? '') : $vision['description'])
                        : '';
                } else {
                    $visionTitle = __('about.our_vision');
                    $visionDescription = is_string($vision) ? $vision : '';
                }
            }
        ?>
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider mb-2">
                        <?php echo e($missionVisionSubtitle ?? __('about.what_drives_us')); ?>

                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($missionVisionTitle ?? __('about.mission_vision_title')); ?>

                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    
                    <?php if($missionTitle || $missionDescription): ?>
                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg dark:shadow-gray-900/30 p-8 border-t-4 border-green-600">
                            <div class="w-16 h-16 bg-green-100 dark:bg-green-900/50 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4"><?php echo e($missionTitle); ?></h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                <?php echo e($missionDescription); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    
                    <?php if($visionTitle || $visionDescription): ?>
                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg dark:shadow-gray-900/30 p-8 border-t-4 border-yellow-500">
                            <div class="w-16 h-16 bg-yellow-100 dark:bg-yellow-900/50 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4"><?php echo e($visionTitle); ?></h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                <?php echo e($visionDescription); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                
                <?php if(isset($values) && is_array($values) && count($values) > 0): ?>
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8"><?php echo e($valuesTitle ?? 'Our Core Values'); ?></h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-center">
                                    <div class="w-14 h-14 mx-auto bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mb-3">
                                        <?php if(isset($value['icon'])): ?>
                                            <?php echo $value['icon']; ?>

                                        <?php else: ?>
                                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white"><?php echo e(is_array($value) ? ($value['title'] ?? $value['name'] ?? '') : $value); ?></h4>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($team) && is_array($team) && count($team) > 0): ?>
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider mb-2">
                        <?php echo e($teamSubtitle ?? 'The People Behind'); ?>

                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($teamTitle ?? 'Meet Our Team'); ?>

                    </h2>
                    <?php if(isset($teamDescription)): ?>
                        <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-2xl mx-auto"><?php echo e($teamDescription); ?></p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center group">
                            <div class="relative mb-4 overflow-hidden rounded-2xl">
                                <img
                                    src="<?php echo e($member['image'] ?? '/images/placeholder-person.jpg'); ?>"
                                    alt="<?php echo e($member['name'] ?? ''); ?>"
                                    class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105"
                                    onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($member['name'] ?? 'Team')); ?>&size=256&background=16a34a&color=fff'"
                                >
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white"><?php echo e($member['name'] ?? ''); ?></h3>
                            <?php if(isset($member['position']) || isset($member['role'])): ?>
                                <p class="text-green-600 dark:text-green-400 font-medium"><?php echo e($member['position'] ?? $member['role'] ?? ''); ?></p>
                            <?php endif; ?>
                            <?php if(isset($member['bio'])): ?>
                                <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm"><?php echo e(Str::limit($member['bio'], 100)); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($history) && is_array($history) && count($history) > 0): ?>
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider mb-2">
                        <?php echo e($historySubtitle ?? 'Our Journey'); ?>

                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($historyTitle ?? 'Our History'); ?>

                    </h2>
                </div>

                <div class="max-w-3xl mx-auto">
                    <div class="relative">
                        
                        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-green-200 dark:bg-green-800 transform md:-translate-x-1/2"></div>

                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative flex items-start mb-8 last:mb-0 <?php echo e($index % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse'); ?>">
                                
                                <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-green-600 dark:bg-green-500 rounded-full transform -translate-x-1/2 mt-1.5 z-10 ring-4 ring-white dark:ring-gray-800"></div>

                                
                                <div class="ml-12 md:ml-0 md:w-5/12 <?php echo e($index % 2 === 0 ? 'md:pr-12 md:text-right' : 'md:pl-12'); ?>">
                                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md dark:shadow-gray-900/30 p-6">
                                        <?php if(isset($milestone['year'])): ?>
                                            <span class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-400 text-sm font-bold rounded-full mb-2">
                                                <?php echo e($milestone['year']); ?>

                                            </span>
                                        <?php endif; ?>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2"><?php echo e($milestone['title'] ?? ''); ?></h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm"><?php echo e($milestone['description'] ?? ''); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if (! empty(trim($__env->yieldContent('extra_content')))): ?>
        <?php echo $__env->yieldContent('extra_content'); ?>
    <?php endif; ?>

    
    <?php if(isset($cta) && $cta): ?>
        <?php
            $locale = app()->getLocale();
            $ctaTitle = isset($cta['title'])
                ? (is_array($cta['title']) ? ($cta['title'][$locale] ?? $cta['title']['en'] ?? '') : $cta['title'])
                : __('about.want_to_learn_more');
            $ctaDescription = isset($cta['description'])
                ? (is_array($cta['description']) ? ($cta['description'][$locale] ?? $cta['description']['en'] ?? '') : $cta['description'])
                : null;
            $ctaPrimaryText = isset($cta['primary_text'])
                ? (is_array($cta['primary_text']) ? ($cta['primary_text'][$locale] ?? $cta['primary_text']['en'] ?? '') : $cta['primary_text'])
                : null;
            $ctaSecondaryText = isset($cta['secondary_text'])
                ? (is_array($cta['secondary_text']) ? ($cta['secondary_text'][$locale] ?? $cta['secondary_text']['en'] ?? '') : $cta['secondary_text'])
                : null;
        ?>
        <section class="py-20 bg-green-600">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    <?php echo e($ctaTitle); ?>

                </h2>
                <?php if($ctaDescription): ?>
                    <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">
                        <?php echo e($ctaDescription); ?>

                    </p>
                <?php endif; ?>
                <div class="flex flex-wrap justify-center gap-4">
                    <?php if($ctaPrimaryText && isset($cta['primary_url'])): ?>
                        <a href="<?php echo e($cta['primary_url']); ?>" class="px-8 py-3 bg-white text-green-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <?php echo e($ctaPrimaryText); ?>

                        </a>
                    <?php endif; ?>
                    <?php if($ctaSecondaryText && isset($cta['secondary_url'])): ?>
                        <a href="<?php echo e($cta['secondary_url']); ?>" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-green-600 transition-colors duration-200">
                            <?php echo e($ctaSecondaryText); ?>

                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/pages/about.blade.php ENDPATH**/ ?>