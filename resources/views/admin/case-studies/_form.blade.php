@php $item = $caseStudy ?? null; @endphp

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
            <label for="client_name">Client Name</label>
            <input type="text" id="client_name" name="client_name" class="form-control" value="{{ old('client_name', $item?->client_name) }}">
        </div>
        <div class="form-group">
            <label for="service_category">Service Category</label>
            <input type="text" id="service_category" name="service_category" class="form-control" value="{{ old('service_category', $item?->service_category) }}">
        </div>
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" class="form-control">{{ old('excerpt', $item?->excerpt) }}</textarea>
    </div>

    <div class="form-group">
        <label for="challenge">Challenge</label>
        <textarea id="challenge" name="challenge" class="form-control tall">{{ old('challenge', $item?->challenge) }}</textarea>
    </div>
    <div class="form-group">
        <label for="strategy">Strategy</label>
        <textarea id="strategy" name="strategy" class="form-control tall">{{ old('strategy', $item?->strategy) }}</textarea>
    </div>
    <div class="form-group">
        <label for="implementation">Why This Worked / Implementation</label>
        <textarea id="implementation" name="implementation" class="form-control tall">{{ old('implementation', $item?->implementation) }}</textarea>
    </div>
    <div class="form-group">
        <label for="results">Results</label>
        <textarea id="results" name="results" class="form-control tall">{{ old('results', $item?->results) }}</textarea>
    </div>

    <div class="form-group">
        <label for="stats">Stats (JSON)</label>
        <span class="hint">Array of objects: [{"label":"...","value":"..."}]</span>
        <textarea id="stats" name="stats" class="form-control code">{{ old('stats', array_to_json_field($item?->stats)) }}</textarea>
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
        <label class="checkbox-row">
            <input type="checkbox" name="featured" value="1" @checked(old('featured', $item?->featured ?? false))>
            Featured
        </label>
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
            <label>Case Study Images</label>
            <span class="hint">These appear on the public case study page with the story text. Upload as many as you need.</span>
            <div class="gallery-grid">
                @foreach ($item->images as $image)
                    <div class="gallery-item">
                        <img src="{{ media_url($image->path) }}" alt="{{ $image->alt }}">
                        <input type="text" name="image_alts[{{ $image->id }}]" class="form-control" value="{{ old('image_alts.'.$image->id, $image->alt) }}" placeholder="Alt text">
                        <input type="text" name="image_captions[{{ $image->id }}]" class="form-control" value="{{ old('image_captions.'.$image->id, $image->caption) }}" placeholder="Caption (optional)">
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
        <label for="gallery_images">Add Images</label>
        <input type="file" id="gallery_images" name="gallery_images[]" class="form-control" accept="image/*" multiple>
        <span class="hint">Select multiple screenshots, charts, or photos — no limit</span>
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
