@extends('admin.layouts.app')

@section('title', 'Upload Media')

@section('content')
<div class="content-header">
    <h1>Upload Media</h1>
</div>

<div class="upload-card" style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
        @csrf

        <div class="form-group">
            <label for="collection">Collection</label>
            <input type="text" name="collection" id="collection" class="form-control"
                   value="{{ old('collection', 'default') }}" placeholder="e.g., products, posts, gallery">
            <small style="color: #666;">Organize files into collections for easier management</small>
        </div>

        <div class="upload-zone" id="upload-zone" style="border: 3px dashed #ddd; border-radius: 12px; padding: 60px 20px; text-align: center; cursor: pointer; transition: all 0.3s; margin: 20px 0;">
            <input type="file" name="files[]" id="files" multiple style="display: none;" accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx">
            <div class="upload-icon" style="font-size: 4rem; margin-bottom: 15px;">📁</div>
            <p style="font-size: 1.2rem; margin-bottom: 10px;">Drag & drop files here</p>
            <p style="color: #666;">or click to browse</p>
            <p style="font-size: 0.85rem; color: #999; margin-top: 15px;">
                Supported: Images, Videos, PDF, Word, Excel (Max 10MB per file)
            </p>
        </div>

        <div id="file-preview" style="display: none; margin: 20px 0;">
            <h4>Selected Files:</h4>
            <div id="file-list" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
        </div>

        @error('files')
            <div class="error-message" style="color: #e74c3c; margin-bottom: 15px;">{{ $message }}</div>
        @enderror
        @error('files.*')
            <div class="error-message" style="color: #e74c3c; margin-bottom: 15px;">{{ $message }}</div>
        @enderror

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="upload-btn" disabled>Upload Files</button>
            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.upload-zone.dragover {
    border-color: #2d5016;
    background: #f0f8e8;
}
.file-item {
    background: #f5f5f5;
    padding: 10px 15px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.file-item .remove {
    cursor: pointer;
    color: #e74c3c;
    font-weight: bold;
}
</style>

<script>
const uploadZone = document.getElementById('upload-zone');
const fileInput = document.getElementById('files');
const filePreview = document.getElementById('file-preview');
const fileList = document.getElementById('file-list');
const uploadBtn = document.getElementById('upload-btn');

uploadZone.addEventListener('click', () => fileInput.click());

uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('dragover');
});

uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('dragover');
});

uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
    updateFileList();
});

fileInput.addEventListener('change', updateFileList);

function updateFileList() {
    fileList.innerHTML = '';
    if (fileInput.files.length > 0) {
        filePreview.style.display = 'block';
        uploadBtn.disabled = false;

        Array.from(fileInput.files).forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'file-item';
            item.innerHTML = `
                <span>${file.name}</span>
                <span style="color: #666; font-size: 0.85rem;">(${formatBytes(file.size)})</span>
            `;
            fileList.appendChild(item);
        });
    } else {
        filePreview.style.display = 'none';
        uploadBtn.disabled = true;
    }
}

function formatBytes(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
</script>
@endsection
