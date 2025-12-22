<section class="section section-text">
    @if(!empty($content['heading']))
        <h2>{{ $content['heading'] }}</h2>
    @endif
    <div class="text-content">
        {!! nl2br(e($content['body'] ?? '')) !!}
    </div>
</section>
