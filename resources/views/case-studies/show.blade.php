@extends('layouts.public')

@section('title', ($caseStudy->meta_title ?: $caseStudy->title . ' | Veenso'))
@section('meta_description', $caseStudy->meta_description ?: $caseStudy->excerpt)

@section('content')

    <article class="case-study-page">
        {{-- Hero --}}
        <section class="page-hero pb-8 lg:pb-12">
            <div class="pointer-events-none absolute inset-0">
                <div class="glow-orb left-[-10%] top-[-12rem] h-[28rem] w-[28rem] opacity-35"></div>
                <div class="glow-orb right-[-8%] top-[20%] h-[22rem] w-[22rem] opacity-25"></div>
            </div>

            <div class="container-veenso relative z-10 flex flex-col gap-5 sm:gap-6">
                <a href="{{ route('case-studies.index') }}" class="reveal inline-flex items-center gap-2 text-sm font-semibold text-veenso-muted transition-colors hover:text-veenso-accent-light">
                    <x-icon name="arrow-right" class="h-4 w-4 rotate-180" /> All Case Studies
                </a>

                <div class="reveal case-study-hero-grid" data-reveal-delay="50">
                    <div class="case-study-hero-copy">
                        <div class="flex flex-wrap gap-2">
                            @if ($caseStudy->service_category)
                                <span class="tag-veenso">{{ $caseStudy->service_category }}</span>
                            @endif
                            @if ($caseMeta['industry'])
                                <span class="rounded-full border border-veenso-border bg-veenso-elevated/60 px-3 py-1 text-xs font-medium text-veenso-muted">{{ $caseMeta['industry'] }}</span>
                            @endif
                            @if ($caseMeta['platform'])
                                <span class="rounded-full border border-veenso-border bg-veenso-elevated/60 px-3 py-1 text-xs font-medium text-veenso-muted">{{ $caseMeta['platform'] }}</span>
                            @endif
                            @if ($caseMeta['location'])
                                <span class="rounded-full border border-veenso-border bg-veenso-elevated/60 px-3 py-1 text-xs font-medium text-veenso-muted">{{ $caseMeta['location'] }}</span>
                            @endif
                        </div>

                        <h1 class="case-study-title text-[1.45rem] sm:text-[2.1rem] lg:text-[2.35rem]">
                            {{ $caseStudy->title }}
                        </h1>

                        @if ($caseStudy->excerpt)
                            <p class="max-w-xl text-sm leading-relaxed text-veenso-muted sm:text-[0.95rem]">{{ $caseStudy->excerpt }}</p>
                        @endif

                        @if (! empty($caseStudy->stats))
                            <div class="case-study-stat-grid">
                                @foreach ($caseStudy->stats as $stat)
                                    <div class="case-study-stat-chip">
                                        <div class="case-study-metric text-base sm:text-xl">{{ $stat['value'] }}</div>
                                        <div class="case-study-metric-label mt-1">{{ $stat['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="case-study-hero-visual">
                        <div class="case-study-hero-media overflow-hidden rounded-xl border border-veenso-border sm:rounded-2xl">
                            @if ($caseStudy->featured_image)
                                <img
                                    src="{{ media_url($caseStudy->featured_image) }}"
                                    alt="{{ $caseStudy->title }}"
                                    class="aspect-[4/3] h-full w-full object-cover"
                                    loading="eager"
                                >
                            @else
                                <div class="media-fallback flex aspect-[4/3] items-center justify-center">
                                    <x-icon name="sparkles" class="h-10 w-10 text-veenso-accent-light/80" />
                                </div>
                            @endif
                        </div>

                        @if ($primaryStat)
                            <div class="case-study-hero-badge">
                                <div class="case-study-metric text-lg text-emerald-300 sm:text-2xl">{{ $primaryStat['value'] }}</div>
                                <div class="case-study-metric-label">{{ $primaryStat['label'] }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Challenge --}}
        @if ($challengeIntro || count($challengeBlockers))
            <section class="section-y pt-0">
                <div class="container-veenso case-study-split">
                    <div class="reveal flex min-w-0 flex-col gap-3 sm:gap-4">
                        <span class="eyebrow">The Challenge</span>
                        @if ($challengeIntro)
                            <div class="case-study-prose max-w-xl">{{ $challengeIntro }}</div>
                        @endif
                    </div>

                    @if (count($challengeBlockers))
                        <div class="reveal case-study-panel" data-reveal-delay="80">
                            <h2 class="case-study-title mb-4 text-lg sm:text-xl">The blockers we uncovered</h2>
                            <ul class="flex flex-col gap-3">
                                @foreach ($challengeBlockers as $blocker)
                                    <li class="flex gap-3 text-sm leading-relaxed text-veenso-text/90">
                                        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-veenso-accent/25 text-veenso-accent-light">
                                            <x-icon name="check" class="h-3.5 w-3.5" />
                                        </span>
                                        <span class="min-w-0">{{ $blocker }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        {{-- Strategy --}}
        @if (count($strategyCards))
            <section class="section-y bg-veenso-charcoal/35">
                <div class="container-veenso flex flex-col gap-6 sm:gap-8">
                    <div class="reveal flex flex-col gap-2">
                        <span class="eyebrow">The Strategy</span>
                        <h2 class="case-study-title text-xl sm:text-[1.75rem]">How we built compounding growth</h2>
                    </div>

                    <div class="case-study-strategy-grid">
                        @foreach ($strategyCards as $index => $card)
                            <div class="reveal card-veenso flex min-w-0 flex-col gap-3 p-4 sm:p-5" data-reveal-delay="{{ $index * 70 }}">
                                <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-veenso-accent/15 text-veenso-accent-light">
                                    <x-icon :name="$card['icon']" class="h-5 w-5" />
                                </div>
                                <h3 class="case-study-title text-base">{{ $card['title'] }}</h3>
                                @if ($card['body'])
                                    <p class="text-sm leading-relaxed text-veenso-muted">{{ $card['body'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Results --}}
        @if ($caseStudy->results || ! empty($caseStudy->stats))
            <section class="section-y">
                <div class="container-veenso flex flex-col gap-6 sm:gap-8">
                    <div class="reveal flex flex-col gap-2">
                        <span class="eyebrow">The Results</span>
                        <h2 class="case-study-title text-xl sm:text-[1.75rem]">What the data showed</h2>
                    </div>

                    <div class="case-study-results-grid">
                        @if (! empty($caseStudy->stats))
                            <div class="reveal flex min-w-0 flex-col gap-3">
                                @foreach ($caseStudy->stats as $index => $stat)
                                    <div class="flex min-w-0 items-center gap-3 rounded-xl border border-veenso-border bg-veenso-elevated/40 px-3.5 py-3 sm:gap-4 sm:px-4 sm:py-3.5" data-reveal-delay="{{ $index * 50 }}">
                                        <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-veenso-accent/15 text-veenso-accent-light sm:h-10 sm:w-10">
                                            <x-icon name="sparkles" class="h-5 w-5" />
                                        </div>
                                        <div class="min-w-0">
                                            <div class="case-study-metric text-lg sm:text-xl">{{ $stat['value'] }}</div>
                                            <div class="case-study-metric-label mt-0.5">{{ $stat['label'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="reveal flex min-w-0 flex-col gap-4" data-reveal-delay="80">
                            @if ($caseStudy->results)
                                <div class="case-study-prose max-w-2xl">{{ $caseStudy->results }}</div>
                            @endif

                            @if ($caseStudy->images->isNotEmpty())
                                <div class="case-study-shot">
                                    <div class="case-study-shot__chrome" aria-hidden="true">
                                        <span></span><span></span><span></span>
                                    </div>
                                    <div class="case-study-shot__body">
                                        <img
                                            src="{{ media_url($caseStudy->images->first()->path) }}"
                                            alt="{{ $caseStudy->images->first()->alt ?: $caseStudy->title }}"
                                            loading="lazy"
                                        >
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Search Console proof --}}
        @if ($caseStudy->images->isNotEmpty())
            <section class="section-y bg-veenso-charcoal/35">
                <div class="container-veenso flex flex-col gap-6 sm:gap-8">
                    <div class="reveal mx-auto flex max-w-2xl flex-col gap-2 text-center">
                        <span class="eyebrow justify-center">Search Console Proof</span>
                        <h2 class="case-study-title text-xl sm:text-[1.75rem]">Evidence from Google Search Console</h2>
                    </div>

                    <div class="case-study-evidence-grid">
                        @foreach ($caseStudy->images as $index => $image)
                            <figure class="reveal case-study-evidence-item" data-reveal-delay="{{ $index * 80 }}">
                                <div class="case-study-shot case-study-shot--equal">
                                    <div class="case-study-shot__chrome" aria-hidden="true">
                                        <span></span><span></span><span></span>
                                    </div>
                                    <div class="case-study-shot__body">
                                        <img
                                            src="{{ media_url($image->path) }}"
                                            alt="{{ $image->alt ?: $caseStudy->title }}"
                                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                        >
                                    </div>
                                </div>
                                @if ($image->caption || $image->alt)
                                    <figcaption>{{ $image->caption ?: $image->alt }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Why this worked --}}
        @if ($caseStudy->implementation)
            <section class="section-y">
                <div class="container-veenso">
                    <div class="case-study-narrow reveal flex flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <span class="eyebrow">Why This Worked</span>
                            <h2 class="case-study-title text-xl sm:text-[1.75rem]">The compounding system</h2>
                        </div>
                        <div class="case-study-prose" data-reveal-delay="60">{{ $caseStudy->implementation }}</div>
                    </div>
                </div>
            </section>
        @endif
    </article>

    @if ($relatedCaseStudies->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-8 sm:gap-10">
                <x-section-heading eyebrow="More Results" title="Related case studies" />
                <div class="grid min-w-0 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                    @foreach ($relatedCaseStudies as $index => $related)
                        <x-case-study-card :case-study="$related" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-y pt-0">
        <div class="container-veenso">
            <div class="reveal case-study-cta relative overflow-hidden bg-gradient-to-br from-veenso-accent via-veenso-accent-dark to-[#4c1d95] text-center">
                <div class="relative z-10 flex flex-col items-center gap-4 sm:gap-5">
                    <h2 class="case-study-title max-w-xl text-xl text-white sm:text-3xl">{{ $siteSettings['cta_case_title'] ?? 'Want results like these?' }}</h2>
                    <p class="max-w-lg text-sm leading-relaxed text-white/80 sm:text-base">{{ $siteSettings['cta_case_text'] ?? "Tell us where you want to be in 12 months — we'll show you the strategy to get there." }}</p>
                    <a href="{{ route('contact') }}" class="inline-flex w-full max-w-xs items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-veenso-accent-dark transition hover:bg-white/90 sm:w-auto">
                        {{ $siteSettings['cta_case_button'] ?? 'Book a Strategy Call' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
