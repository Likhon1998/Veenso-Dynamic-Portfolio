@props(['question', 'answer', 'open' => false])

<details {{ $attributes->merge(['class' => 'reveal group border-b border-veenso-border py-6']) }} @if ($open) open @endif>
    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left">
        <span class="font-display text-base sm:text-lg font-semibold text-veenso-text">{{ $question }}</span>
        <x-icon name="chevron-down" class="h-5 w-5 flex-shrink-0 text-veenso-accent-light transition-transform duration-300 group-open:rotate-180" />
    </summary>
    <p class="mt-4 max-w-3xl text-sm sm:text-base leading-relaxed text-veenso-muted">
        {{ $answer }}
    </p>
</details>
