<section class="section section-cta">
    <div class="cta-content">
        <h2>{{ $content['title'] ?? '' }}</h2>
        @if(!empty($content['description']))
            <p>{{ $content['description'] }}</p>
        @endif
        @if(!empty($content['button_text']) && !empty($content['button_url']))
            <a href="{{ $content['button_url'] }}" class="btn btn-cta">{{ $content['button_text'] }}</a>
        @endif
    </div>
</section>
