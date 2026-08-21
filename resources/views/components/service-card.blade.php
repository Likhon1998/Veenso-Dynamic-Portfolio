@props(['service', 'index' => 0])

@php
    $imageUrl = null;
    $src = $service->featured_image;
    if ($src) {
        if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) {
            $imageUrl = $src;
        } else {
            $path = ltrim(str_replace('storage/', '', $src), '/');
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path) || file_exists(public_path('storage/'.$path))) {
                $imageUrl = media_url($path);
            }
        }
    }
@endphp

<a href="{{ route('services.show', $service) }}" class="reveal group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-veenso-border bg-veenso-elevated/50 transition duration-300 hover:-translate-y-1 hover:border-veenso-accent/45 hover:shadow-[0_22px_44px_-28px_rgba(139,92,246,0.5)]" data-reveal-delay="{{ $index * 70 }}">
    <div class="relative aspect-[16/10] overflow-hidden bg-veenso-charcoal">
        @if ($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt="{{ $service->title }}"
                class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]"
                loading="lazy"
            >
        @else
            <div class="media-fallback absolute inset-0 flex flex-col items-center justify-center gap-3 p-5 text-center">
                <div class="media-fallback-grid absolute inset-0"></div>
                <div class="glow-orb h-32 w-32 opacity-70"></div>
                <x-icon :name="$service->icon ?: 'sparkles'" class="relative z-10 h-9 w-9 text-veenso-accent-light" />
                <p class="relative z-10 font-sans text-sm font-semibold text-veenso-text">{{ $service->title }}</p>
            </div>
        @endif

        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-veenso-bg via-veenso-bg/20 to-transparent"></div>
        <span class="absolute left-3 top-3 z-10 inline-flex rounded-full border border-white/15 bg-veenso-bg/75 px-2.5 py-1 text-[0.65rem] font-semibold uppercase tracking-wider text-veenso-accent-light backdrop-blur">
            Service
        </span>
    </div>

    <div class="flex flex-1 flex-col gap-3 p-4 sm:p-5">
        <h3 class="font-sans text-base font-semibold leading-snug tracking-tight text-veenso-text transition-colors group-hover:text-veenso-accent-light sm:text-lg">
            {{ $service->title }}
        </h3>

        @if ($service->summary)
            <p class="text-sm leading-relaxed text-veenso-muted line-clamp-2">{{ $service->summary }}</p>
        @endif

        <span class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-full bg-veenso-accent px-4 py-2.5 text-sm font-semibold text-white transition group-hover:bg-veenso-accent-light">
            View service
            <x-icon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-0.5" />
        </span>
    </div>
</a>
