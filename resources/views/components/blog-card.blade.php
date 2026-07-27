@props(['post', 'index' => 0])

<a href="{{ route('blog.show', $post) }}" class="reveal card-veenso group flex flex-col overflow-hidden p-0" data-reveal-delay="{{ $index * 80 }}">
    <x-media :src="$post->featured_image" :alt="$post->title" ratio="aspect-[16/10]" icon-name="sparkles" :label="$post->category" class="rounded-none" />

    <div class="flex flex-1 flex-col gap-2.5 p-5">
        <div class="flex items-center gap-3 text-xs text-veenso-muted">
            <span class="tag-veenso">{{ $post->category }}</span>
            @if ($post->published_at)
                <span>{{ $post->published_at->format('M j, Y') }}</span>
            @endif
        </div>
        <h3 class="font-display text-base font-semibold leading-snug text-veenso-text transition-colors group-hover:text-veenso-accent-light">
            {{ $post->title }}
        </h3>
        <p class="text-sm leading-relaxed text-veenso-muted line-clamp-2">{{ $post->excerpt }}</p>
        <span class="mt-auto inline-flex items-center gap-1.5 pt-1 text-sm font-semibold text-veenso-accent-light">
            Read article <x-icon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
        </span>
    </div>
</a>
