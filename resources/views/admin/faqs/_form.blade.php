@php $item = $faq ?? null; @endphp

<div class="form-grid">
    <div class="form-group">
        <label for="question">Question *</label>
        <input type="text" id="question" name="question" class="form-control" value="{{ old('question', $item?->question) }}" required>
    </div>

    <div class="form-group">
        <label for="answer">Answer *</label>
        <textarea id="answer" name="answer" class="form-control tall" required>{{ old('answer', $item?->answer) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $item?->category) }}">
        </div>
        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
        </div>
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
