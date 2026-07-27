@props(['value', 'label'])

<div {{ $attributes->merge(['class' => 'reveal flex flex-col gap-1.5']) }}>
    <span class="font-display text-2xl sm:text-3xl font-bold leading-none text-gradient-veenso">{{ $value }}</span>
    <span class="text-xs sm:text-sm text-veenso-muted leading-snug">{{ $label }}</span>
</div>
