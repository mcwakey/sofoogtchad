<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Partners - Sofoodtchad</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .hero { background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%); color: white; padding: 80px 0; text-align: center; }
        .hero h1 { font-size: 3rem; margin-bottom: 10px; }
        .hero p { font-size: 1.2rem; opacity: 0.9; }

        .featured-section { padding: 60px 0; background: #f9f9f9; }
        .featured-section h2 { text-align: center; margin-bottom: 40px; color: #2d5016; }

        .featured-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .featured-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); text-align: center; }
        .featured-card img { max-width: 150px; max-height: 80px; object-fit: contain; margin-bottom: 20px; }
        .featured-card h3 { color: #2d5016; margin-bottom: 10px; }
        .featured-card p { color: #666; font-size: 0.95rem; }
        .featured-card a { display: inline-block; margin-top: 15px; color: #2d5016; text-decoration: none; font-weight: 600; }
        .featured-card a:hover { text-decoration: underline; }

        .partners-section { padding: 60px 0; }
        .partners-section h2 { text-align: center; margin-bottom: 40px; color: #2d5016; }

        .partners-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px; }
        .partner-item { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 120px; }
        .partner-item img { max-width: 120px; max-height: 60px; object-fit: contain; }
        .partner-item span { font-weight: 500; color: #333; }

        .cta-section { padding: 80px 0; background: linear-gradient(135deg, #4a7c23 0%, #2d5016 100%); color: white; text-align: center; }
        .cta-section h2 { font-size: 2.2rem; margin-bottom: 15px; }
        .cta-section p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 30px; }
        .cta-btn { display: inline-block; background: white; color: #2d5016; padding: 15px 40px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 1.1rem; transition: transform 0.3s; }
        .cta-btn:hover { transform: scale(1.05); }

        .empty-state { text-align: center; padding: 60px 20px; color: #666; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .cta-section h2 { font-size: 1.6rem; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1>Our Partners</h1>
            <p>Building strong relationships for quality and growth</p>
        </div>
    </section>

    @if($featuredPartners->count())
        <section class="featured-section">
            <div class="container">
                <h2>Featured Partners</h2>
                <div class="featured-grid">
                    @foreach($featuredPartners as $partner)
                        <div class="featured-card">
                            @if($partner->logo)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                            @endif
                            <h3>{{ $partner->name }}</h3>
                            @if($partner->description)
                                <p>{{ Str::limit($partner->description, 100) }}</p>
                            @endif
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank">Visit Website →</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="partners-section">
        <div class="container">
            <h2>All Partners</h2>

            @if($partners->isEmpty())
                <div class="empty-state">
                    <p>Partner information coming soon.</p>
                </div>
            @else
                <div class="partners-grid">
                    @foreach($partners as $partner)
                        <div class="partner-item">
                            @if($partner->logo)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                            @else
                                <span>{{ $partner->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Become a Distributor</h2>
            <p>Join our network and bring quality products to your region</p>
            <a href="{{ route('partners.become-distributor') }}" class="cta-btn">Apply Now</a>
        </div>
    </section>
</body>
</html>
