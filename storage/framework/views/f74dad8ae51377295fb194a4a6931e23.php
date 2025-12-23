<?php $__env->startSection('title', 'Hero Slides'); ?>
<?php $__env->startSection('page-title', 'Hero Slides'); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Hero Slides</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your homepage hero slider images and content</p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.hero.update')); ?>" method="POST" enctype="multipart/form-data" x-data="heroManager()">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700 dark:text-blue-300">
                    <strong>Tip:</strong> Use high-quality images (1920x1080 or larger). Drag slides to reorder them.
                </p>
            </div>
        </div>
    </div>

    
    <div class="space-y-6" id="slides-container">
        <template x-for="(slide, index) in slides" :key="index">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center">
                            <span class="text-sm font-bold text-green-600 dark:text-green-400" x-text="index + 1"></span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Slide <span x-text="index + 1"></span>
                        </h3>
                        <span
                            x-show="slide.is_active"
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200"
                        >
                            Active
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                :name="`slides[${index}][is_active]`"
                                value="1"
                                x-model="slide.is_active"
                                class="sr-only peer"
                            >
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-500 peer-checked:bg-green-600"></div>
                        </label>
                        
                        <button
                            type="button"
                            @click="removeSlide(index)"
                            class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <div class="lg:col-span-1">
                            <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                Slide Image
                            </label>

                            
                            <div x-show="slide.image" class="relative mb-4 group">
                                <img
                                    :src="slide.imagePreview || slide.image"
                                    alt="Slide preview"
                                    class="w-full h-40 object-cover rounded-xl border border-gray-200 dark:border-gray-600"
                                >
                                <input type="hidden" :name="`slides[${index}][image]`" :value="slide.image">
                            </div>

                            
                            <label
                                :for="`slide_image_${index}`"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                            >
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">1920x1080 recommended</p>
                                </div>
                                <input
                                    type="file"
                                    :id="`slide_image_${index}`"
                                    :name="`slide_images[${index}]`"
                                    accept="image/*"
                                    class="hidden"
                                    @change="handleImageUpload($event, index)"
                                >
                            </label>
                        </div>

                        
                        <div class="lg:col-span-2 space-y-6">
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                    Title
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">🇫🇷 French</label>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][title_fr]`"
                                            x-model="slide.title.fr"
                                            placeholder="Titre en français"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">🇬🇧 English</label>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][title_en]`"
                                            x-model="slide.title.en"
                                            placeholder="Title in English"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">🇹🇩 Arabic</label>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][title_ar]`"
                                            x-model="slide.title.ar"
                                            placeholder="العنوان بالعربية"
                                            dir="rtl"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                </div>
                            </div>

                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                    Subtitle
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">🇫🇷 French</label>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][subtitle_fr]`"
                                            x-model="slide.subtitle.fr"
                                            placeholder="Sous-titre en français"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">🇬🇧 English</label>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][subtitle_en]`"
                                            x-model="slide.subtitle.en"
                                            placeholder="Subtitle in English"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">🇹🇩 Arabic</label>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][subtitle_ar]`"
                                            x-model="slide.subtitle.ar"
                                            placeholder="العنوان الفرعي بالعربية"
                                            dir="rtl"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                        Button Text
                                    </label>
                                    <div class="grid grid-cols-3 gap-2">
                                        <input
                                            type="text"
                                            :name="`slides[${index}][cta_text_fr]`"
                                            x-model="slide.cta_text.fr"
                                            placeholder="FR"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                        <input
                                            type="text"
                                            :name="`slides[${index}][cta_text_en]`"
                                            x-model="slide.cta_text.en"
                                            placeholder="EN"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                        <input
                                            type="text"
                                            :name="`slides[${index}][cta_text_ar]`"
                                            x-model="slide.cta_text.ar"
                                            placeholder="AR"
                                            dir="rtl"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                        Button URL
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            :name="`slides[${index}][cta_url]`"
                                            x-model="slide.cta_url"
                                            placeholder="/products"
                                            class="block w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        
        <div x-show="slides.length === 0" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12">
            <div class="text-center">
                <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No slides yet</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Get started by adding your first hero slide.</p>
            </div>
        </div>
    </div>

    
    <div class="mt-6 flex items-center justify-between">
        <button
            type="button"
            @click="addSlide()"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Slide
        </button>

        <button
            type="submit"
            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg shadow-sm hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Save All Slides
        </button>
    </div>
</form>

<?php $__env->startPush('scripts'); ?>
<script>
function heroManager() {
    return {
        slides: <?php echo json_encode($slides ?? [], 15, 512) ?>.map(slide => ({
            title: slide.title || { fr: '', en: '', ar: '' },
            subtitle: slide.subtitle || { fr: '', en: '', ar: '' },
            image: slide.image || '',
            imagePreview: null,
            cta_text: slide.cta_text || { fr: '', en: '', ar: '' },
            cta_url: slide.cta_url || '',
            is_active: slide.is_active !== false,
        })),

        addSlide() {
            this.slides.push({
                title: { fr: '', en: '', ar: '' },
                subtitle: { fr: '', en: '', ar: '' },
                image: '',
                imagePreview: null,
                cta_text: { fr: '', en: '', ar: '' },
                cta_url: '',
                is_active: true,
            });
        },

        removeSlide(index) {
            if (confirm('Are you sure you want to remove this slide?')) {
                this.slides.splice(index, 1);
            }
        },

        handleImageUpload(event, index) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.slides[index].imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/hero/index.blade.php ENDPATH**/ ?>