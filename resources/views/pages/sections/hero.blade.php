<section class="section section-hero">
    <div class="hero-content">
        <h2>{{ $content['title'] ?? '' }}</h2>
        @if(!empty($content['subtitle']))
            <p class="hero-subtitle">{{ $content['subtitle'] }}</p>
        @endif
        @if(!empty($content['button_text']) && !empty($content['button_url']))
            <a href="{{ $content['button_url'] }}" class="btn btn-primary">{{ $content['button_text'] }}</a>
        @endif
    </div>
</section>
