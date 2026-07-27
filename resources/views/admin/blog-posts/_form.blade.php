@php $item = $blogPost ?? null; @endphp

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
            <label for="author">Author</label>
            <input type="text" id="author" name="author" class="form-control" value="{{ old('author', $item?->author) }}">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $item?->category) }}">
        </div>
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" class="form-control">{{ old('excerpt', $item?->excerpt) }}</textarea>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" class="form-control tall">{{ old('content', $item?->content) }}</textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <span class="hint">Comma-separated</span>
        <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags', $item?->tags ? implode(', ', $item->tags) : '') }}">
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
            <label for="published_at">Published At</label>
            <input type="datetime-local" id="published_at" name="published_at" class="form-control" value="{{ old('published_at', $item?->published_at?->format('Y-m-d\TH:i')) }}">
        </div>
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
