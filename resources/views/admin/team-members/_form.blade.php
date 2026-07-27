@php $item = $teamMember ?? null; @endphp

<div class="form-grid">
    <div class="form-row">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $item?->name) }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" class="form-control" value="{{ old('role', $item?->role) }}">
        </div>
    </div>

    <div class="form-group">
        <label for="bio">Bio</label>
        <textarea id="bio" name="bio" class="form-control">{{ old('bio', $item?->bio) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" class="form-control" required>
                @foreach (['draft', 'published'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $item?->status ?? 'draft') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
        </div>
    </div>

    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
        @if ($item?->photo)
            <div class="image-preview"><img src="{{ media_url($item->photo) }}" alt="Photo"></div>
        @endif
    </div>
</div>
