@props([
    'showNewsletter' => false,
])

@php
    $siteName = setting('site_name', 'Sofoodtchad');
    $siteLogo = setting('site_logo');
    $siteTagline = setting('site_tagline', '');
    $contactEmail = setting('contact_email');
    $contactPhone = setting('contact_phone');
    $contactWhatsapp = setting('contact_whatsapp');
    $contactAddress = setting('contact_address');
    $workingHours = setting('contact_working_hours');

    // Social links
    $socialLinks = [
        'facebook' => ['url' => setting('social_facebook'), 'label' => 'Facebook'],
        'instagram' => ['url' => setting('social_instagram'), 'label' => 'Instagram'],
        'twitter' => ['url' => setting('social_twitter'), 'label' => 'Twitter'],
        'linkedin' => ['url' => setting('social_linkedin'), 'label' => 'LinkedIn'],
        'youtube' => ['url' => setting('social_youtube'), 'label' => 'YouTube'],
        'tiktok' => ['url' => setting('social_tiktok'), 'label' => 'TikTok'],
    ];

    // Quick links
    $quickLinks = [
        ['label' => 'Home', 'route' => '/'],
        ['label' => 'About Us', 'route' => '/about'],
        ['label' => 'Our Products', 'route' => '/products'],
        ['label' => 'Quality & Process', 'route' => '/process'],
    ];

    // Company links
    $companyLinks = [
        ['label' => 'Our Partners', 'route' => '/partners'],
        ['label' => 'Become a Distributor', 'route' => '/partners/become-distributor'],
        ['label' => 'Blog & News', 'route' => '/blog'],
        ['label' => 'Contact Us', 'route' => '/contact'],
    ];

    // Legal links
    $legalLinks = [
        ['label' => 'Privacy Policy', 'route' => '/privacy-policy'],
        ['label' => 'Terms of Service', 'route' => '/terms-of-service'],
    ];

    $currentYear = date('Y');
@endphp

<footer class="site-footer" role="contentinfo">
    {{-- Footer Main Content --}}
    <div class="footer-main">
        <div class="footer-container">
            <div class="footer-grid">
                {{-- Brand Column --}}
                <div class="footer-column footer-brand">
                    <div class="footer-logo">
                        <a href="{{ url('/') }}" aria-label="{{ $siteName }}">
                            @if($siteLogo)
                                <img
                                    src="{{ $siteLogo }}"
                                    alt="{{ $siteName }}"
                                    class="footer-logo-image"
                                    loading="lazy"
                                >
                            @else
                                <span class="footer-logo-text">{{ $siteName }}</span>
                            @endif
                        </a>
                    </div>

                    @if($siteTagline)
                        <p class="footer-tagline">{{ $siteTagline }}</p>
                    @endif

                    {{-- Social Links --}}
                    <div class="footer-social">
                        <span class="social-label sr-only">Follow us on social media</span>
                        <ul class="social-links">
                            @foreach($socialLinks as $platform => $social)
                                @if($social['url'])
                                    <li>
                                        <a
                                            href="{{ $social['url'] }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="social-link social-{{ $platform }}"
                                            aria-label="Follow us on {{ $social['label'] }}"
                                        >
                                            @switch($platform)
                                                @case('facebook')
                                                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                                    </svg>
                                                    @break
                                                @case('instagram')
                                                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                                    </svg>
                                                    @break
                                                @case('twitter')
                                                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                    </svg>
                                                    @break
                                                @case('linkedin')
                                                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                                    </svg>
                                                    @break
                                                @case('youtube')
                                                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                                                    </svg>
                                                    @break
                                                @case('tiktok')
                                                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                                    </svg>
                                                    @break
                                            @endswitch
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Quick Links Column --}}
                <div class="footer-column">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        @foreach($quickLinks as $link)
                            <li>
                                <a href="{{ url($link['route']) }}" class="footer-link">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Company Column --}}
                <div class="footer-column">
                    <h3 class="footer-heading">Company</h3>
                    <ul class="footer-links">
                        @foreach($companyLinks as $link)
                            <li>
                                <a href="{{ url($link['route']) }}" class="footer-link">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Contact Column --}}
                <div class="footer-column footer-contact">
                    <h3 class="footer-heading">Contact Us</h3>
                    <ul class="contact-list">
                        @if($contactAddress)
                            <li class="contact-item">
                                <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $contactAddress }}</span>
                            </li>
                        @endif

                        @if($contactPhone)
                            <li class="contact-item">
                                <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}">{{ $contactPhone }}</a>
                            </li>
                        @endif

                        @if($contactWhatsapp)
                            <li class="contact-item">
                                <svg class="contact-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWhatsapp) }}" target="_blank" rel="noopener noreferrer">
                                    {{ $contactWhatsapp }}
                                </a>
                            </li>
                        @endif

                        @if($contactEmail)
                            <li class="contact-item">
                                <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                            </li>
                        @endif

                        @if($workingHours)
                            <li class="contact-item">
                                <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $workingHours }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="footer-container">
            <div class="footer-bottom-content">
                {{-- Copyright --}}
                <p class="copyright">
                    &copy; {{ $currentYear }} {{ $siteName }}. All rights reserved.
                </p>

                {{-- Legal Links --}}
                <ul class="legal-links">
                    @foreach($legalLinks as $link)
                        <li>
                            <a href="{{ url($link['route']) }}" class="legal-link">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
