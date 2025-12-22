<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Process - Sofoodtchad</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .hero { background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%); color: white; padding: 80px 0; text-align: center; }
        .hero h1 { font-size: 3rem; margin-bottom: 10px; }
        .hero p { font-size: 1.2rem; opacity: 0.9; }

        .process-section { padding: 80px 0; background: #f9f9f9; }
        .process-section h2 { text-align: center; font-size: 2.5rem; margin-bottom: 60px; color: #2d5016; }

        .steps-container { display: flex; flex-direction: column; gap: 40px; }

        .step { display: flex; align-items: flex-start; gap: 30px; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); position: relative; }
        .step:nth-child(even) { flex-direction: row-reverse; }

        .step-number { flex-shrink: 0; width: 80px; height: 80px; background: linear-gradient(135deg, #4a7c23 0%, #2d5016 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; }

        .step-content { flex: 1; }
        .step-icon { font-size: 2.5rem; margin-bottom: 15px; }
        .step-title { font-size: 1.5rem; color: #2d5016; margin-bottom: 10px; }
        .step-description { color: #666; font-size: 1.1rem; }

        .empty-state { text-align: center; padding: 60px 20px; color: #666; }

        @media (max-width: 768px) {
            .step, .step:nth-child(even) { flex-direction: column; text-align: center; align-items: center; }
            .hero h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1>Quality & Process</h1>
            <p>From farm to table - discover how we bring you the finest products</p>
        </div>
    </section>

    <section class="process-section">
        <div class="container">
            <h2>Our Process</h2>

            @if($steps->isEmpty())
                <div class="empty-state">
                    <p>Process information coming soon.</p>
                </div>
            @else
                <div class="steps-container">
                    @foreach($steps as $index => $step)
                        <div class="step">
                            <div class="step-number">{{ $index + 1 }}</div>
                            <div class="step-content">
                                @if($step->icon)
                                    <div class="step-icon">{{ $step->icon }}</div>
                                @endif
                                <h3 class="step-title">{{ $step->title }}</h3>
                                <p class="step-description">{{ $step->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</body>
</html>
