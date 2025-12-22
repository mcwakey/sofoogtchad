@extends('admin.layouts.app')

@section('title', 'Upload Media')
@section('page-title', 'Upload Media')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.media.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Upload Media</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add files to your media library</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-3xl">
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" id="upload-form" class="space-y-6">
            @csrf

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Settings</h3>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Collection --}}
                    <div>
                        <label for="collection" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Collection
                        </label>
                        <input
                            type="text"
                            name="collection"
                            id="collection"
                            value="{{ old('collection', 'default') }}"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500"
                            placeholder="e.g., products, posts, gallery"
                        >
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Organize files into collections for easier management</p>
                    </div>

                    {{-- Upload Zone --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Files <span class="text-red-500">*</span>
                        </label>
                        <div
                            id="upload-zone"
                            class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-10 text-center cursor-pointer transition-all hover:border-green-400 dark:hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/10"
                        >
                            <input type="file" name="files[]" id="files" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx">
                            <div class="space-y-3">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900 dark:to-emerald-900 flex items-center justify-center mx-auto">
                                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-base font-medium text-gray-900 dark:text-white">Drag & drop files here</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">or click to browse</p>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    Supported: Images, Videos, PDF, Word, Excel (Max 10MB per file)
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- File Preview --}}
                    <div id="file-preview" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Selected Files
                        </label>
                        <div id="file-list" class="space-y-2"></div>
                    </div>

                    @error('files')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    @error('files.*')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.media.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" id="upload-btn" disabled class="px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    Upload Files
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
const uploadZone = document.getElementById('upload-zone');
const fileInput = document.getElementById('files');
const filePreview = document.getElementById('file-preview');
const fileList = document.getElementById('file-list');
const uploadBtn = document.getElementById('upload-btn');

uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('border-green-500', 'bg-green-50', 'dark:bg-green-900/20');
});

uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('border-green-500', 'bg-green-50', 'dark:bg-green-900/20');
});

uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('border-green-500', 'bg-green-50', 'dark:bg-green-900/20');
    fileInput.files = e.dataTransfer.files;
    updateFileList();
});

fileInput.addEventListener('change', updateFileList);

function updateFileList() {
    fileList.innerHTML = '';
    if (fileInput.files.length > 0) {
        filePreview.classList.remove('hidden');
        uploadBtn.disabled = false;

        Array.from(fileInput.files).forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg';
            item.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">${file.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${formatBytes(file.size)}</p>
                    </div>
                </div>
            `;
            fileList.appendChild(item);
        });
    } else {
        filePreview.classList.add('hidden');
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
@endpush
