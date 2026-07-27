@extends('layouts.public')

@section('title', ($portfolioItem->meta_title ?: $portfolioItem->title . ' | Veenso'))
@section('meta_description', $portfolioItem->meta_description ?: $portfolioItem->description)

@section('content')

    <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
        </div>
        <div class="container-veenso relative z-10 flex flex-col gap-8">
            <a href="{{ route('portfolio.index') }}" class="reveal inline-flex items-center gap-2 text-sm font-semibold text-veenso-muted transition-colors hover:text-veenso-accent-light">
                <x-icon name="arrow-right" class="h-4 w-4 rotate-180" /> All Portfolio
            </a>

            <div class="reveal flex flex-col gap-6" data-reveal-delay="60">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="tag-veenso">{{ $portfolioItem->category }}</span>
                    @if ($portfolioItem->year)
                        <span class="text-sm text-veenso-muted">{{ $portfolioItem->year }}</span>
                    @endif
                    @if ($portfolioItem->client_name)
                        <span class="text-sm text-veenso-muted">Client: {{ $portfolioItem->client_name }}</span>
                    @endif
                </div>
                <h1 class="font-display max-w-4xl text-2xl font-bold leading-snug tracking-tight text-veenso-text sm:text-3xl lg:text-4xl">{{ $portfolioItem->title }}</h1>
                <p class="max-w-xl text-sm sm:text-base leading-relaxed text-veenso-muted">{{ $portfolioItem->description }}</p>

                @if (!empty($portfolioItem->service_tags))
                    <div class="flex flex-wrap gap-3">
                        @foreach ($portfolioItem->service_tags as $tag)
                            <span class="tag-veenso">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <x-media :src="$portfolioItem->featured_image" :alt="$portfolioItem->title" ratio="aspect-[16/9]" icon-name="sparkles" class="reveal" data-reveal-delay="120" />
        </div>
    </section>

    @if ($portfolioItem->images->isNotEmpty())
        <section class="section-y pt-0">
            <div class="container-veenso grid gap-6 sm:grid-cols-2">
                @foreach ($portfolioItem->images as $index => $image)
                    <x-media :src="$image->path" :alt="$image->alt ?: $portfolioItem->title" ratio="aspect-[4/3]" icon-name="sparkles" class="reveal" data-reveal-delay="{{ $index * 80 }}" />
                @endforeach
            </div>
        </section>
    @endif

    @if ($relatedItems->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="More Work" title="Related portfolio pieces" />
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedItems as $index => $related)
                        <x-portfolio-card :item="$related" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-y">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-[2rem] border border-veenso-border bg-gradient-to-br from-veenso-elevated via-veenso-charcoal to-veenso-bg px-8 py-16 text-center lg:px-16">
                <div class="glow-orb left-1/2 top-0 h-72 w-72 -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center gap-6">
                    <h2 class="font-display max-w-xl text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">Want a project like this?</h2>
                    <x-button :href="route('contact')" variant="primary" glow>Start Your Project</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
