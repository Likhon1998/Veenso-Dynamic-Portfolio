@php $item = $service ?? null; @endphp

<div class="form-grid">
    <div class="form-row">
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $item?->title) }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $item?->slug) }}" placeholder="Auto-generated from title if empty">
        </div>
    </div>

    <div class="form-group">
        <label for="summary">Summary</label>
        <textarea id="summary" name="summary" class="form-control">{{ old('summary', $item?->summary) }}</textarea>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control tall">{{ old('description', $item?->description) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" id="icon" name="icon" class="form-control" value="{{ old('icon', $item?->icon) }}" placeholder="e.g. search">
        </div>
        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
        </div>
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
                <input type="checkbox" name="is_primary" value="1" @checked(old('is_primary', $item?->is_primary ?? false))>
                Primary service
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

    <div class="form-group">
        <label for="tools">Tools</label>
        <span class="hint">One tool per line</span>
        <textarea id="tools" name="tools" class="form-control">{{ old('tools', array_to_lines($item?->tools)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="problems">Problems</label>
        <span class="hint">One item per line</span>
        <textarea id="problems" name="problems" class="form-control">{{ old('problems', array_to_lines($item?->problems)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="ideal_clients">Ideal Clients</label>
        <span class="hint">One client type per line</span>
        <textarea id="ideal_clients" name="ideal_clients" class="form-control">{{ old('ideal_clients', array_to_lines($item?->ideal_clients)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="benefits">Benefits (JSON)</label>
        <span class="hint">Array of objects: [{"title":"...","description":"..."}]</span>
        <textarea id="benefits" name="benefits" class="form-control code tall">{{ old('benefits', array_to_json_field($item?->benefits)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="process_steps">Process Steps (JSON)</label>
        <span class="hint">Array of objects: [{"step":1,"title":"...","description":"..."}]</span>
        <textarea id="process_steps" name="process_steps" class="form-control code tall">{{ old('process_steps', array_to_json_field($item?->process_steps)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="faqs">FAQs (JSON)</label>
        <span class="hint">Array of objects: [{"question":"...","answer":"..."}]</span>
        <textarea id="faqs" name="faqs" class="form-control code">{{ old('faqs', array_to_json_field($item?->faqs)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="why_choose">Why Choose (JSON)</label>
        <span class="hint">Array of objects: [{"title":"...","description":"..."}]</span>
        <textarea id="why_choose" name="why_choose" class="form-control code">{{ old('why_choose', array_to_json_field($item?->why_choose)) }}</textarea>
    </div>

    <div class="form-group">
        <label for="who_for">Who For</label>
        <textarea id="who_for" name="who_for" class="form-control">{{ old('who_for', $item?->who_for) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="cta_text">CTA Text</label>
            <input type="text" id="cta_text" name="cta_text" class="form-control" value="{{ old('cta_text', $item?->cta_text) }}">
        </div>
        <div class="form-group">
            <label for="cta_url">CTA URL</label>
            <input type="text" id="cta_url" name="cta_url" class="form-control" value="{{ old('cta_url', $item?->cta_url) }}">
        </div>
    </div>

    <div class="form-group">
        <label for="related_notes">Related Notes</label>
        <textarea id="related_notes" name="related_notes" class="form-control">{{ old('related_notes', $item?->related_notes) }}</textarea>
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
