<?php $__env->startSection('title', $pageTitle ?? trans_setting('site_name', 'Sofoodtchad') . ' - ' . trans_setting('site_tagline', 'Quality Food Products')); ?>

<?php $__env->startSection('meta_description', $metaDescription ?? trans_setting('site_description')); ?>

<?php $__env->startSection('content'); ?>
    
    <?php
        // Build slides array from hero data
        $heroSlides = $heroSlides ?? [];

        // If no slides provided, create default slides from hero data
        if (empty($heroSlides)) {
            $heroSlides = [
                [
                    'background_image' => $hero['background_image'] ?? null,
                    'title' => $hero['title'] ?? trans_setting('site_name', 'Welcome to Sofoodtchad'),
                    'subtitle' => $hero['subtitle'] ?? trans_setting('site_tagline', 'Premium Quality Food Products'),
                    'cta_text' => $hero['cta_text'] ?? __('home.view_all_products'),
                    'cta_url' => $hero['cta_url'] ?? '/products',
                    'secondary_cta_text' => $hero['secondary_cta_text'] ?? null,
                    'secondary_cta_url' => $hero['secondary_cta_url'] ?? null,
                ],
                [
                    'background_image' => $hero['slide2_image'] ?? $hero['background_image'] ?? null,
                    'title' => __('home.quality_trust'),
                    'subtitle' => __('home.process_subtitle'),
                    'cta_text' => __('general.our_process'),
                    'cta_url' => '/process',
                    'secondary_cta_text' => __('general.contact_us'),
                    'secondary_cta_url' => '/contact',
                ],
                [
                    'background_image' => $hero['slide3_image'] ?? $hero['background_image'] ?? null,
                    'title' => __('home.partner_with_us'),
                    'subtitle' => __('home.partners_subtitle'),
                    'cta_text' => __('home.become_partner'),
                    'cta_url' => '/partners',
                    'secondary_cta_text' => __('general.learn_more'),
                    'secondary_cta_url' => '/about',
                ],
            ];
        }
    ?>

    <?php if (isset($component)) { $__componentOriginale74ef38c4f718abe5610e24f5e2f3fa8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale74ef38c4f718abe5610e24f5e2f3fa8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero-slider','data' => ['slides' => $heroSlides,'autoplay' => true,'interval' => 6000,'height' => 'full','showDots' => true,'showArrows' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['slides' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heroSlides),'autoplay' => true,'interval' => 6000,'height' => 'full','showDots' => true,'showArrows' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale74ef38c4f718abe5610e24f5e2f3fa8)): ?>
<?php $attributes = $__attributesOriginale74ef38c4f718abe5610e24f5e2f3fa8; ?>
<?php unset($__attributesOriginale74ef38c4f718abe5610e24f5e2f3fa8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale74ef38c4f718abe5610e24f5e2f3fa8)): ?>
<?php $component = $__componentOriginale74ef38c4f718abe5610e24f5e2f3fa8; ?>
<?php unset($__componentOriginale74ef38c4f718abe5610e24f5e2f3fa8); ?>
<?php endif; ?>

    
    <?php if($about): ?>
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    <?php if($about['image']): ?>
                        <div class="order-2 lg:order-1">
                            <div class="relative">
                                <img
                                    src="<?php echo e($about['image']); ?>"
                                    alt="About <?php echo e(trans_setting('site_name', 'Sofoodtchad')); ?>"
                                    class="rounded-2xl shadow-xl dark:shadow-gray-900/50 w-full h-auto object-cover"
                                    onerror="this.style.display='none'"
                                >
                                
                                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-100 dark:bg-green-900/30 rounded-2xl -z-10"></div>
                                <div class="absolute -top-6 -left-6 w-24 h-24 bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl -z-10"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                    <div class="<?php echo e($about['image'] ? 'order-1 lg:order-2' : 'col-span-full text-center max-w-3xl mx-auto'); ?>">
                        <?php if($about['subtitle']): ?>
                            <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                                <?php echo e($about['subtitle']); ?>

                            </span>
                        <?php endif; ?>
                        <?php if($about['title']): ?>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mt-2 mb-6">
                                <?php echo e($about['title']); ?>

                            </h2>
                        <?php endif; ?>
                        <?php if($about['description']): ?>
                            <div class="prose prose-lg text-gray-600 dark:text-gray-300 mb-8">
                                <p><?php echo e($about['description']); ?></p>
                            </div>
                        <?php endif; ?>

                        
                        <?php if(!empty($about['features'])): ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 <?php echo e(!$about['image'] ? 'justify-center' : ''); ?>">
                                <?php $__currentLoopData = $about['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium"><?php echo e($feature); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        
                        <?php if($about['cta_text'] && $about['cta_url']): ?>
                            <a href="<?php echo e($about['cta_url']); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <?php echo e($about['cta_text']); ?>

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($products) && count($products) > 0): ?>
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="container mx-auto px-4">
                <?php if (isset($component)) { $__componentOriginala87666a6c7dfd023b4375fc379bf394c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala87666a6c7dfd023b4375fc379bf394c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-grid','data' => ['products' => $products,'title' => $productsSection['title'] ?? __('home.products_title'),'subtitle' => $productsSection['subtitle'] ?? __('home.products_subtitle'),'viewAllUrl' => $productsSection['view_all_url'] ?? '/products','viewAllText' => $productsSection['view_all_text'] ?? __('home.view_all_products'),'columns' => $productsSection['columns'] ?? 4]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($products),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productsSection['title'] ?? __('home.products_title')),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productsSection['subtitle'] ?? __('home.products_subtitle')),'viewAllUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productsSection['view_all_url'] ?? '/products'),'viewAllText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productsSection['view_all_text'] ?? __('home.view_all_products')),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productsSection['columns'] ?? 4)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $attributes = $__attributesOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $component = $__componentOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__componentOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($processSteps) && count($processSteps) > 0): ?>
        <?php
            $processBgImage = setting('homepage_process_bg_image');
        ?>
        <section class="py-16 relative overflow-hidden transition-colors duration-200">
            
            <?php if($processBgImage): ?>
                <div class="absolute inset-0 z-0">
                    <img src="<?php echo e($processBgImage); ?>" alt="" class="w-full h-full object-cover blur-lg scale-105 opacity-30">
                </div>
                <div class="absolute inset-0 z-0 bg-white/95 dark:bg-gray-900/05"></div>
            <?php else: ?>
                <div class="absolute inset-0 bg-white dark:bg-gray-900"></div>
            <?php endif; ?>

            <div class="container mx-auto px-4 relative z-10">
                
                <div class="text-center mb-12">
                    <?php if(isset($processSection['subtitle'])): ?>
                        <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                            <?php echo e($processSection['subtitle']); ?>

                        </span>
                    <?php endif; ?>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        <?php echo e($processSection['title'] ?? __('home.process_title')); ?>

                    </h2>
                    <?php if(isset($processSection['description'])): ?>
                        <p class="text-gray-600 dark:text-gray-300 mt-2 max-w-2xl mx-auto">
                            <?php echo e($processSection['description']); ?>

                        </p>
                    <?php endif; ?>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-<?php echo e(min(count($processSteps), 4)); ?> gap-8">
                    <?php $__currentLoopData = $processSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal4563cdf31d1a816276fbd44772fcd8f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4563cdf31d1a816276fbd44772fcd8f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.process-step','data' => ['stepNumber' => $step->sort_order ?? $index + 1,'title' => $step->title,'description' => $step->description ?? '','icon' => $step->icon ?? null,'iconBgColor' => $step->icon_color ?? 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('process-step'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['step_number' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($step->sort_order ?? $index + 1),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($step->title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($step->description ?? ''),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($step->icon ?? null),'iconBgColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($step->icon_color ?? 'green')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4563cdf31d1a816276fbd44772fcd8f0)): ?>
<?php $attributes = $__attributesOriginal4563cdf31d1a816276fbd44772fcd8f0; ?>
<?php unset($__attributesOriginal4563cdf31d1a816276fbd44772fcd8f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4563cdf31d1a816276fbd44772fcd8f0)): ?>
<?php $component = $__componentOriginal4563cdf31d1a816276fbd44772fcd8f0; ?>
<?php unset($__componentOriginal4563cdf31d1a816276fbd44772fcd8f0); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <?php if(isset($processSection['cta_url'])): ?>
                    <div class="text-center mt-10">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'outline','text' => $processSection['cta_text'] ?? __('home.learn_more_process'),'url' => $processSection['cta_url']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'outline','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($processSection['cta_text'] ?? __('home.learn_more_process')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($processSection['cta_url'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($partners) && count($partners) > 0): ?>
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="container mx-auto px-4">
                
                <div class="text-center mb-12">
                    <?php if(isset($partnersSection['subtitle'])): ?>
                        <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                            <?php echo e($partnersSection['subtitle']); ?>

                        </span>
                    <?php endif; ?>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        <?php echo e($partnersSection['title'] ?? __('home.partners_title')); ?>

                    </h2>
                    <?php if(isset($partnersSection['description'])): ?>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            <?php echo e($partnersSection['description']); ?>

                        </p>
                    <?php endif; ?>
                </div>

                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-<?php echo e(min(count($partners), 6)); ?> gap-6">
                    <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal950c8fbdb9582edca28b5553dcff7ed4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal950c8fbdb9582edca28b5553dcff7ed4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.partner-card','data' => ['name' => $partner->name,'logoImage' => $partner->logo ?? null,'link' => $partner->website ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('partner-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->name),'logo_image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->logo ?? null),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partner->website ?? null)]); ?>
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

                
                <?php if(isset($partnersSection['cta_url'])): ?>
                    <div class="text-center mt-10">
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'outline','text' => $partnersSection['cta_text'] ?? __('home.become_partner'),'url' => $partnersSection['cta_url']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'outline','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partnersSection['cta_text'] ?? __('home.become_partner')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partnersSection['cta_url'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($posts) && count($posts) > 0): ?>
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
            <div class="container mx-auto px-4">
                
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8">
                    <div>
                        <?php if(isset($blogSection['subtitle'])): ?>
                            <span class="text-green-600 dark:text-green-400 font-semibold text-sm uppercase tracking-wider">
                                <?php echo e($blogSection['subtitle']); ?>

                            </span>
                        <?php endif; ?>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            <?php echo e($blogSection['title'] ?? __('home.blog_title')); ?>

                        </h2>
                    </div>
                    <?php if(isset($blogSection['view_all_url'])): ?>
                        <a href="<?php echo e($blogSection['view_all_url']); ?>" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 mt-4 sm:mt-0">
                            <?php echo e($blogSection['view_all_text'] ?? __('home.view_all_posts')); ?>

                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal14b498b52c33a1421ff8895e4557790f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal14b498b52c33a1421ff8895e4557790f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-card','data' => ['title' => $post->title,'summary' => $post->excerpt ?? Str::limit($post->content, 150),'image' => $post->featured_image ?? null,'link' => route('blog.show', $post->slug),'publishedDate' => $post->published_at ?? $post->created_at,'category' => $post->category ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title),'summary' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->excerpt ?? Str::limit($post->content, 150)),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->featured_image ?? null),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('blog.show', $post->slug)),'published_date' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->published_at ?? $post->created_at),'category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->category ?? null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal14b498b52c33a1421ff8895e4557790f)): ?>
<?php $attributes = $__attributesOriginal14b498b52c33a1421ff8895e4557790f; ?>
<?php unset($__attributesOriginal14b498b52c33a1421ff8895e4557790f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal14b498b52c33a1421ff8895e4557790f)): ?>
<?php $component = $__componentOriginal14b498b52c33a1421ff8895e4557790f; ?>
<?php unset($__componentOriginal14b498b52c33a1421ff8895e4557790f); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if(isset($cta) && $cta): ?>
        <section class="py-20 bg-green-600">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    <?php echo e($cta['title'] ?? __('home.cta_title')); ?>

                </h2>
                <?php if(isset($cta['description'])): ?>
                    <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">
                        <?php echo e($cta['description']); ?>

                    </p>
                <?php endif; ?>
                <div class="flex flex-wrap justify-center gap-4">
                    <?php if(isset($cta['primary_text']) && isset($cta['primary_url'])): ?>
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'white','text' => $cta['primary_text'],'url' => $cta['primary_url'],'size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'white','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cta['primary_text']),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cta['primary_url']),'size' => 'lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    <?php endif; ?>
                    <?php if(isset($cta['secondary_text']) && isset($cta['secondary_url'])): ?>
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'outline','text' => $cta['secondary_text'],'url' => $cta['secondary_url'],'size' => 'lg','class' => 'border-white text-white hover:bg-white hover:text-green-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'outline','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cta['secondary_text']),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cta['secondary_url']),'size' => 'lg','class' => 'border-white text-white hover:bg-white hover:text-green-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/home.blade.php ENDPATH**/ ?>