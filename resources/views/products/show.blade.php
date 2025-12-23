@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))
@section('meta_description', $product->short_description ?? Str::limit(strip_tags($product->description), 160))
@section('og_title', $product->name)
@section('og_description', $product->short_description ?? $product->description)
@if($product->image_url)
    @section('og_image', $product->image_url)
@endif

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="text-center max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-6">
                    <ol class="flex items-center justify-center text-sm text-green-100 gap-2 flex-wrap">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors">
                                {{ __('navigation.home') }}
                            </a>
                        </li>
                        <li>/</li>
                        <li>
                            <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">
                                {{ __('products.title') }}
                            </a>
                        </li>
                        @if($product->category)
                            <li>/</li>
                            <li>
                                <a href="{{ route('products.category', $product->category->slug) }}" class="hover:text-white transition-colors">
                                    {{ $product->category->name }}
                                </a>
                            </li>
                        @endif
                        <li>/</li>
                        <li class="text-white font-medium truncate max-w-xs">
                            {{ Str::limit($product->name, 30) }}
                        </li>
                    </ol>
                </nav>

                {{-- Category Badge --}}
                @if($product->category)
                    <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full mb-4 bg-white/20 text-white">
                        {{ $product->category->name }}
                    </span>
                @endif

                {{-- Product Name --}}
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                    {{ $product->name }}
                </h1>

                {{-- Product Type Badge --}}
                <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full
                    {{ $product->type === 'finished' ? 'bg-blue-500/80 text-white' : 'bg-amber-500/80 text-white' }}">
                    {{ $product->type_label }}
                </span>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-white dark:fill-gray-900"/>
            </svg>
        </div>
    </section>

    {{-- Product Detail Section --}}
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                {{-- Product Gallery --}}
                <div class="space-y-4" x-data="{ activeImage: '{{ $product->image_url }}' }">
                    {{-- Main Image --}}
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 shadow-lg">
                        @if($product->images->count() > 0 || $product->image_url)
                            <img
                                :src="activeImage"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-opacity duration-300"
                                loading="eager"
                            >
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-600">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Thumbnail Images --}}
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                            @foreach($product->images as $image)
                                <button
                                    @click="activeImage = '{{ $image->image_path }}'"
                                    :class="activeImage === '{{ $image->image_path }}' ? 'ring-2 ring-green-500 ring-offset-2 dark:ring-offset-gray-900' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                                    class="aspect-square rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 transition-all duration-200 hover:opacity-80"
                                >
                                    <img
                                        src="{{ $image->image_path }}"
                                        alt="{{ $image->alt_text ?? $product->name }}"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    >
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="space-y-6">
                    {{-- Short Description --}}
                    @if($product->short_description)
                        <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $product->short_description }}
                        </p>
                    @endif

                    {{-- Available Sizes --}}
                    @if($product->sizes->count() > 0)
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                {{ __('products.available_sizes') }}
                            </h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->sizes as $size)
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium
                                        {{ $size->is_default ? 'ring-2 ring-green-500' : '' }}">
                                        {{ $size->name }}
                                        @if($size->value)
                                            <span class="text-gray-500 dark:text-gray-400">({{ $size->value }})</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Full Description --}}
                    @if($product->description)
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                {{ __('products.description') }}
                            </h3>
                            <div class="prose prose-gray dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                    @endif

                    {{-- Contact CTA --}}
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row gap-4">
                            @if(setting('contact_whatsapp'))
                                <a
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}?text={{ urlencode(__('products.whatsapp_inquiry', ['product' => $product->name])) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors shadow-lg shadow-green-500/25"
                                >
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    {{ __('products.inquire_whatsapp') }}
                                </a>
                            @endif
                            <a
                                href="{{ route('contact.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-6 py-4 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:border-green-500 hover:text-green-600 dark:hover:border-green-500 dark:hover:text-green-400 transition-colors"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ __('general.contact_us') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ __('products.related_products') }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        {{ __('products.related_products_subtitle') }}
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <article class="group bg-white dark:bg-gray-900 rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300">
                            <a href="{{ route('products.show', $related->slug) }}" class="block">
                                <div class="relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-800">
                                    @if($related->image_url)
                                        <img
                                            src="{{ $related->image_url }}"
                                            alt="{{ $related->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    {{-- Product Type Badge --}}
                                    <span class="absolute top-3 left-3 px-2.5 py-1 text-xs font-semibold rounded-full
                                        {{ $related->type === 'finished' ? 'bg-blue-500 text-white' : 'bg-amber-500 text-white' }}">
                                        {{ $related->type_label }}
                                    </span>
                                </div>
                            </a>
                            <div class="p-5">
                                @if($related->category)
                                    <span class="text-xs font-medium text-green-600 dark:text-green-400 uppercase tracking-wider">
                                        {{ $related->category->name }}
                                    </span>
                                @endif
                                <h3 class="mt-2 text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors line-clamp-2">
                                    <a href="{{ route('products.show', $related->slug) }}">
                                        {{ $related->name }}
                                    </a>
                                </h3>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Back to Products --}}
                <div class="mt-12 text-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors">
                        {{ __('products.view_all_products') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif
@endsection
