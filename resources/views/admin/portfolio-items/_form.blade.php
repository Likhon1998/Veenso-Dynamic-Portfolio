@php $item = $portfolioItem ?? null; @endphp

<div class="form-grid">
    <div class="form-row">
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $item?->title) }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $item?->slug) }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $item?->category) }}">
        </div>
        <div class="form-group">
            <label for="client_name">Client Name</label>
            <input type="text" id="client_name" name="client_name" class="form-control" value="{{ old('client_name', $item?->client_name) }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" id="year" name="year" class="form-control" value="{{ old('year', $item?->year) }}" maxlength="4">
        </div>
        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
        </div>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control tall">{{ old('description', $item?->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="service_tags">Service Tags</label>
        <span class="hint">One tag per line</span>
        <textarea id="service_tags" name="service_tags" class="form-control">{{ old('service_tags', array_to_lines($item?->service_tags)) }}</textarea>
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
            <label class="checkbox-row" style="margin-top: 1.75rem;">
                <input type="checkbox" name="featured" value="1" @checked(old('featured', $item?->featured ?? false))>
                Featured
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="featured_image">Featured Image</label>
        <input type="file" id="featured_image" name="featured_image" class="form-control" accept="image/*">
        @if ($item?->featured_image)
            <div class="image-preview"><img src="{{ media_url($item->featured_image) }}" alt="Featured"></div>
        @endif
    </div>

    @if ($item && $item->images->isNotEmpty())
        <div class="form-group">
            <label>Gallery Images</label>
            <div class="gallery-grid">
                @foreach ($item->images as $image)
                    <div class="gallery-item">
                        <img src="{{ media_url($image->path) }}" alt="{{ $image->alt }}">
                        <input type="text" name="image_alts[{{ $image->id }}]" class="form-control" value="{{ old('image_alts.'.$image->id, $image->alt) }}" placeholder="Alt text">
                        <label class="checkbox-row" style="margin-top:0.5rem;">
                            <input type="checkbox" name="delete_image_ids[]" value="{{ $image->id }}">
                            Delete
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="form-group">
        <label for="gallery_images">Add Gallery Images</label>
        <input type="file" id="gallery_images" name="gallery_images[]" class="form-control" accept="image/*" multiple>
        <span class="hint">Select multiple images to add to the gallery</span>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', $item?->meta_title) }}">
        </div>
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea id="meta_description" name="meta_description" class="form-control">{{ old('meta_description', $item?->meta_description) }}</textarea>
        </div>
    </div>
</div>
