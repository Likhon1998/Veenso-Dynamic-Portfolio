@props(['padding' => 'p-8'])

<div {{ $attributes->merge(['class' => "card-veenso $padding"]) }}>
    {{ $slot }}
</div>
