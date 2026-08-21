@props(['caseStudy', 'index' => 0, 'variant' => 'grid'])

@php
    $imageUrl = null;
    $src = $caseStudy->featured_image;
    if ($src) {
        if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) {
            $imageUrl = $src;
        } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists(ltrim($src, '/'))) {
            $imageUrl = \Illuminate\Support\Facades\Storage::url(ltrim($src, '/'));
        }
    }
    $primaryStat = ! empty($caseStudy->stats) ? $caseStudy->stats[0] : null;
    $isFeatured = $variant === 'featured';
@endphp

@if ($isFeatured)
    <a href="{{ route('case-studies.show', $caseStudy) }}" class="reveal card-veenso group grid min-w-0 overflow-hidden p-0 lg:grid-cols-[minmax(0,0.95fr)_minmax(0,1.05fr)]" data-reveal-delay="{{ $index * 80 }}">
        <div class="relative aspect-[16/10] overflow-hidden lg:aspect-auto lg:min-h-[17rem]">
            @if ($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $caseStudy->title }}" class="absolute inset-0 h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.03]" loading="lazy">
            @else
                <div class="media-fallback absolute inset-0 flex items-center justify-center">
                    <x-icon name="target" class="relative z-10 h-10 w-10 text-veenso-accent-light/80" />
                </div>
            @endif
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-veenso-bg/70 via-transparent to-transparent lg:bg-gradient-to-r"></div>
        </div>
        <div class="flex min-w-0 flex-col justify-center gap-3 p-5 sm:gap-4 sm:p-6 lg:p-8">
            @if ($caseStudy->service_category)
                <span class="tag-veenso self-start">{{ $caseStudy->service_category }}</span>
            @endif
            <h3 class="font-sans text-lg font-semibold tracking-tight text-veenso-text transition-colors group-hover:text-veenso-accent-light sm:text-xl lg:text-2xl">
                {{ $caseStudy->title }}
            </h3>
            @if ($caseStudy->excerpt)
                <p class="text-sm leading-relaxed text-veenso-muted line-clamp-3">{{ $caseStudy->excerpt }}</p>
            @endif
            @if (! empty($caseStudy->stats))
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                    @foreach (array_slice($caseStudy->stats, 0, 4) as $stat)
                        <div class="min-w-0">
                            <div class="font-sans text-base font-semibold tabular-nums tracking-tight text-[#ece8ff] sm:text-xl">{{ $stat['value'] }}</div>
                            <div class="mt-1 text-[0.7rem] font-medium text-veenso-muted sm:text-xs">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-veenso-accent-light">
                Read the case study <x-icon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
            </span>
        </div>
    </a>
@else
    <a href="{{ route('case-studies.show', $caseStudy) }}" class="reveal card-veenso group flex h-full min-w-0 flex-col overflow-hidden p-0" data-reveal-delay="{{ $index * 70 }}">
        <div class="relative aspect-[16/10] overflow-hidden">
            @if ($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $caseStudy->title }}" class="absolute inset-0 h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.04]" loading="lazy">
            @else
                <div class="media-fallback absolute inset-0 flex items-center justify-center">
                    <x-icon name="target" class="relative z-10 h-8 w-8 text-veenso-accent-light/80" />
                </div>
            @endif
            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-veenso-bg/80 to-transparent"></div>
            @if ($primaryStat)
                <div class="absolute bottom-2.5 left-2.5 right-2.5 z-10 sm:bottom-3 sm:left-3 sm:right-3">
                    <div class="inline-flex max-w-full items-baseline gap-1.5 rounded-lg border border-white/10 bg-veenso-bg/80 px-2 py-1.5 backdrop-blur-md sm:gap-2 sm:px-2.5">
                        <span class="shrink-0 font-sans text-[0.9rem] font-semibold tabular-nums tracking-tight text-[#ece8ff]">{{ $primaryStat['value'] }}</span>
                        <span class="truncate text-[0.7rem] font-medium text-veenso-muted sm:text-xs">{{ $primaryStat['label'] }}</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-2 p-4 sm:gap-2.5 sm:p-5">
            @if ($caseStudy->service_category)
                <span class="tag-veenso self-start">{{ $caseStudy->service_category }}</span>
            @endif
            <h3 class="font-sans text-[0.95rem] font-semibold tracking-tight text-veenso-text transition-colors line-clamp-2 group-hover:text-veenso-accent-light sm:text-base">
                {{ $caseStudy->title }}
            </h3>
            @if ($caseStudy->excerpt)
                <p class="text-sm leading-relaxed text-veenso-muted line-clamp-2">{{ $caseStudy->excerpt }}</p>
            @endif
            <span class="mt-auto inline-flex items-center gap-1.5 pt-1 text-sm font-semibold text-veenso-accent-light">
                View results <x-icon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
            </span>
        </div>
    </a>
@endif
