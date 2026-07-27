@props([
    'src' => null,
    'alt' => '',
    'ratio' => 'aspect-[4/3]',
    'iconName' => 'sparkles',
    'label' => null,
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
            $path = ltrim($src, '/');
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                $url = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
    }
@endphp

@if ($url)
    <div {{ $attributes->merge(['class' => "$ratio overflow-hidden rounded-2xl relative"]) }}>
        <img src="{{ $url }}" alt="{{ $alt }}" class="h-full w-full object-cover" loading="lazy">
    </div>
@else
    <div {{ $attributes->merge(['class' => "$ratio media-fallback rounded-2xl relative overflow-hidden flex items-center justify-center"]) }}>
        <div class="media-fallback-grid absolute inset-0"></div>
        <div class="glow-orb w-40 h-40 opacity-70"></div>
        <x-icon :name="$iconName" class="relative z-10 w-10 h-10 text-veenso-accent-light/80" />
        @if ($label)
            <span class="absolute bottom-4 left-4 right-4 z-10 text-xs font-semibold uppercase tracking-widest text-veenso-muted">{{ $label }}</span>
        @endif
    </div>
@endif
