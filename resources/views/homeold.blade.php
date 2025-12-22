@extends('layouts.app')

@section('title', setting('site_name', 'Sofoodtchad') . ' - ' . setting('site_tagline', 'Quality Food Products'))

@section('content')
    {{-- ==================== HERO COMPONENT ==================== --}}
    <x-hero
        background_image="https://images.unsplash.com/photo-1563292769-4e05b684851a?w=1920"
        title="Welcome to {{ setting('site_name', 'Sofoodtchad') }}"
        subtitle="{{ setting('site_tagline', 'Premium Quality Cashews from Chad - Natural, Healthy, Delicious') }}"
        cta_text="View Our Products"
        cta_url="/products"
        secondaryCtaText="Contact Us"
        secondaryCtaUrl="/contact"
    />

    {{-- ==================== ABOUT SNIPPET COMPONENT ==================== --}}
    <x-about-snippet
        title="Our Story"
        subtitle="About Sofoodtchad"
        description="We are dedicated to bringing you the finest quality cashew nuts from Chad. Our commitment to excellence starts from the farms where we source our premium nuts, through careful processing, to deliver products that meet the highest standards of quality and taste.

Our mission is to share the rich flavors of Chad with the world while supporting local farmers and sustainable practices."
        image="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800"
    >
        <x-button type="primary" text="Learn More About Us" url="/about" />
    </x-about-snippet>

    {{-- ==================== PRODUCT GRID COMPONENT ==================== --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @php
                $sampleProducts = collect([
                    (object)[
                        'name' => 'Premium Roasted Cashews',
                        'slug' => 'premium-roasted-cashews',
                        'short_description' => 'Perfectly roasted cashews with a rich, buttery flavor. Great for snacking or cooking.',
                        'featured_image' => 'https://images.unsplash.com/photo-1563292769-4e05b684851a?w=400',
                        'price' => 5000,
                        'sale_price' => null,
                        'category' => (object)['name' => 'Roasted'],
                    ],
                    (object)[
                        'name' => 'Raw Natural Cashews',
                        'slug' => 'raw-natural-cashews',
                        'short_description' => 'Pure, unprocessed cashews straight from the farm. Perfect for healthy eating.',
                        'featured_image' => 'https://images.unsplash.com/photo-1604542031658-5799ca5d7936?w=400',
                        'price' => 4500,
                        'sale_price' => 3800,
                        'category' => (object)['name' => 'Raw'],
                    ],
                    (object)[
                        'name' => 'Salted Cashews',
                        'slug' => 'salted-cashews',
                        'short_description' => 'Lightly salted for the perfect balance of flavor. An irresistible snack.',
                        'featured_image' => 'https://images.unsplash.com/photo-1578864584124-da0beb498271?w=400',
                        'price' => 5500,
                        'sale_price' => null,
                        'category' => (object)['name' => 'Salted'],
                    ],
                    (object)[
                        'name' => 'Honey Glazed Cashews',
                        'slug' => 'honey-glazed-cashews',
                        'short_description' => 'Sweet and crunchy honey-coated cashews. A delicious treat for any occasion.',
                        'featured_image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=400',
                        'price' => 6000,
                        'sale_price' => null,
                        'category' => (object)['name' => 'Flavored'],
                    ],
                ]);
            @endphp

            <x-product-grid
                :products="$sampleProducts"
                title="Our Products"
                subtitle="Discover our range of premium quality cashew products"
                viewAllUrl="/products"
                viewAllText="View All Products"
            />
        </div>
    </section>

    {{-- ==================== PROCESS STEPS COMPONENT ==================== --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Our Process</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Quality & Process</h2>
                <p class="text-gray-600 mt-2 max-w-2xl mx-auto">From farm to table, we ensure the highest quality standards at every step.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <x-process-step
                    step_number="1"
                    title="Harvest"
                    description="We carefully select and harvest the finest cashew nuts from trusted local farms in Chad."
                    iconBgColor="green"
                />

                <x-process-step
                    step_number="2"
                    title="Processing"
                    description="Our cashews undergo careful processing to ensure quality while preserving natural nutrients."
                    iconBgColor="blue"
                />

                <x-process-step
                    step_number="3"
                    title="Quality Control"
                    description="Every batch is thoroughly inspected to meet our strict quality standards."
                    iconBgColor="orange"
                />

                <x-process-step
                    step_number="4"
                    title="Packaging"
                    description="Premium packaging ensures freshness and quality until it reaches your hands."
                    iconBgColor="purple"
                />
            </div>

            <div class="text-center mt-10">
                <x-button type="outline" text="Learn More About Our Process" url="/process" />
            </div>
        </div>
    </section>

    {{-- ==================== BLOG / POST CARDS COMPONENT ==================== --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8">
                <div>
                    <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Our Blog</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">Latest News & Articles</h2>
                </div>
                <a href="/blog" class="inline-flex items-center text-green-600 font-medium hover:text-green-700 mt-4 sm:mt-0">
                    View All Posts
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-post-card
                    title="Health Benefits of Cashew Nuts"
                    summary="Discover the amazing health benefits of incorporating cashews into your daily diet. From heart health to weight management."
                    image="https://images.unsplash.com/photo-1563292769-4e05b684851a?w=600"
                    link="/blog/health-benefits-cashews"
                    published_date="2025-12-20"
                    category="Health"
                />

                <x-post-card
                    title="Sustainable Farming in Chad"
                    summary="Learn about our commitment to sustainable farming practices and how we support local communities in Chad."
                    image="https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=600"
                    link="/blog/sustainable-farming"
                    published_date="2025-12-18"
                    category="Sustainability"
                />

                <x-post-card
                    title="Delicious Cashew Recipes"
                    summary="Explore creative and delicious recipes featuring our premium cashew nuts. From snacks to main courses."
                    image="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600"
                    link="/blog/cashew-recipes"
                    published_date="2025-12-15"
                    category="Recipes"
                />
            </div>
        </div>
    </section>

    {{-- ==================== PARTNER CARDS COMPONENT ==================== --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Trusted By</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Our Partners</h2>
                <p class="text-gray-600 mt-2">We work with leading companies to deliver quality products worldwide.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <x-partner-card
                    name="Partner 1"
                    logo_image="https://via.placeholder.com/200x80?text=Partner+1"
                    link="#"
                />
                <x-partner-card
                    name="Partner 2"
                    logo_image="https://via.placeholder.com/200x80?text=Partner+2"
                    link="#"
                />
                <x-partner-card
                    name="Partner 3"
                    logo_image="https://via.placeholder.com/200x80?text=Partner+3"
                    link="#"
                />
                <x-partner-card
                    name="Partner 4"
                    logo_image="https://via.placeholder.com/200x80?text=Partner+4"
                    link="#"
                />
                <x-partner-card
                    name="Partner 5"
                    logo_image="https://via.placeholder.com/200x80?text=Partner+5"
                    link="#"
                />
                <x-partner-card
                    name="Partner 6"
                    logo_image="https://via.placeholder.com/200x80?text=Partner+6"
                    link="#"
                />
            </div>

            <div class="text-center mt-10">
                <x-button type="outline" text="Become a Partner" url="/partners/become-distributor" />
            </div>
        </div>
    </section>

    {{-- ==================== BUTTONS SHOWCASE ==================== --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Button Variants</h2>
                <p class="text-gray-600 mt-2">All available button styles</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                <x-button type="primary" text="Primary" url="#" />
                <x-button type="secondary" text="Secondary" url="#" />
                <x-button type="outline" text="Outline" url="#" />
                <x-button type="ghost" text="Ghost" url="#" />
                <x-button type="danger" text="Danger" url="#" />
                <x-button type="white" text="White" url="#" />
            </div>

            <div class="flex flex-wrap justify-center gap-4 mt-6">
                <x-button type="primary" text="Small" url="#" size="sm" />
                <x-button type="primary" text="Medium" url="#" size="md" />
                <x-button type="primary" text="Large" url="#" size="lg" />
                <x-button type="primary" text="Extra Large" url="#" size="xl" />
            </div>
        </div>
    </section>

    {{-- ==================== CARD COMPONENT SHOWCASE ==================== --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Card Component</h2>
                <p class="text-gray-600 mt-2">Reusable card for various content types</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <x-card
                    image="https://images.unsplash.com/photo-1563292769-4e05b684851a?w=400"
                    title="Card Title"
                    description="This is a sample card description. It can contain any text content you need."
                    link="#"
                    linkText="Learn More"
                    badge="Featured"
                    badgeColor="green"
                />

                <x-card
                    image="https://images.unsplash.com/photo-1604542031658-5799ca5d7936?w=400"
                    title="Another Card"
                    description="Cards can be used for products, blog posts, services, and more."
                    link="#"
                    badge="New"
                    badgeColor="blue"
                />

                <x-card
                    image="https://images.unsplash.com/photo-1578864584124-da0beb498271?w=400"
                    title="Flexible Content"
                    description="Add badges, custom content, and style as needed."
                    link="#"
                    badge="Sale"
                    badgeColor="red"
                />
            </div>
        </div>
    </section>

    {{-- ==================== CONTACT FORM COMPONENT ==================== --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <x-contact-form
                    form_action="#"
                    submit_text="Send Message"
                    title="Get In Touch"
                    subtitle="Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible."
                    :showPhone="true"
                />
            </div>
        </div>
    </section>

    {{-- ==================== FORM FIELDS SHOWCASE ==================== --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Form Field Variants</h2>
                <p class="text-gray-600 mt-2">All available form field types</p>
            </div>

            <div class="max-w-xl mx-auto space-y-6">
                <x-form-field type="text" name="demo_text" label="Text Input" placeholder="Enter text..." />
                <x-form-field type="email" name="demo_email" label="Email Input" placeholder="you@example.com" />
                <x-form-field type="password" name="demo_password" label="Password Input" placeholder="••••••••" />
                <x-form-field type="number" name="demo_number" label="Number Input" placeholder="0" />
                <x-form-field type="tel" name="demo_phone" label="Phone Input" placeholder="+235 00 00 00 00" />
                <x-form-field type="textarea" name="demo_textarea" label="Textarea" placeholder="Write your message..." :rows="3" />
                <x-form-field type="select" name="demo_select" label="Select Dropdown" :options="['option1' => 'Option 1', 'option2' => 'Option 2', 'option3' => 'Option 3']" />
                <x-form-field type="file" name="demo_file" label="File Upload" accept=".pdf,.jpg,.png" />
            </div>
        </div>
    </section>
@endsection
