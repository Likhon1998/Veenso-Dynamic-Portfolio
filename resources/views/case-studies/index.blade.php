@extends('layouts.public')

@section('title', ($page?->meta_title ?: $page?->title ?: 'Case Studies | Veenso'))
@section('meta_description', ($page?->meta_description ?: 'Proven SEO and digital growth results from Veenso client engagements.'))

@section('content')

    <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
        </div>
        <div class="container-veenso relative z-10 flex flex-col items-center gap-3 text-center">
            <span class="eyebrow">{{ $page?->title ?: 'Case Studies' }}</span>
            <h1 class="font-display max-w-3xl text-[1.75rem] font-bold leading-snug tracking-tight text-veenso-text sm:text-4xl">
                {{ $page?->hero_headline ?: $page?->title ?: 'Results you can measure' }}
            </h1>
            @if ($page?->hero_subheadline)
                <p class="max-w-xl text-sm leading-relaxed text-veenso-muted sm:text-base">
                    {{ $page->hero_subheadline }}
                </p>
            @else
                <p class="max-w-xl text-sm leading-relaxed text-veenso-muted sm:text-base">
                    Real campaigns. Real Search Console data. Strategies built to compound.
                </p>
            @endif
        </div>
    </section>

    <section class="section-y pt-0">
        <div class="container-veenso">
            @if ($caseStudies->isNotEmpty())
                <div class="grid min-w-0 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                    @foreach ($caseStudies as $index => $caseStudy)
                        <x-case-study-card :case-study="$caseStudy" :index="$index" />
                    @endforeach
                </div>
            @else
                <p class="reveal text-center text-veenso-muted">New case studies are on the way. Check back soon.</p>
            @endif
        </div>
    </section>

    <section class="section-y pt-0">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-[1.25rem] border border-veenso-border bg-gradient-to-br from-veenso-elevated via-veenso-charcoal to-veenso-bg px-5 py-10 text-center sm:rounded-[1.75rem] sm:px-8 sm:py-14 lg:px-16">
                <div class="glow-orb left-1/2 top-0 h-72 w-72 -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center gap-4 sm:gap-6">
                    <h2 class="font-display max-w-xl text-xl font-bold leading-snug text-veenso-text sm:text-3xl">{{ $siteSettings['cta_case_title'] ?? 'Want results like these?' }}</h2>
                    <p class="max-w-xl text-sm text-veenso-muted sm:text-base">{{ $siteSettings['cta_case_text'] ?? "Tell us where you want to be in 12 months — we'll show you the strategy to get there." }}</p>
                    <x-button :href="route('contact')" variant="primary" glow class="w-full max-w-xs sm:w-auto">{{ $siteSettings['cta_case_button'] ?? 'Book a Strategy Call' }}</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
