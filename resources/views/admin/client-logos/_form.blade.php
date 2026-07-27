@php $item = $clientLogo ?? null; @endphp
<div class="form-grid">
    <div class="form-row">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $item?->name) }}" required>
        </div>
        <div class="form-group">
            <label for="url">Website URL</label>
            <input type="url" id="url" name="url" class="form-control" value="{{ old('url', $item?->url) }}" placeholder="https://">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" class="form-control" required>
                @foreach (['draft','published'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $item?->status ?? 'published') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
        </div>
    </div>
    <div class="form-group">
        <label for="logo">Logo Image</label>
        <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
        @if ($item?->logo)
            <div class="image-preview"><img src="{{ media_url($item->logo) }}" alt="Logo"></div>
        @endif
    </div>
</div>
