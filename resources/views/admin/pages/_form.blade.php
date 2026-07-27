@php $item = $page ?? null; @endphp

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
            <label for="hero_headline">Hero Headline</label>
            <input type="text" id="hero_headline" name="hero_headline" class="form-control" value="{{ old('hero_headline', $item?->hero_headline) }}">
        </div>
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" class="form-control" required>
                @foreach (['draft', 'published'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $item?->status ?? 'draft') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="hero_subheadline">Hero Subheadline</label>
        <textarea id="hero_subheadline" name="hero_subheadline" class="form-control">{{ old('hero_subheadline', $item?->hero_subheadline) }}</textarea>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" class="form-control tall">{{ old('content', $item?->content) }}</textarea>
    </div>

    <div class="form-group">
        <label for="content_blocks">Content Blocks (JSON)</label>
        <span class="hint">Structured content blocks as JSON array</span>
        <textarea id="content_blocks" name="content_blocks" class="form-control code tall">{{ old('content_blocks', array_to_json_field($item?->content_blocks)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="featured_image">Featured Image</label>
        <input type="file" id="featured_image" name="featured_image" class="form-control" accept="image/*">
        @if ($item?->featured_image)
            <div class="image-preview"><img src="{{ media_url($item->featured_image) }}" alt="Featured"></div>
        @endif
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
