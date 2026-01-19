<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'slides' => [],
    'autoplay' => true,
    'interval' => 5000,
    'height' => 'lg',
    'overlay' => false,
    'overlayOpacity' => '50',
    'showDots' => true,
    'showArrows' => true,
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
    'slides' => [],
    'autoplay' => true,
    'interval' => 5000,
    'height' => 'lg',
    'overlay' => false,
    'overlayOpacity' => '50',
    'showDots' => true,
    'showArrows' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $heightClasses = match($height) {
        'sm' => 'min-h-[400px] py-20',
        'md' => 'min-h-[600px] py-24',
        'lg' => 'min-h-[85vh] py-32',
        'full' => 'min-h-screen py-24',
        default => 'min-h-[85vh] py-32', // xl
    };

    $overlayClass = match($overlayOpacity) {
        '30' => 'bg-black/30',
        '40' => 'bg-black/40',
        '60' => 'bg-black/60',
        '70' => 'bg-black/70',
        default => 'bg-black/50',
    };

    // Ensure we have at least one slide
    if (empty($slides)) {
        $slides = [[
            'background_image' => null,
            'title' => trans_setting('site_name', 'Welcome to Sofoodtchad'),
            'subtitle' => trans_setting('site_tagline', 'Premium Quality Food Products'),
            'cta_text' => __('home.view_all_products'),
            'cta_url' => '/products',
        ]];
    }
?>

<section
    x-data="{
        currentSlide: 0,
        slides: <?php echo e(count($slides)); ?>,
        autoplay: <?php echo e($autoplay ? 'true' : 'false'); ?>,
        interval: <?php echo e($interval); ?>,
        timer: null,
        init() {
            if (this.autoplay && this.slides > 1) {
                this.startAutoplay();
            }
        },
        startAutoplay() {
            this.timer = setInterval(() => {
                this.next();
            }, this.interval);
        },
        stopAutoplay() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides) % this.slides;
        },
        goTo(index) {
            this.currentSlide = index;
            if (this.autoplay) {
                this.stopAutoplay();
                this.startAutoplay();
            }
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="if (autoplay && slides > 1) startAutoplay()"
    <?php echo e($attributes->merge(['class' => "relative {$heightClasses} flex items-center overflow-hidden"])); ?>

>
    
    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
            x-show="currentSlide === <?php echo e($index); ?>"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 transform scale-105"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="absolute inset-0"
        >
            
            <?php if(!empty($slide['background_image'])): ?>
                <?php
                    $bgImage = $slide['background_image'];
                    $bgImageUrl = Str::startsWith($bgImage, ['http://', 'https://']) ? $bgImage : asset($bgImage);
                ?>
                <div class="absolute inset-0 z-0">
                    <img
                        src="<?php echo e($bgImageUrl); ?>"
                        alt="<?php echo e($slide['title'] ?? 'Slide ' . ($index + 1)); ?>"
                        class="w-full h-full object-cover"
                        loading="<?php echo e($index === 0 ? 'eager' : 'lazy'); ?>"
                    >
                    <?php if($overlay): ?>
                        <div class="absolute inset-0 <?php echo e($overlayClass); ?>"></div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                
                <div class="absolute inset-0 z-0 bg-gradient-to-br from-green-700 via-green-600 to-green-800"></div>
            <?php endif; ?>

            
            <!-- <div class="relative z-10 h-full flex items-center">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center text-center max-w-4xl mx-auto">
                        
                        <?php if(!empty($slide['title'])): ?>
                            <h1
                                x-show="currentSlide === <?php echo e($index); ?>"
                                x-transition:enter="transition ease-out duration-700 delay-200"
                                x-transition:enter-start="opacity-0 transform translate-y-8"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight"
                            >
                                <?php echo e($slide['title']); ?>

                            </h1>
                        <?php endif; ?>

                        
                        <?php if(!empty($slide['subtitle'])): ?>
                            <p
                                x-show="currentSlide === <?php echo e($index); ?>"
                                x-transition:enter="transition ease-out duration-700 delay-300"
                                x-transition:enter-start="opacity-0 transform translate-y-8"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="text-lg sm:text-xl md:text-2xl text-white/90 mb-8 max-w-2xl mx-auto"
                            >
                                <?php echo e($slide['subtitle']); ?>

                            </p>
                        <?php endif; ?>

                        
                        <?php if(!empty($slide['cta_text']) || !empty($slide['secondary_cta_text'])): ?>
                            <div
                                x-show="currentSlide === <?php echo e($index); ?>"
                                x-transition:enter="transition ease-out duration-700 delay-400"
                                x-transition:enter-start="opacity-0 transform translate-y-8"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="flex flex-wrap gap-4 justify-center"
                            >
                                <?php if(!empty($slide['cta_text']) && !empty($slide['cta_url'])): ?>
                                    <a
                                        href="<?php echo e($slide['cta_url']); ?>"
                                        class="inline-flex items-center px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl"
                                    >
                                        <?php echo e($slide['cta_text']); ?>

                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                <?php endif; ?>

                                <?php if(!empty($slide['secondary_cta_text']) && !empty($slide['secondary_cta_url'])): ?>
                                    <a
                                        href="<?php echo e($slide['secondary_cta_url']); ?>"
                                        class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-200"
                                    >
                                        <?php echo e($slide['secondary_cta_text']); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> -->
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php if($showArrows && count($slides) > 1): ?>
        
        <button
            @click="prev()"
            class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/50 group"
            aria-label="Previous slide"
        >
            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        
        <button
            @click="next()"
            class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/50 group"
            aria-label="Next slide"
        >
            <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    <?php endif; ?>

    
    <?php if($showDots && count($slides) > 1): ?>
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
            <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button
                    @click="goTo(<?php echo e($index); ?>)"
                    :class="currentSlide === <?php echo e($index); ?> ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75'"
                    class="w-3 h-3 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent"
                    aria-label="Go to slide <?php echo e($index + 1); ?>"
                ></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    
    <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none">
        <svg class="w-full h-12 sm:h-16 text-white dark:text-gray-900" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,48 L1440,48 L1440,0 C1200,32 960,48 720,48 C480,48 240,32 0,0 L0,48 Z"></path>
        </svg>
    </div>
</section>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/components/hero-slider.blade.php ENDPATH**/ ?>