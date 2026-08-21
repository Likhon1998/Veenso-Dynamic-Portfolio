@extends('layouts.public')

@section('title', ($caseStudy->meta_title ?: $caseStudy->title . ' | Veenso'))
@section('meta_description', $caseStudy->meta_description ?: $caseStudy->excerpt)

@section('content')

    <article>
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

                <div class="reveal grid min-w-0 items-center gap-6 lg:grid-cols-2 lg:gap-12" data-reveal-delay="50">
                    <div class="order-2 flex min-w-0 flex-col gap-4 sm:gap-5 lg:order-1">
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

                        <h1 class="font-sans text-[1.45rem] font-semibold leading-snug tracking-tight text-veenso-text sm:text-[2.1rem] lg:text-[2.35rem]">
                            {{ $caseStudy->title }}
                        </h1>

                        @if ($caseStudy->excerpt)
                            <p class="max-w-xl text-sm leading-relaxed text-veenso-muted sm:text-[0.95rem]">{{ $caseStudy->excerpt }}</p>
                        @endif

                        @if (! empty($caseStudy->stats))
                            <div class="mt-1 grid grid-cols-2 gap-2.5 sm:grid-cols-4 sm:gap-3">
                                @foreach ($caseStudy->stats as $stat)
                                    <div class="min-w-0 rounded-xl border border-veenso-border bg-veenso-elevated/50 px-3 py-3">
                                        <div class="font-sans text-base font-semibold tabular-nums tracking-tight text-[#ece8ff] sm:text-xl">{{ $stat['value'] }}</div>
                                        <div class="mt-1 text-[0.7rem] font-medium leading-snug text-veenso-muted sm:text-xs">{{ $stat['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="relative order-1 min-w-0 lg:order-2">
                        <div class="overflow-hidden rounded-xl border border-veenso-border bg-[#111118] shadow-[0_28px_60px_-36px_rgba(0,0,0,0.85)] sm:rounded-2xl">
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
                            <div class="absolute bottom-3 left-3 right-3 sm:bottom-5 sm:left-5 sm:right-auto">
                                <div class="inline-flex w-full max-w-full flex-col gap-1 rounded-xl border border-white/15 bg-veenso-bg/85 px-3.5 py-2.5 shadow-lg backdrop-blur-md sm:w-auto sm:min-w-[12rem] sm:px-4 sm:py-3">
                                    <div class="font-sans text-lg font-semibold tabular-nums tracking-tight text-emerald-300 sm:text-2xl">{{ $primaryStat['value'] }}</div>
                                    <div class="text-[0.7rem] font-medium text-veenso-muted sm:text-xs">{{ $primaryStat['label'] }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Challenge --}}
        @if ($challengeIntro || count($challengeBlockers))
            <section class="section-y pt-0">
                <div class="container-veenso grid min-w-0 gap-6 sm:gap-8 lg:grid-cols-2 lg:items-start lg:gap-12">
                    <div class="reveal flex min-w-0 flex-col gap-3 sm:gap-4">
                        <span class="eyebrow">The Challenge</span>
                        @if ($challengeIntro)
                            <div class="max-w-xl whitespace-pre-line text-[0.9375rem] leading-relaxed text-veenso-text/90 sm:text-[1.0625rem] sm:leading-8">{{ $challengeIntro }}</div>
                        @endif
                    </div>

                    @if (count($challengeBlockers))
                        <div class="reveal min-w-0 rounded-2xl border border-veenso-accent/25 bg-gradient-to-br from-veenso-accent/15 via-veenso-elevated to-veenso-charcoal p-5 sm:p-7" data-reveal-delay="80">
                            <h2 class="mb-4 font-sans text-lg font-semibold tracking-tight text-veenso-text sm:text-xl">The blockers we uncovered</h2>
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
                        <h2 class="font-sans text-xl font-semibold tracking-tight text-veenso-text sm:text-[1.75rem]">How we built compounding growth</h2>
                    </div>

                    <div class="grid min-w-0 gap-3 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3">
                        @foreach ($strategyCards as $index => $card)
                            <div class="reveal card-veenso flex min-w-0 flex-col gap-3 p-4 sm:p-5" data-reveal-delay="{{ $index * 70 }}">
                                <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-veenso-accent/15 text-veenso-accent-light">
                                    <x-icon :name="$card['icon']" class="h-5 w-5" />
                                </div>
                                <h3 class="font-sans text-base font-semibold tracking-tight text-veenso-text">{{ $card['title'] }}</h3>
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
                        <h2 class="font-sans text-xl font-semibold tracking-tight text-veenso-text sm:text-[1.75rem]">What the data showed</h2>
                    </div>

                    <div class="grid min-w-0 gap-6 sm:gap-8 lg:grid-cols-[minmax(0,0.85fr)_minmax(0,1.15fr)] lg:items-start">
                        @if (! empty($caseStudy->stats))
                            <div class="reveal flex min-w-0 flex-col gap-3">
                                @foreach ($caseStudy->stats as $index => $stat)
                                    <div class="flex min-w-0 items-center gap-3 rounded-xl border border-veenso-border bg-veenso-elevated/40 px-3.5 py-3 sm:gap-4 sm:px-4 sm:py-3.5" data-reveal-delay="{{ $index * 50 }}">
                                        <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-veenso-accent/15 text-veenso-accent-light sm:h-10 sm:w-10">
                                            <x-icon name="sparkles" class="h-5 w-5" />
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-sans text-lg font-semibold tabular-nums tracking-tight text-[#ece8ff] sm:text-xl">{{ $stat['value'] }}</div>
                                            <div class="mt-0.5 text-[0.7rem] font-medium text-veenso-muted sm:text-xs">{{ $stat['label'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="reveal flex min-w-0 flex-col gap-4" data-reveal-delay="80">
                            @if ($caseStudy->results)
                                <div class="max-w-2xl whitespace-pre-line text-[0.9375rem] leading-relaxed text-veenso-text/90 sm:text-[1.0625rem] sm:leading-8">{{ $caseStudy->results }}</div>
                            @endif

                            @if ($caseStudy->images->isNotEmpty())
                                <div class="overflow-hidden rounded-xl border border-white/10 bg-[#ececf0] shadow-[0_24px_48px_-28px_rgba(0,0,0,0.65)]">
                                    <div class="flex items-center gap-1.5 border-b border-[#d8d8de] bg-gradient-to-b from-[#f7f7f9] to-[#ececf0] px-3 py-2" aria-hidden="true">
                                        <span class="h-2 w-2 rounded-full bg-[#ff5f57]"></span>
                                        <span class="h-2 w-2 rounded-full bg-[#febc2e]"></span>
                                        <span class="h-2 w-2 rounded-full bg-[#28c840]"></span>
                                    </div>
                                    <div class="bg-[#f4f4f6] p-1.5 sm:p-4">
                                        <img
                                            src="{{ media_url($caseStudy->images->first()->path) }}"
                                            alt="{{ $caseStudy->images->first()->alt ?: $caseStudy->title }}"
                                            class="block h-auto w-full rounded"
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
                        <h2 class="font-sans text-xl font-semibold tracking-tight text-veenso-text sm:text-[1.75rem]">Evidence from Google Search Console</h2>
                    </div>

                    <div class="grid min-w-0 gap-5 sm:gap-6 lg:grid-cols-2">
                        @foreach ($caseStudy->images as $index => $image)
                            <figure class="reveal flex h-full min-w-0 flex-col gap-3" data-reveal-delay="{{ $index * 80 }}">
                                <div class="flex h-full flex-col overflow-hidden rounded-xl border border-white/10 bg-[#ececf0] shadow-[0_24px_48px_-28px_rgba(0,0,0,0.65)]">
                                    <div class="flex items-center gap-1.5 border-b border-[#d8d8de] bg-gradient-to-b from-[#f7f7f9] to-[#ececf0] px-3 py-2" aria-hidden="true">
                                        <span class="h-2 w-2 rounded-full bg-[#ff5f57]"></span>
                                        <span class="h-2 w-2 rounded-full bg-[#febc2e]"></span>
                                        <span class="h-2 w-2 rounded-full bg-[#28c840]"></span>
                                    </div>
                                    <div class="flex min-h-[12rem] flex-1 items-center justify-center bg-[#f4f4f6] p-1.5 sm:min-h-[14rem] sm:p-4">
                                        <img
                                            src="{{ media_url($image->path) }}"
                                            alt="{{ $image->alt ?: $caseStudy->title }}"
                                            class="block h-auto max-h-full w-full rounded object-contain object-top"
                                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                        >
                                    </div>
                                </div>
                                @if ($image->caption || $image->alt)
                                    <figcaption class="mt-auto px-1 text-center text-xs text-veenso-muted sm:text-sm">{{ $image->caption ?: $image->alt }}</figcaption>
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
                    <div class="reveal mx-auto flex max-w-3xl flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <span class="eyebrow">Why This Worked</span>
                            <h2 class="font-sans text-xl font-semibold tracking-tight text-veenso-text sm:text-[1.75rem]">The compounding system</h2>
                        </div>
                        <div class="whitespace-pre-line text-[0.9375rem] leading-relaxed text-veenso-text/90 sm:text-[1.0625rem] sm:leading-8">{{ $caseStudy->implementation }}</div>
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
            <div class="reveal relative overflow-hidden rounded-[1.25rem] bg-gradient-to-br from-veenso-accent via-veenso-accent-dark to-[#4c1d95] px-5 py-9 text-center sm:rounded-[1.75rem] sm:px-8 sm:py-12 lg:px-16 lg:py-14">
                <div class="relative z-10 flex flex-col items-center gap-4 sm:gap-5">
                    <h2 class="max-w-xl font-sans text-xl font-semibold tracking-tight text-white sm:text-3xl">{{ $siteSettings['cta_case_title'] ?? 'Want results like these?' }}</h2>
                    <p class="max-w-lg text-sm leading-relaxed text-white/80 sm:text-base">{{ $siteSettings['cta_case_text'] ?? "Tell us where you want to be in 12 months — we'll show you the strategy to get there." }}</p>
                    <a href="{{ route('contact') }}" class="inline-flex w-full max-w-xs items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-veenso-accent-dark transition hover:bg-white/90 sm:w-auto">
                        {{ $siteSettings['cta_case_button'] ?? 'Book a Strategy Call' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
