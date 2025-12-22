<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->meta_title ?? $post->title }} - Sofoodtchad</title>
    <meta name="description" content="{{ $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? $post->excerpt }}">
    @if($post->featured_image)
        <meta property="og:image" content="{{ $post->image_url }}">
    @endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.8; color: #333; }
        .container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
        
        .breadcrumb { padding: 20px 0; background: #f5f5f5; font-size: 0.9rem; }
        .breadcrumb a { color: #2d5016; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        
        .post-header { padding: 60px 0 40px; text-align: center; }
        .post-type { display: inline-block; background: #2d5016; color: white; padding: 4px 15px; border-radius: 15px; font-size: 0.8rem; text-transform: uppercase; margin-bottom: 20px; }
        .post-type.news { background: #0066cc; }
        .post-title { font-size: 2.5rem; margin-bottom: 20px; line-height: 1.3; }
        .post-meta { color: #666; font-size: 0.95rem; }
        .post-meta span { margin: 0 10px; }
        
        .featured-image { margin-bottom: 40px; }
        .featured-image img { width: 100%; max-height: 500px; object-fit: cover; border-radius: 12px; }
        
        .post-content { padding-bottom: 60px; }
        .post-content p { margin-bottom: 20px; font-size: 1.1rem; }
        .post-content h2 { margin: 40px 0 20px; font-size: 1.8rem; }
        .post-content h3 { margin: 30px 0 15px; font-size: 1.4rem; }
        .post-content ul, .post-content ol { margin: 20px 0; padding-left: 30px; }
        .post-content li { margin-bottom: 10px; }
        .post-content img { max-width: 100%; border-radius: 8px; margin: 20px 0; }
        .post-content blockquote { border-left: 4px solid #2d5016; padding-left: 20px; margin: 30px 0; font-style: italic; color: #555; }
        
        .post-gallery { margin: 40px 0; }
        .post-gallery h3 { margin-bottom: 20px; }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
        .gallery-grid img { width: 100%; height: 150px; object-fit: cover; border-radius: 8px; cursor: pointer; transition: transform 0.3s; }
        .gallery-grid img:hover { transform: scale(1.05); }
        
        .related-posts { padding: 60px 0; background: #f9f9f9; }
        .related-posts h2 { text-align: center; margin-bottom: 40px; color: #2d5016; }
        .related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; max-width: 1100px; margin: 0 auto; padding: 0 20px; }
        .related-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .related-card img { width: 100%; height: 150px; object-fit: cover; }
        .related-card .content { padding: 20px; }
        .related-card h4 { margin-bottom: 10px; }
        .related-card h4 a { color: #333; text-decoration: none; }
        .related-card h4 a:hover { color: #2d5016; }
        .related-card .date { color: #666; font-size: 0.85rem; }
        
        .back-link { display: inline-block; margin-top: 40px; color: #2d5016; text-decoration: none; font-weight: 600; }
        .back-link:hover { text-decoration: underline; }
        
        @media (max-width: 768px) {
            .post-title { font-size: 1.8rem; }
            .post-content p { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <nav class="breadcrumb">
        <div class="container">
            <a href="/">Home</a> / 
            <a href="{{ route('blog.index') }}">Blog</a> / 
            {{ $post->title }}
        </div>
    </nav>

    <article>
        <header class="post-header">
            <div class="container">
                <span class="post-type {{ $post->type }}">{{ $post->type }}</span>
                <h1 class="post-title">{{ $post->title }}</h1>
                <div class="post-meta">
                    <span>{{ $post->published_at->format('F d, Y') }}</span>
                    <span>•</span>
                    <span>By {{ $post->author->name ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        @if($post->featured_image)
            <div class="featured-image">
                <div class="container">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                </div>
            </div>
        @endif

        <div class="post-content">
            <div class="container">
                {!! nl2br(e($post->content)) !!}

                @if($post->images->count())
                    <div class="post-gallery">
                        <h3>Gallery</h3>
                        <div class="gallery-grid">
                            @foreach($post->images as $image)
                                <img src="{{ $image->url }}" alt="{{ $image->alt_text ?? $post->title }}">
                            @endforeach
                        </div>
                    </div>
                @endif

                <a href="{{ route('blog.index') }}" class="back-link">← Back to Blog</a>
            </div>
        </div>
    </article>

    @if($relatedPosts->count())
        <section class="related-posts">
            <h2>Related Posts</h2>
            <div class="related-grid">
                @foreach($relatedPosts as $related)
                    <div class="related-card">
                        @if($related->featured_image)
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}">
                        @endif
                        <div class="content">
                            <h4><a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a></h4>
                            <span class="date">{{ $related->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</body>
</html>
