@extends('layouts.app')

@section('title', setting('site_name', 'Sofoodtchad') . ' - ' . setting('site_tagline', 'Quality Food Products'))

@section('content')
    {{-- Hero Section --}}
    <section class="hero">
        <div class="hero-container">
            <h1>Welcome to {{ setting('site_name', 'Sofoodtchad') }}</h1>
            <p>{{ setting('site_tagline', 'Quality Food Products') }}</p>
            <div class="hero-actions">
                <a href="{{ url('/products') }}" class="btn btn-primary">View Our Products</a>
                <a href="{{ url('/contact') }}" class="btn btn-secondary">Contact Us</a>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="section">
        <div class="container">
            <h2>About Us</h2>
            <p>{{ setting('site_description', 'We are committed to providing quality food products.') }}</p>
        </div>
    </section>

    {{-- Products Preview --}}
    <section class="section section-alt">
        <div class="container">
            <h2>Our Products</h2>
            <p>Discover our range of quality food products.</p>
            <a href="{{ url('/products') }}">View All Products →</a>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="section">
        <div class="container">
            <h2>Get In Touch</h2>
            <ul>
                @if(setting('contact_phone'))
                    <li><strong>Phone:</strong> {{ setting('contact_phone') }}</li>
                @endif
                @if(setting('contact_email'))
                    <li><strong>Email:</strong> {{ setting('contact_email') }}</li>
                @endif
                @if(setting('contact_address'))
                    <li><strong>Address:</strong> {{ setting('contact_address') }}</li>
                @endif
            </ul>
        </div>
    </section>
@endsection
