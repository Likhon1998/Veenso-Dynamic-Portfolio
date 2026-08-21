@props([
    'src' => null,
    'alt' => '',
    'ratio' => 'aspect-[4/3]',
    'iconName' => 'sparkles',
    'label' => null,
    'title' => null,
])

@php
    $url = null;

    if ($src) {
        if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) {
            $url = $src;
        } elseif (str_starts_with($src, '/images')) {
            if (file_exists(public_path($src))) {
                $url = asset($src);
            }
        } else {
            $path = ltrim(str_replace('storage/', '', $src), '/');
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                $url = \Illuminate\Support\Facades\Storage::url($path);
            } elseif (file_exists(public_path('storage/'.$path))) {
                $url = asset('storage/'.$path);
            }
        }
    }

    $fallbackTitle = $title ?: $alt ?: $label;
@endphp

@if ($url)
    <div {{ $attributes->merge(['class' => "$ratio overflow-hidden rounded-2xl relative bg-veenso-elevated"]) }}>
        <img
            src="{{ $url }}"
            alt="{{ $alt }}"
            class="h-full w-full object-cover"
            loading="lazy"
            onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
        >
        <div class="media-fallback absolute inset-0 hidden flex flex-col items-center justify-center gap-3 p-6 text-center">
            <div class="media-fallback-grid absolute inset-0"></div>
            <div class="glow-orb h-36 w-36 opacity-60"></div>
            <x-icon :name="$iconName" class="relative z-10 h-10 w-10 text-veenso-accent-light" />
            @if ($fallbackTitle)
                <p class="relative z-10 max-w-[14rem] font-sans text-sm font-semibold text-veenso-text">{{ $fallbackTitle }}</p>
            @endif
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => "$ratio media-fallback rounded-2xl relative overflow-hidden flex flex-col items-center justify-center gap-3 p-6 text-center"]) }}>
        <div class="media-fallback-grid absolute inset-0"></div>
        <div class="glow-orb h-40 w-40 opacity-70"></div>
        <x-icon :name="$iconName" class="relative z-10 h-10 w-10 text-veenso-accent-light" />
        @if ($fallbackTitle)
            <p class="relative z-10 max-w-[16rem] font-sans text-sm font-semibold leading-snug text-veenso-text sm:text-base">{{ $fallbackTitle }}</p>
        @endif
        @if ($label && $label !== $fallbackTitle)
            <span class="absolute bottom-4 left-4 right-4 z-10 text-xs font-semibold uppercase tracking-widest text-veenso-muted">{{ $label }}</span>
        @endif
    </div>
@endif
