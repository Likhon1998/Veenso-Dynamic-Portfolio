@props(['service', 'index' => 0])

<a href="{{ route('services.show', $service) }}" class="reveal group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-veenso-border bg-veenso-elevated/40 transition duration-300 hover:-translate-y-1 hover:border-veenso-accent/40 hover:shadow-[0_20px_40px_-28px_rgba(139,92,246,0.45)]" data-reveal-delay="{{ $index * 70 }}">
    <div class="relative aspect-[16/10] overflow-hidden bg-veenso-charcoal">
        <x-media
            :src="$service->featured_image"
            :alt="$service->title"
            :title="$service->title"
            :icon-name="$service->icon ?: 'sparkles'"
            ratio="h-full w-full"
            class="!rounded-none absolute inset-0"
        />
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-veenso-bg/90 via-veenso-bg/20 to-transparent"></div>
        <span class="absolute left-3 top-3 z-10 inline-flex rounded-full border border-white/15 bg-veenso-bg/70 px-2.5 py-1 text-[0.65rem] font-semibold uppercase tracking-wider text-veenso-accent-light backdrop-blur">
            Service
        </span>
    </div>

    <div class="flex flex-1 flex-col gap-3 p-4 sm:p-5">
        <div class="flex items-start justify-between gap-3">
            <h3 class="font-sans text-base font-semibold leading-snug tracking-tight text-veenso-text transition-colors group-hover:text-veenso-accent-light sm:text-lg">
                {{ $service->title }}
            </h3>
            <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-veenso-border bg-veenso-elevated text-veenso-muted transition group-hover:border-veenso-accent/40 group-hover:text-veenso-accent-light">
                <x-icon name="arrow-right" class="h-4 w-4" />
            </span>
        </div>

        @if ($service->summary)
            <p class="text-sm leading-relaxed text-veenso-muted line-clamp-2">{{ $service->summary }}</p>
        @endif

        <span class="mt-auto inline-flex w-full items-center justify-center rounded-full border border-veenso-accent/30 bg-veenso-accent/10 px-4 py-2.5 text-sm font-semibold text-veenso-accent-light transition group-hover:bg-veenso-accent group-hover:text-white">
            View service
        </span>
    </div>
</a>
