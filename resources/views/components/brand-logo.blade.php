@props([
    'src' => null,
    'alt' => 'Veenso',
    'class' => 'h-8 w-auto max-w-[9.5rem] object-contain sm:h-9',
])

@if ($src)
    <span {{ $attributes->class(['brand-logo-plate']) }}>
        <img src="{{ media_url($src) }}" alt="{{ $alt }}" class="{{ $class }}">
    </span>
@endif
