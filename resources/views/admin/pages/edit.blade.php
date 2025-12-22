@extends('admin.layouts.app')

@section('title', 'Edit Page: ' . $page->title)

@section('page-header')
    <h1>Edit Page: {{ $page->title }}</h1>
@endsection

@section('content')
    <div class="page-editor">
        {{-- Page Details Form --}}
        <section class="page-details">
            <h2>Page Details</h2>
            <form method="POST" action="{{ route('admin.pages.update', $page) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug *</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>

                <button type="submit">Update Page</button>
                <a href="{{ route('admin.pages.index') }}">Back to Pages</a>
            </form>
        </section>

        {{-- Page Sections --}}
        <section class="page-sections">
            <h2>Page Sections</h2>

            @if($page->sections->count() > 0)
                <div class="sections-list">
                    @foreach($page->sections as $section)
                        <div class="section-item" data-section-id="{{ $section->id }}">
                            <div class="section-header">
                                <span class="section-type">{{ ucfirst($section->section_type) }}</span>
                                <span class="section-order">Order: {{ $section->order }}</span>
                            </div>
                            <div class="section-content">
                                <pre>{{ json_encode($section->content, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                            <div class="section-actions">
                                <button onclick="editSection({{ $section->id }})">Edit</button>
                                <form action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this section?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No sections yet. Add your first section below.</p>
            @endif

            {{-- Add Section Form --}}
            <div class="add-section-form">
                <h3>Add New Section</h3>
                <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" id="addSectionForm">
                    @csrf

                    <div class="form-group">
                        <label for="section_type">Section Type *</label>
                        <select id="section_type" name="section_type" required onchange="updateContentFields()">
                            <option value="">Select type...</option>
                            <option value="hero">Hero Section</option>
                            <option value="text">Text Content</option>
                            <option value="image">Image</option>
                            <option value="cta">Call to Action</option>
                            <option value="features">Features List</option>
                        </select>
                    </div>

                    <div id="content-fields">
                        {{-- Dynamic fields based on section type --}}
                    </div>

                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" id="order" name="order" value="{{ $page->sections->max('order') + 1 }}" min="0">
                    </div>

                    <button type="submit">Add Section</button>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
function updateContentFields() {
    const sectionType = document.getElementById('section_type').value;
    const contentFields = document.getElementById('content-fields');

    let html = '';

    switch(sectionType) {
        case 'hero':
            html = `
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="content[title]" required>
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <input type="text" name="content[subtitle]">
                </div>
                <div class="form-group">
                    <label>Button Text</label>
                    <input type="text" name="content[button_text]">
                </div>
                <div class="form-group">
                    <label>Button URL</label>
                    <input type="text" name="content[button_url]">
                </div>
            `;
            break;
        case 'text':
            html = `
                <div class="form-group">
                    <label>Heading</label>
                    <input type="text" name="content[heading]">
                </div>
                <div class="form-group">
                    <label>Body *</label>
                    <textarea name="content[body]" rows="6" required></textarea>
                </div>
            `;
            break;
        case 'image':
            html = `
                <div class="form-group">
                    <label>Image URL *</label>
                    <input type="text" name="content[image_url]" required>
                </div>
                <div class="form-group">
                    <label>Alt Text</label>
                    <input type="text" name="content[alt_text]">
                </div>
                <div class="form-group">
                    <label>Caption</label>
                    <input type="text" name="content[caption]">
                </div>
            `;
            break;
        case 'cta':
            html = `
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="content[title]" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="content[description]" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Button Text *</label>
                    <input type="text" name="content[button_text]" required>
                </div>
                <div class="form-group">
                    <label>Button URL *</label>
                    <input type="text" name="content[button_url]" required>
                </div>
            `;
            break;
        case 'features':
            html = `
                <div class="form-group">
                    <label>Heading</label>
                    <input type="text" name="content[heading]">
                </div>
                <div class="form-group">
                    <label>Features (one per line) *</label>
                    <textarea name="content[features]" rows="6" required placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
                    <small>Each line will be a separate feature</small>
                </div>
            `;
            break;
    }

    contentFields.innerHTML = html;
}
</script>
@endpush
