@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'align' => 'center',
])

@php
    $alignClasses = $align === 'left' ? 'text-left items-start' : 'text-center items-center mx-auto';
@endphp

<div {{ $attributes->merge(['class' => "reveal flex flex-col gap-3 max-w-2xl $alignClasses"]) }}>
    @if ($eyebrow)
        <span class="eyebrow">{{ $eyebrow }}</span>
    @endif

    <h2 class="font-display text-2xl sm:text-3xl lg:text-[2rem] font-bold leading-snug tracking-tight text-veenso-text">
        {{ $title }}
    </h2>

    @if ($subtitle)
        <p class="text-veenso-muted text-sm sm:text-[0.95rem] leading-relaxed max-w-xl {{ $align === 'center' ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
