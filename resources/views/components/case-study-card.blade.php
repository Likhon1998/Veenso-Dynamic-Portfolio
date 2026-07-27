@props(['caseStudy', 'index' => 0])

<a href="{{ route('case-studies.show', $caseStudy) }}" class="reveal card-veenso group grid gap-0 overflow-hidden p-0 lg:grid-cols-2" data-reveal-delay="{{ $index * 80 }}">
    <x-media :src="$caseStudy->featured_image" :alt="$caseStudy->title" ratio="aspect-[4/3] lg:aspect-auto lg:h-full" icon-name="target" :label="$caseStudy->service_category" class="rounded-none" />

    <div class="flex flex-col gap-3 p-6 lg:p-7">
        <span class="tag-veenso self-start">{{ $caseStudy->service_category }}</span>
        <h3 class="font-display text-lg lg:text-xl font-semibold leading-snug text-veenso-text transition-colors group-hover:text-veenso-accent-light">
            {{ $caseStudy->title }}
        </h3>
        <p class="text-sm leading-relaxed text-veenso-muted line-clamp-3">{{ $caseStudy->excerpt }}</p>

        @if (!empty($caseStudy->stats))
            <div class="mt-1 grid grid-cols-2 gap-3">
                @foreach (array_slice($caseStudy->stats, 0, 2) as $stat)
                    <div>
                        <div class="font-display text-xl font-bold text-gradient-veenso">{{ $stat['value'] }}</div>
                        <div class="text-xs text-veenso-muted">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        <span class="mt-1 inline-flex items-center gap-1.5 text-sm font-semibold text-veenso-accent-light">
            Read the case study <x-icon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
        </span>
    </div>
</a>
