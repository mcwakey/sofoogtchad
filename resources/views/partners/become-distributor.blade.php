<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Distributor - Sofoodtchad</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; padding: 0 20px; }

        .hero { background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%); color: white; padding: 60px 0; text-align: center; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 10px; }
        .hero p { font-size: 1.1rem; opacity: 0.9; }

        .form-section { padding: 60px 0; }
        .form-card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }

        .form-intro { margin-bottom: 30px; }
        .form-intro h2 { color: #2d5016; margin-bottom: 10px; }
        .form-intro p { color: #666; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; color: #333; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #4a7c23; }
        .form-group .required { color: #e74c3c; }
        .form-group .hint { font-size: 0.85rem; color: #999; margin-top: 5px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .error-message { color: #e74c3c; font-size: 0.85rem; margin-top: 5px; }
        .is-invalid { border-color: #e74c3c !important; }

        .btn { display: inline-block; padding: 15px 40px; border: none; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: #2d5016; color: white; }
        .btn-primary:hover { background: #1e3a10; }

        .success-message { background: #d4edda; color: #155724; padding: 20px; border-radius: 8px; margin-bottom: 30px; }

        .back-link { display: inline-block; margin-bottom: 20px; color: #2d5016; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
            .form-card { padding: 25px; }
            .hero h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1>Become a Distributor</h1>
            <p>Partner with us and expand your business with quality products</p>
        </div>
    </section>

    <section class="form-section">
        <div class="container">
            <a href="{{ route('partners.index') }}" class="back-link">← Back to Partners</a>

            <div class="form-card">
                <div class="form-intro">
                    <h2>Distribution Application</h2>
                    <p>Fill out the form below and our team will contact you within 48 hours.</p>
                </div>

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('partners.distributor-request') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="company_name">Company Name <span class="required">*</span></label>
                            <input type="text" name="company_name" id="company_name"
                                   class="{{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                   value="{{ old('company_name') }}" required>
                            @error('company_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_name">Contact Name <span class="required">*</span></label>
                            <input type="text" name="contact_name" id="contact_name"
                                   class="{{ $errors->has('contact_name') ? 'is-invalid' : '' }}"
                                   value="{{ old('contact_name') }}" required>
                            @error('contact_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" name="email" id="email"
                                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone"
                                   class="{{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city"
                                   class="{{ $errors->has('city') ? 'is-invalid' : '' }}"
                                   value="{{ old('city') }}">
                            @error('city')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country"
                                   class="{{ $errors->has('country') ? 'is-invalid' : '' }}"
                                   value="{{ old('country') }}">
                            @error('country')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Tell us about your business</label>
                        <textarea name="message" id="message" rows="5"
                                  class="{{ $errors->has('message') ? 'is-invalid' : '' }}"
                                  placeholder="Describe your business, experience in distribution, target market, etc.">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
