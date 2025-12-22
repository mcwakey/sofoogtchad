@props([
    'latitude' => null,
    'longitude' => null,
    'zoom' => 15,
    'markerTitle' => 'Location',
    'marker_title' => null,
    'height' => '400px',
    'style' => 'roadmap', // roadmap, satellite, hybrid, terrain
])

@php
    $title = $marker_title ?? $markerTitle;
    $lat = floatval($latitude);
    $lng = floatval($longitude);
    $mapId = 'map-' . uniqid();
@endphp

@if($latitude && $longitude)
    <div
        {{ $attributes->merge(['class' => 'map-container w-full bg-gray-200 relative overflow-hidden']) }}
        style="height: {{ $height }};"
        id="{{ $mapId }}"
    >
        {{-- Fallback: OpenStreetMap Static Image --}}
        <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
            <iframe
                width="100%"
                height="100%"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
                src="https://www.openstreetmap.org/export/embed.html?bbox={{ $lng - 0.01 }}%2C{{ $lat - 0.01 }}%2C{{ $lng + 0.01 }}%2C{{ $lat + 0.01 }}&layer=mapnik&marker={{ $lat }}%2C{{ $lng }}"
                style="border: 0;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>

        {{-- View Larger Map Link --}}
        <div class="absolute bottom-4 left-4 z-10">
            <a href="https://www.openstreetmap.org/?mlat={{ $lat }}&mlon={{ $lng }}#map={{ $zoom }}/{{ $lat }}/{{ $lng }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center px-4 py-2 bg-white rounded-lg shadow-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Larger Map
            </a>
        </div>

        {{-- Location Info Overlay --}}
        @if($title)
            <div class="absolute top-4 left-4 z-10">
                <div class="bg-white rounded-lg shadow-md px-4 py-2">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium text-gray-900">{{ $title }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Alternative: Google Maps Integration (uncomment if using Google Maps API) --}}
    {{--
    @push('scripts')
    <script>
        function initMap{{ str_replace('-', '', $mapId) }}() {
            const position = { lat: {{ $lat }}, lng: {{ $lng }} };
            const map = new google.maps.Map(document.getElementById("{{ $mapId }}"), {
                zoom: {{ $zoom }},
                center: position,
                mapTypeId: "{{ $style }}",
                disableDefaultUI: false,
                zoomControl: true,
                mapTypeControl: false,
                streetViewControl: true,
                fullscreenControl: true,
            });
            new google.maps.Marker({
                position: position,
                map: map,
                title: "{{ $title }}",
            });
        }
    </script>
    @endpush
    --}}
@else
    {{-- No coordinates provided --}}
    <div {{ $attributes->merge(['class' => 'map-container w-full bg-gray-100 flex items-center justify-center']) }} style="height: {{ $height }};">
        <div class="text-center text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p>Map location not available</p>
        </div>
    </div>
@endif
