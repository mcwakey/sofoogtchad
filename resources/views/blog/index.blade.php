<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & News - Sofoodtchad</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        .hero { background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%); color: white; padding: 60px 0; text-align: center; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 10px; }
        
        .filters { padding: 20px 0; background: #f5f5f5; border-bottom: 1px solid #ddd; }
        .filters .container { display: flex; gap: 15px; align-items: center; }
        .filter-btn { padding: 8px 20px; border: 1px solid #ddd; background: white; border-radius: 20px; text-decoration: none; color: #333; transition: all 0.3s; }
        .filter-btn:hover, .filter-btn.active { background: #2d5016; color: white; border-color: #2d5016; }
        
        .posts-section { padding: 60px 0; }
        .posts-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; }
        
        .post-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .post-card:hover { transform: translateY(-5px); }
        .post-image { height: 200px; background: #eee; overflow: hidden; }
        .post-image img { width: 100%; height: 100%; object-fit: cover; }
        .post-image.no-image { display: flex; align-items: center; justify-content: center; color: #999; }
        .post-content { padding: 25px; }
        .post-meta { display: flex; gap: 15px; margin-bottom: 10px; font-size: 0.85rem; color: #666; }
        .post-type { background: #2d5016; color: white; padding: 2px 10px; border-radius: 10px; font-size: 0.75rem; text-transform: uppercase; }
        .post-type.news { background: #0066cc; }
        .post-title { font-size: 1.3rem; margin-bottom: 10px; }
        .post-title a { color: #333; text-decoration: none; }
        .post-title a:hover { color: #2d5016; }
        .post-excerpt { color: #666; font-size: 0.95rem; margin-bottom: 15px; }
        .read-more { color: #2d5016; text-decoration: none; font-weight: 600; }
        .read-more:hover { text-decoration: underline; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #666; }
        
        .pagination { display: flex; justify-content: center; gap: 10px; margin-top: 40px; }
        .pagination a, .pagination span { padding: 8px 15px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #333; }
        .pagination a:hover { background: #f5f5f5; }
        .pagination .current { background: #2d5016; color: white; border-color: #2d5016; }
        
        @media (max-width: 768px) {
            .posts-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1>Blog & News</h1>
            <p>Stay updated with our latest stories and announcements</p>
        </div>
    </section>

    <div class="filters">
        <div class="container">
            <a href="{{ route('blog.index') }}" class="filter-btn {{ !request('type') ? 'active' : '' }}">All</a>
            <a href="{{ route('blog.index', ['type' => 'blog']) }}" class="filter-btn {{ request('type') === 'blog' ? 'active' : '' }}">Blog</a>
            <a href="{{ route('blog.index', ['type' => 'news']) }}" class="filter-btn {{ request('type') === 'news' ? 'active' : '' }}">News</a>
        </div>
    </div>

    <section class="posts-section">
        <div class="container">
            @if($posts->isEmpty())
                <div class="empty-state">
                    <p>No posts available yet. Check back soon!</p>
                </div>
            @else
                <div class="posts-grid">
                    @foreach($posts as $post)
                        <article class="post-card">
                            <div class="post-image {{ !$post->featured_image ? 'no-image' : '' }}">
                                @if($post->featured_image)
                                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                @else
                                    <span>No Image</span>
                                @endif
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-type {{ $post->type }}">{{ $post->type }}</span>
                                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                                    <span>By {{ $post->author->name ?? 'Admin' }}</span>
                                </div>
                                <h3 class="post-title">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="post-excerpt">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="read-more">Read More →</a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($posts->hasPages())
                    <div class="pagination">
                        {{ $posts->withQueryString()->links('pagination::simple-default') }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</body>
</html>
