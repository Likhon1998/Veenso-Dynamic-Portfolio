@extends('layouts.public')

@section('title', $copy['meta_title'] ?: 'Veenso — Strategy-First Digital Growth Agency')
@section('meta_description', $copy['meta_description'] ?: '')

@section('content')

    @php
        $ctaUrl = $copy['hero_cta_url'] ?: route('contact');
        if (is_string($ctaUrl) && str_starts_with($ctaUrl, '/')) {
            $ctaUrl = url($ctaUrl);
        }
        $ctaLabel = $copy['hero_cta_primary'] ?: 'Book a Free Strategy Call';
        $heroSrc = $heroImage ?? $copy['hero_image'] ?? ($siteSettings['hero_image'] ?? null);
        $regionsBadge = $heroRegionsBadge ?? $copy['hero_regions_badge'] ?? null;
    @endphp

    <section class="hero-poster relative overflow-hidden bg-black">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute right-[8%] top-[18%] h-72 w-72 rounded-full border border-[#6B8CFF]/45 opacity-70 lg:h-[26rem] lg:w-[26rem]" style="clip-path: inset(0 0 35% 45%);"></div>
            <div class="absolute right-[4%] top-[12%] h-80 w-80 rounded-full bg-[#4B1DFF]/15 blur-[90px] lg:h-[30rem] lg:w-[30rem]"></div>
        </div>

        <div class="container-veenso relative z-10 grid items-end gap-8 pb-8 pt-24 lg:min-h-[36rem] lg:grid-cols-[minmax(0,1.05fr)_minmax(0,0.95fr)] lg:gap-4 lg:pb-0 lg:pt-20 xl:min-h-[40rem]">
            <div class="reveal flex flex-col justify-center gap-5 self-center py-2 lg:max-w-xl lg:py-10">
                @if ($copy['hero_eyebrow'])
                    <p class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-[#6B8CFF] sm:text-xs">
                        {{ $copy['hero_eyebrow'] }}
                    </p>
                @endif

                <h1 class="font-sans text-[1.7rem] font-bold leading-[1.18] tracking-tight text-white sm:text-4xl lg:text-[2.45rem]">
                    {{ $copy['hero_headline'] }}
                    @if ($copy['hero_headline_accent'])
                        <span class="text-[#6B8CFF]">{{ $copy['hero_headline_accent'] }}</span>
                    @endif
                </h1>

                @if ($copy['hero_subheadline'])
                    <p class="max-w-md text-[0.92rem] leading-relaxed text-white/80 sm:text-base">
                        {{ $copy['hero_subheadline'] }}
                    </p>
                @endif

                <div class="pt-1">
                    <a
                        href="{{ $ctaUrl }}"
                        class="inline-flex items-center justify-center rounded-xl bg-[#5B3DFF] px-6 py-3.5 text-sm font-semibold text-white shadow-[0_12px_32px_-10px_rgba(91,61,255,0.75)] transition hover:-translate-y-0.5 hover:bg-[#4B1DFF] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#6B8CFF] focus-visible:ring-offset-2 focus-visible:ring-offset-black"
                    >
                        {{ $ctaLabel }}
                    </a>
                </div>
            </div>

            <div class="reveal relative flex min-h-[22rem] items-end justify-center self-stretch sm:min-h-[28rem] lg:min-h-full lg:justify-end" data-reveal-delay="100">
                @if ($heroSrc)
                    <div class="absolute inset-0 overflow-hidden">
                        <img
                            src="{{ media_url($heroSrc) }}"
                            alt="{{ $siteSettings['site_name'] ?? 'veenso' }}"
                            class="absolute bottom-0 right-[-4%] h-[22rem] w-auto max-w-none object-contain object-bottom sm:h-[28rem] lg:h-full lg:object-cover lg:object-[68%_bottom]"
                        >
                    </div>
                @endif
            </div>
        </div>

        {{-- Anchored to full banner bottom-right (like the poster), clear of the hands --}}
        @if ($regionsBadge)
            <div class="hero-regions-badge absolute bottom-5 right-4 z-30 w-[12.5rem] sm:bottom-6 sm:right-6 sm:w-[13.5rem] lg:bottom-10 lg:right-8 lg:w-[14.5rem] xl:right-12">
                <img
                    src="{{ media_url($regionsBadge) }}"
                    alt="{{ $copy['hero_regions_text'] ?: 'Serving businesses across USA, UK, Canada, Australia & Europe' }}"
                    class="h-auto w-full object-contain drop-shadow-[0_10px_28px_rgba(0,0,0,0.55)]"
                >
            </div>
        @elseif ($copy['hero_regions_text'])
            <div class="hero-regions-badge absolute bottom-5 right-4 z-30 w-[12.5rem] rounded-xl border border-[#5B3DFF]/70 bg-black/85 px-3.5 py-3 sm:bottom-6 sm:right-6 sm:w-[13.5rem] lg:bottom-10 lg:right-8 lg:w-[14.5rem] xl:right-12">
                <p class="text-center text-[0.62rem] font-semibold uppercase leading-snug tracking-[0.05em] text-white sm:text-[0.68rem]">
                    {{ $copy['hero_regions_text'] }}
                </p>
                <div class="mt-2.5 flex items-center justify-center gap-1.5">
                    @foreach (($heroFlags ?? []) as $flag)
                        <span class="text-[0.85rem]" title="{{ $flag['label'] }}">{{ $flag['emoji'] }}</span>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <section class="border-y border-veenso-border bg-veenso-charcoal/50 py-8 lg:py-10">
        <div class="container-veenso flex flex-col gap-8">
            <div class="reveal flex flex-col items-center gap-4 lg:flex-row lg:justify-between">
                <span class="shrink-0 text-[0.7rem] font-semibold uppercase tracking-[0.18em] text-veenso-muted">{{ $copy['trust_label'] }}</span>
                <div class="flex flex-wrap items-center justify-center gap-x-7 gap-y-3 lg:justify-end">
                    @foreach ($clientLogos as $logo)
                        @if ($logo->url)
                            <a href="{{ $logo->url }}" target="_blank" rel="noopener" class="opacity-70 transition hover:opacity-100">
                                @if ($logo->logo)
                                    <img src="{{ media_url($logo->logo) }}" alt="{{ $logo->name }}" class="h-8 w-auto max-w-[7rem] object-contain">
                                @else
                                    <span class="font-display text-[0.8rem] font-semibold tracking-wide text-veenso-muted">{{ $logo->name }}</span>
                                @endif
                            </a>
                        @else
                            @if ($logo->logo)
                                <img src="{{ media_url($logo->logo) }}" alt="{{ $logo->name }}" class="h-8 w-auto max-w-[7rem] object-contain opacity-70">
                            @else
                                <span class="font-display text-[0.8rem] font-semibold tracking-wide text-veenso-muted/75">{{ $logo->name }}</span>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="stats-strip reveal grid grid-cols-2 gap-6 lg:grid-cols-4 lg:gap-8">
                @foreach ($stats as $index => $stat)
                    <x-stat :value="$stat['value']" :label="$stat['label']" data-reveal-delay="{{ $index * 60 }}" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-y">
        <div class="container-veenso section-stack">
            <x-section-heading
                :eyebrow="$copy['home_services_eyebrow']"
                :title="$copy['home_services_title']"
                :subtitle="$copy['home_services_subtitle']"
            />

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $index => $service)
                    <x-service-card :service="$service" :index="$index" />
                @endforeach
            </div>

            <div class="reveal flex justify-center">
                <x-button :href="route('services.index')" variant="secondary" size="sm">{{ $copy['home_services_cta'] ?: 'Explore All Services' }}</x-button>
            </div>
        </div>
    </section>

    @if ($featuredCaseStudy)
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso section-stack">
                <x-section-heading
                    :eyebrow="$copy['home_case_eyebrow']"
                    :title="$copy['home_case_title']"
                    :subtitle="$copy['home_case_subtitle']"
                />
                <x-case-study-card :case-study="$featuredCaseStudy" variant="featured" />
            </div>
        </section>
    @endif

    <section class="section-y">
        <div class="container-veenso section-stack">
            <x-section-heading
                :eyebrow="$copy['home_portfolio_eyebrow']"
                :title="$copy['home_portfolio_title']"
                :subtitle="$copy['home_portfolio_subtitle']"
            />

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($portfolioItems as $index => $item)
                    <x-portfolio-card :item="$item" :index="$index" />
                @endforeach
            </div>

            <div class="reveal flex justify-center">
                <x-button :href="route('portfolio.index')" variant="secondary" size="sm">{{ $copy['home_portfolio_cta'] ?: 'View Full Portfolio' }}</x-button>
            </div>
        </div>
    </section>

    @if ($whyChooseItems->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso grid gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">
                <x-section-heading
                    align="left"
                    :eyebrow="$copy['home_why_eyebrow']"
                    :title="$copy['home_why_title']"
                    :subtitle="$copy['home_why_subtitle']"
                    class="mx-0"
                />

                <div class="reveal grid gap-3 sm:grid-cols-2">
                    @foreach ($whyChooseItems as $index => $item)
                        <div class="flex flex-col gap-2 rounded-xl border border-veenso-border bg-veenso-elevated/55 p-5" data-reveal-delay="{{ $index * 50 }}">
                            <x-icon :name="$item->icon ?: 'sparkles'" class="h-5 w-5 text-veenso-accent-light" />
                            <h3 class="font-display text-sm font-semibold text-veenso-text">{{ $item->title }}</h3>
                            <p class="text-xs leading-relaxed text-veenso-muted sm:text-sm">{{ $item->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($testimonials->isNotEmpty())
        <section class="section-y">
            <div class="container-veenso section-stack">
                <x-section-heading
                    :eyebrow="$copy['home_testimonials_eyebrow']"
                    :title="$copy['home_testimonials_title']"
                    :subtitle="$copy['home_testimonials_subtitle']"
                />

                <div class="grid gap-4 lg:grid-cols-3">
                    @foreach ($testimonials as $index => $testimonial)
                        <x-testimonial-card :testimonial="$testimonial" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($blogPosts->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso section-stack">
                <x-section-heading
                    :eyebrow="$copy['home_blog_eyebrow']"
                    :title="$copy['home_blog_title']"
                    :subtitle="$copy['home_blog_subtitle']"
                />

                <div class="grid gap-4 lg:grid-cols-3">
                    @foreach ($blogPosts as $index => $post)
                        <x-blog-card :post="$post" :index="$index" />
                    @endforeach
                </div>

                <div class="reveal flex justify-center">
                    <x-button :href="route('blog.index')" variant="secondary" size="sm">{{ $copy['home_blog_cta'] ?: 'Read More Insights' }}</x-button>
                </div>
            </div>
        </section>
    @endif

    <section class="section-y">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-2xl border border-veenso-border bg-gradient-to-br from-veenso-elevated via-veenso-charcoal to-veenso-bg px-6 py-10 text-center sm:px-10 lg:py-12">
                <div class="glow-orb left-1/2 top-0 h-56 w-56 -translate-x-1/2 -translate-y-1/3 opacity-45"></div>
                <div class="relative z-10 mx-auto flex max-w-2xl flex-col items-center gap-4">
                    @if ($copy['home_cta_eyebrow'])
                        <span class="eyebrow">{{ $copy['home_cta_eyebrow'] }}</span>
                    @endif
                    <h2 class="font-display text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">
                        {{ $copy['home_cta_title'] }}
                    </h2>
                    <p class="max-w-lg text-sm leading-relaxed text-veenso-muted sm:text-[0.95rem]">
                        {{ $copy['home_cta_subtitle'] }}
                    </p>
                    <x-button :href="route('contact')" variant="primary" glow>{{ $copy['home_cta_button'] ?: 'Book a Call' }}</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
