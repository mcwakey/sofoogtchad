<section class="section section-features">
    @if(!empty($content['heading']))
        <h2>{{ $content['heading'] }}</h2>
    @endif
    <ul class="features-list">
        @if(!empty($content['features']))
            @foreach(explode("\n", $content['features']) as $feature)
                @if(trim($feature))
                    <li>{{ trim($feature) }}</li>
                @endif
            @endforeach
        @endif
    </ul>
</section>
