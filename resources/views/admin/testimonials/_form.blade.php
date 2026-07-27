@php $item = $testimonial ?? null; @endphp

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

    <div class="form-row">
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" id="company" name="company" class="form-control" value="{{ old('company', $item?->company) }}">
        </div>
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <input type="number" id="rating" name="rating" class="form-control" value="{{ old('rating', $item?->rating ?? 5) }}" min="1" max="5">
        </div>
    </div>

    <div class="form-group">
        <label for="quote">Quote *</label>
        <textarea id="quote" name="quote" class="form-control tall" required>{{ old('quote', $item?->quote) }}</textarea>
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
        <label for="avatar">Avatar</label>
        <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
        @if ($item?->avatar)
            <div class="image-preview"><img src="{{ media_url($item->avatar) }}" alt="Avatar"></div>
        @endif
    </div>
</div>
