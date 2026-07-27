@props(['item', 'index' => 0])

<a href="{{ route('portfolio.show', $item) }}" class="reveal card-veenso group flex flex-col overflow-hidden p-0" data-reveal-delay="{{ $index * 80 }}">
    <x-media :src="$item->featured_image" :alt="$item->title" ratio="aspect-[4/3]" icon-name="sparkles" :label="$item->category" class="rounded-none" />

    <div class="flex flex-1 flex-col gap-2.5 p-5">
        <div class="flex items-center justify-between gap-3">
            <span class="tag-veenso">{{ $item->category }}</span>
            @if ($item->year)
                <span class="text-xs font-medium text-veenso-muted">{{ $item->year }}</span>
            @endif
        </div>
        <h3 class="font-display text-base font-semibold text-veenso-text transition-colors group-hover:text-veenso-accent-light">
            {{ $item->title }}
        </h3>
        <p class="text-sm leading-relaxed text-veenso-muted line-clamp-2">{{ $item->description }}</p>
        <span class="mt-auto inline-flex items-center gap-1.5 pt-1 text-sm font-semibold text-veenso-accent-light">
            View project <x-icon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
        </span>
    </div>
</a>
