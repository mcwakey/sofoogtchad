<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>" x-data x-bind:class="{ 'dark': localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light dark">

    
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    
    <title><?php echo $__env->yieldContent('title', trans_setting('site_name', 'Sofoodtchad')); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', trans_setting('site_description', '')); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', setting('seo_meta_keywords', '')); ?>">
    <meta name="author" content="<?php echo e(trans_setting('site_name', 'Sofoodtchad')); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', trans_setting('site_name', 'Sofoodtchad')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', trans_setting('site_description', '')); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', setting('site_logo', '')); ?>">
    <meta property="og:locale" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <meta property="og:site_name" content="<?php echo e(trans_setting('site_name', 'Sofoodtchad')); ?>">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', trans_setting('site_name', 'Sofoodtchad')); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', trans_setting('site_description', '')); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image', setting('site_logo', '')); ?>">
    
    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">

    
    <?php if(setting('site_favicon')): ?>
        <link rel="icon" type="image/x-icon" href="<?php echo e(setting('site_favicon')); ?>">
        <link rel="shortcut icon" href="<?php echo e(setting('site_favicon')); ?>">
    <?php endif; ?>

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php if(app()->getLocale() === 'ar'): ?>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            html[dir="rtl"] { font-family: 'Noto Sans Arabic', 'Inter', sans-serif; }
            html[dir="rtl"] .space-x-1 > :not([hidden]) ~ :not([hidden]) { --tw-space-x-reverse: 1; }
            html[dir="rtl"] .space-x-2 > :not([hidden]) ~ :not([hidden]) { --tw-space-x-reverse: 1; }
            html[dir="rtl"] .space-x-4 > :not([hidden]) ~ :not([hidden]) { --tw-space-x-reverse: 1; }
        </style>
    <?php endif; ?>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo $__env->yieldPushContent('styles'); ?>

    
    <?php if(setting('seo_google_analytics')): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(setting('seo_google_analytics')); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo e(setting('seo_google_analytics')); ?>');
        </script>
    <?php endif; ?>

    
    <?php if(setting('seo_google_tag_manager')): ?>
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?php echo e(setting('seo_google_tag_manager')); ?>');
        </script>
    <?php endif; ?>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-200 <?php echo $__env->yieldContent('body_class', ''); ?>">
    
    <?php if(setting('seo_google_tag_manager')): ?>
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo e(setting('seo_google_tag_manager')); ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    <?php endif; ?>

    
    <a href="#main-content" class="skip-link sr-only focus:not-sr-only">
        <?php echo e(__('general.skip_to_content')); ?>

    </a>

    
    <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

    
    <main id="main-content" role="main">
        
        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-error" role="alert">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

    
    <?php if(setting('contact_whatsapp')): ?>
        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', setting('contact_whatsapp'))); ?>"
           target="_blank"
           rel="noopener noreferrer"
           class="fixed bottom-6 <?php echo e(app()->getLocale() === 'ar' ? 'left-6' : 'right-6'); ?> z-50 flex items-center justify-center w-14 h-14 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300"
           aria-label="<?php echo e(__('general.contact_whatsapp')); ?>">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    <?php endif; ?>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>

    
    <?php if (! empty(trim($__env->yieldContent('structured_data')))): ?>
        <?php echo $__env->yieldContent('structured_data'); ?>
    <?php else: ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "<?php echo e(trans_setting('site_name', 'Sofoodtchad')); ?>",
            "url": "<?php echo e(url('/')); ?>",
            <?php if(setting('site_logo')): ?>
            "logo": "<?php echo e(setting('site_logo')); ?>",
            <?php endif; ?>
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "<?php echo e(setting('contact_phone', '')); ?>",
                "contactType": "customer service"
            },
            "sameAs": [
                <?php if(setting('social_facebook')): ?>"<?php echo e(setting('social_facebook')); ?>"<?php endif; ?>
                <?php if(setting('social_facebook') && setting('social_instagram')): ?>,<?php endif; ?>
                <?php if(setting('social_instagram')): ?>"<?php echo e(setting('social_instagram')); ?>"<?php endif; ?>
                <?php if((setting('social_facebook') || setting('social_instagram')) && setting('social_twitter')): ?>,<?php endif; ?>
                <?php if(setting('social_twitter')): ?>"<?php echo e(setting('social_twitter')); ?>"<?php endif; ?>
                <?php if((setting('social_facebook') || setting('social_instagram') || setting('social_twitter')) && setting('social_linkedin')): ?>,<?php endif; ?>
                <?php if(setting('social_linkedin')): ?>"<?php echo e(setting('social_linkedin')); ?>"<?php endif; ?>
            ]
        }
        </script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\dev\projects\web\sofood\resources\views/layouts/app.blade.php ENDPATH**/ ?>