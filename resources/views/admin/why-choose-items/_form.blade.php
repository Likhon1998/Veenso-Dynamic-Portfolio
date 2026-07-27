@php $item = $whyChooseItem ?? null; @endphp
<div class="form-grid">
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $item?->title) }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $item?->description) }}</textarea>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="icon">Icon key</label>
            <input type="text" id="icon" name="icon" class="form-control" value="{{ old('icon', $item?->icon) }}" placeholder="target, search, share, sparkles">
            <span class="hint">Available: target, search, share, sparkles, code, megaphone, etc.</span>
        </div>
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" class="form-control" required>
                @foreach (['draft','published'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $item?->status ?? 'published') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
    </div>
</div>
