@props(['service', 'index' => 0])

<a href="{{ route('services.show', $service) }}" class="reveal card-veenso group flex flex-col gap-4 p-6" data-reveal-delay="{{ $index * 60 }}">
    <div class="flex items-center justify-between">
        <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-veenso-border bg-veenso-elevated-2 text-veenso-accent-light">
            <x-icon :name="$service->icon" class="h-5 w-5" />
        </span>
        <x-icon name="arrow-right" class="h-4 w-4 text-veenso-muted transition-all duration-300 group-hover:translate-x-1 group-hover:text-veenso-accent-light" />
    </div>

    <div class="flex flex-col gap-1.5">
        <h3 class="font-display text-lg font-semibold text-veenso-text">{{ $service->title }}</h3>
        <p class="text-sm leading-relaxed text-veenso-muted line-clamp-3">{{ $service->summary }}</p>
    </div>
</a>
