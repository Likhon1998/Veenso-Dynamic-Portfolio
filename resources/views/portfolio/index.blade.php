@extends('layouts.public')

@section('title', ($page?->meta_title ?: $page?->title ?: 'Veenso'))
@section('meta_description', ($page?->meta_description ?: ''))

@section('content')

        <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
        </div>
        <div class="container-veenso relative z-10 flex flex-col items-center gap-3 text-center">
            <span class="eyebrow">{{ $page?->title ?: 'Veenso' }}</span>
            <h1 class="font-display max-w-3xl text-3xl font-bold leading-snug tracking-tight text-veenso-text sm:text-4xl">
                {{ $page?->hero_headline ?: $page?->title }}
            </h1>
            @if ($page?->hero_subheadline)
                <p class="max-w-xl text-sm sm:text-base leading-relaxed text-veenso-muted">
                    {{ $page->hero_subheadline }}
                </p>
            @endif
        </div>
    </section>

    <section class="section-y pt-0">
        <div class="container-veenso flex flex-col gap-10">
            @if ($categories->isNotEmpty())
                <div class="reveal flex flex-wrap justify-center gap-2 sm:gap-3">
                    <a href="{{ route('portfolio.index') }}" class="tag-veenso {{ empty($activeCategory) ? '!bg-veenso-accent/25' : '' }}">All</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('portfolio.index', ['category' => $category]) }}" class="tag-veenso {{ ($activeCategory ?? null) === $category ? '!bg-veenso-accent/25' : '' }}">{{ $category }}</a>
                    @endforeach
                </div>
            @endif

            <div class="grid min-w-0 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3">
                @foreach ($portfolioItems as $index => $item)
                    <x-portfolio-card :item="$item" :index="$index" />
                @endforeach
            </div>

            @if ($portfolioItems->isEmpty())
                <p class="reveal text-center text-veenso-muted">
                    {{ filled($activeCategory ?? null) ? 'No portfolio pieces in this category yet.' : 'New portfolio pieces are on the way. Check back soon.' }}
                </p>
            @endif
        </div>
    </section>

    <section class="section-y pt-0">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-[2rem] border border-veenso-border bg-gradient-to-br from-veenso-elevated via-veenso-charcoal to-veenso-bg px-8 py-16 text-center lg:px-16">
                <div class="glow-orb left-1/2 top-0 h-72 w-72 -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center gap-6">
                    <h2 class="font-display max-w-xl text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">{{ $siteSettings['cta_portfolio_title'] }}</h2>
                    <p class="max-w-xl text-veenso-muted">{{ $siteSettings['cta_portfolio_text'] }}</p>
                    <x-button :href="route('contact')" variant="primary" glow>{{ $siteSettings['cta_portfolio_button'] }}</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
