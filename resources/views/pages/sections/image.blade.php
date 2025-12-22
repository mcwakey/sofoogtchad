<section class="section section-image">
    <figure>
        <img src="{{ $content['image_url'] ?? '' }}" alt="{{ $content['alt_text'] ?? '' }}">
        @if(!empty($content['caption']))
            <figcaption>{{ $content['caption'] }}</figcaption>
        @endif
    </figure>
</section>
