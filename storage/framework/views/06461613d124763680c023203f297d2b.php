<?php $__env->startSection('title', trans_setting('blog_page_title', 'Blog & News') . ' - ' . trans_setting('site_name', 'Sofoodtchad')); ?>
<?php $__env->startSection('description', trans_setting('blog_page_description', 'Stay updated with our latest stories, recipes, and announcements from Sofoodtchad.')); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <?php echo e(trans_setting('blog_page_title', __('blog.page_title'))); ?>

                </h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    <?php echo e(trans_setting('blog_page_subtitle', __('blog.page_subtitle'))); ?>

                </p>
            </div>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-white dark:fill-gray-900"/>
            </svg>
        </div>
    </section>

    
    <section class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm font-medium text-gray-600 dark:text-gray-400 mr-2"><?php echo e(__('products.filters')); ?>:</span>
                <a href="<?php echo e(route('blog.index')); ?>"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 <?php echo e(!request('type') ? 'bg-green-600 text-white shadow-md' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-gray-600 hover:text-green-700 dark:hover:text-green-400 border border-gray-200 dark:border-gray-600'); ?>">
                    <?php echo e(__('blog.all_posts')); ?>

                </a>
                <a href="<?php echo e(route('blog.index', ['type' => 'blog'])); ?>"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 <?php echo e(request('type') === 'blog' ? 'bg-green-600 text-white shadow-md' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-gray-600 hover:text-green-700 dark:hover:text-green-400 border border-gray-200 dark:border-gray-600'); ?>">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <?php echo e(__('blog.title')); ?>

                </a>
                <a href="<?php echo e(route('blog.index', ['type' => 'news'])); ?>"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 <?php echo e(request('type') === 'news' ? 'bg-green-600 text-white shadow-md' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-gray-600 hover:text-green-700 dark:hover:text-green-400 border border-gray-200 dark:border-gray-600'); ?>">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <?php echo e(__('blog.news')); ?>

                </a>
            </div>
        </div>
    </section>

    
    <section class="py-12 md:py-16 lg:py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if($posts->isEmpty()): ?>
                
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2"><?php echo e(__('blog.no_posts')); ?></h3>
                    <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                        <?php echo e(__('blog.subtitle')); ?>

                    </p>
                </div>
            <?php else: ?>
                
                <?php if(!request('type') && $posts->first()): ?>
                    <?php $featuredPost = $posts->first(); ?>
                    <div class="mb-12">
                        <?php if (isset($component)) { $__componentOriginal14b498b52c33a1421ff8895e4557790f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal14b498b52c33a1421ff8895e4557790f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-card','data' => ['title' => $featuredPost->title,'summary' => $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 200),'image' => $featuredPost->image_url,'link' => route('blog.show', $featuredPost->slug),'publishedDate' => $featuredPost->published_at,'author' => $featuredPost->author->name ?? 'Admin','category' => ucfirst($featuredPost->type),'layout' => 'horizontal','featured' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredPost->title),'summary' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 200)),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredPost->image_url),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('blog.show', $featuredPost->slug)),'published-date' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredPost->published_at),'author' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredPost->author->name ?? 'Admin'),'category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(ucfirst($featuredPost->type)),'layout' => 'horizontal','featured' => true]); ?>
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
                    </div>
                <?php endif; ?>

                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <?php $__currentLoopData = $posts->skip(!request('type') ? 1 : 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal14b498b52c33a1421ff8895e4557790f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal14b498b52c33a1421ff8895e4557790f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-card','data' => ['title' => $post->title,'summary' => $post->excerpt ?? Str::limit(strip_tags($post->content), 120),'image' => $post->image_url,'link' => route('blog.show', $post->slug),'publishedDate' => $post->published_at,'author' => $post->author->name ?? 'Admin','category' => ucfirst($post->type)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title),'summary' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->excerpt ?? Str::limit(strip_tags($post->content), 120)),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->image_url),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('blog.show', $post->slug)),'published-date' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->published_at),'author' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->author->name ?? 'Admin'),'category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(ucfirst($post->type))]); ?>
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

                
                <?php if($posts->hasPages()): ?>
                    <div class="mt-12 flex justify-center">
                        <nav class="flex items-center gap-2">
                            
                            <?php if($posts->onFirstPage()): ?>
                                <span class="px-4 py-2 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </span>
                            <?php else: ?>
                                <a href="<?php echo e($posts->previousPageUrl()); ?>" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            
                            <?php $__currentLoopData = $posts->getUrlRange(1, $posts->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page == $posts->currentPage()): ?>
                                    <span class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium"><?php echo e($page); ?></span>
                                <?php else: ?>
                                    <a href="<?php echo e($url); ?>" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"><?php echo e($page); ?></a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <?php if($posts->hasMorePages()): ?>
                                <a href="<?php echo e($posts->nextPageUrl()); ?>" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            <?php else: ?>
                                <span class="px-4 py-2 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </nav>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="py-16 bg-gradient-to-r from-green-700 to-green-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                <?php echo e(trans_setting('blog_newsletter_title', __('blog.stay_in_the_loop'))); ?>

            </h2>
            <p class="text-green-100 mb-8 max-w-xl mx-auto">
                <?php echo e(trans_setting('blog_newsletter_description', __('blog.newsletter_description'))); ?>

            </p>
            <form action="<?php echo e(route('home')); ?>" method="GET" class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                <input type="email" name="email" placeholder="<?php echo e(__('contact.your_email')); ?>"
                       class="flex-1 px-5 py-3 rounded-full text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit"
                        class="px-8 py-3 bg-white text-green-700 font-semibold rounded-full hover:bg-green-50 transition-colors duration-200 shadow-lg">
                    <?php echo e(__('blog.subscribe')); ?>

                </button>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/blog/index.blade.php ENDPATH**/ ?>