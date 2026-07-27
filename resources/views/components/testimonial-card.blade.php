@props(['testimonial', 'index' => 0])

<figure class="reveal card-veenso flex h-full flex-col gap-4 p-6" data-reveal-delay="{{ $index * 60 }}">
    <div class="flex items-start justify-between gap-3">
        <x-icon name="quote" class="h-6 w-6 text-veenso-accent/60" />
        @if ($testimonial->avatar)
            <img src="{{ media_url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="h-10 w-10 rounded-full object-cover border border-veenso-border">
        @endif
    </div>

    <blockquote class="flex-1 text-sm leading-relaxed text-veenso-text/90">
        &ldquo;{{ $testimonial->quote }}&rdquo;
    </blockquote>

    <div class="flex items-center gap-2 text-sm">
        @if ($testimonial->rating)
            <div class="flex gap-0.5 text-veenso-accent-light">
                @for ($i = 0; $i < $testimonial->rating; $i++)
                    <svg viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5"><path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1 1 5.8L10 14.9l-5.21 2.62 1-5.8-4.21-4.1 5.82-.85L10 1.5z"/></svg>
                @endfor
            </div>
        @endif
    </div>

    <figcaption class="flex flex-col gap-0.5">
        <span class="font-display text-sm font-semibold text-veenso-text">{{ $testimonial->name }}</span>
        <span class="text-xs text-veenso-muted">{{ $testimonial->role }}@if($testimonial->company), {{ $testimonial->company }}@endif</span>
    </figcaption>
</figure>
