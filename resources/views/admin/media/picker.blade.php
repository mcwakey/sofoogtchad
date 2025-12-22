<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Media</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; padding: 20px; }

        .search-bar { margin-bottom: 20px; }
        .search-bar input { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; }

        .media-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 15px; }
        .media-item { background: white; border-radius: 8px; overflow: hidden; cursor: pointer; transition: all 0.3s; border: 3px solid transparent; }
        .media-item:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .media-item.selected { border-color: #2d5016; }
        .media-item img { width: 100%; height: 100px; object-fit: cover; display: block; }
        .media-item .name { padding: 8px; font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .actions { position: fixed; bottom: 0; left: 0; right: 0; background: white; padding: 15px 20px; box-shadow: 0 -2px 10px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .btn { padding: 10px 25px; border: none; border-radius: 6px; cursor: pointer; font-size: 0.95rem; }
        .btn-primary { background: #2d5016; color: white; }
        .btn-secondary { background: #ddd; color: #333; }

        .empty { text-align: center; padding: 40px; color: #666; }
        .pagination { margin-top: 20px; padding-bottom: 80px; display: flex; justify-content: center; gap: 5px; }
        .pagination a, .pagination span { padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #333; }
        .pagination a:hover { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="search-bar">
        <form method="GET">
            <input type="text" name="search" placeholder="Search media..." value="{{ request('search') }}">
        </form>
    </div>

    @if($media->isEmpty())
        <div class="empty">
            <p>No images found.</p>
        </div>
    @else
        <div class="media-grid">
            @foreach($media as $item)
                <div class="media-item" data-id="{{ $item->id }}" data-url="{{ $item->url }}" data-name="{{ $item->name }}" onclick="selectMedia(this)">
                    <img src="{{ $item->url }}" alt="{{ $item->alt_text ?? $item->name }}">
                    <div class="name">{{ $item->name }}</div>
                </div>
            @endforeach
        </div>

        @if($media->hasPages())
            <div class="pagination">
                {{ $media->withQueryString()->links('pagination::simple-default') }}
            </div>
        @endif
    @endif

    <div class="actions">
        <span id="selected-count">0 selected</span>
        <div>
            <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
            <button class="btn btn-primary" onclick="confirmSelection()">Insert Selected</button>
        </div>
    </div>

    <script>
    let selectedMedia = [];

    function selectMedia(element) {
        const id = element.dataset.id;
        const index = selectedMedia.findIndex(m => m.id === id);

        if (index === -1) {
            selectedMedia.push({
                id: id,
                url: element.dataset.url,
                name: element.dataset.name
            });
            element.classList.add('selected');
        } else {
            selectedMedia.splice(index, 1);
            element.classList.remove('selected');
        }

        document.getElementById('selected-count').textContent = selectedMedia.length + ' selected';
    }

    function confirmSelection() {
        if (selectedMedia.length === 0) {
            alert('Please select at least one image.');
            return;
        }

        if (window.parent && window.parent.onMediaSelected) {
            window.parent.onMediaSelected(selectedMedia);
        }
    }

    function closeModal() {
        if (window.parent && window.parent.closeMediaPicker) {
            window.parent.closeMediaPicker();
        }
    }
    </script>
</body>
</html>
