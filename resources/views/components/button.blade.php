@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'glow' => false,
    'tag' => null,
])

@php
    $variants = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
    ];

    $classes = 'btn ' . ($variants[$variant] ?? $variants['primary']) . ($size === 'sm' ? ' btn-sm' : '') . ($glow ? ' btn-glow' : '');

    $tag = $tag ?? ($href ? 'a' : 'button');
@endphp

@if ($tag === 'a')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => $attributes->get('type', 'button')]) }}>
        {{ $slot }}
    </button>
@endif
