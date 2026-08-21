@extends('layouts.public')

@section('title', ($service->meta_title ?: $service->title . ' | Veenso'))
@section('meta_description', $service->meta_description ?: $service->summary)

@php
    $descriptionParagraphs = array_values(array_filter(array_map('trim', preg_split("/\n\s*\n/", (string) $service->description) ?: [])));
    $primaryCta = $service->cta_url ?: route('contact');
    $secondaryCta = $service->secondary_cta_url ?: route('contact');
@endphp

@section('content')

    {{-- Hero --}}
    <section class="page-hero pb-10 lg:pb-14">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-[-8%] top-[-12rem] h-[28rem] w-[28rem] opacity-40"></div>
            <div class="glow-orb right-[-10%] top-[30%] h-[22rem] w-[22rem] opacity-25"></div>
        </div>

        <div class="container-veenso relative z-10 grid min-w-0 gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">
            <div class="reveal order-2 flex min-w-0 flex-col gap-5 lg:order-1">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-veenso-muted transition-colors hover:text-veenso-accent-light">
                    <x-icon name="arrow-right" class="h-4 w-4 rotate-180" /> All Services
                </a>

                <span class="eyebrow">01 · Service</span>
                <h1 class="font-display text-[1.75rem] font-bold leading-snug tracking-tight text-veenso-text sm:text-4xl">{{ $service->title }}</h1>

                @if ($service->headline)
                    <p class="max-w-xl font-sans text-lg font-semibold leading-snug text-veenso-accent-light sm:text-xl">{{ $service->headline }}</p>
                @endif

                @if ($service->summary)
                    <p class="max-w-xl text-sm leading-relaxed text-veenso-muted sm:text-base">{{ $service->summary }}</p>
                @endif

                @if (! empty($service->hero_badges))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($service->hero_badges as $badge)
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-veenso-accent/30 bg-veenso-accent/10 px-3 py-1 text-xs font-semibold text-veenso-accent-light">
                                <x-icon name="check" class="h-3.5 w-3.5" /> {{ $badge }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <x-button :href="$primaryCta" variant="primary" glow>{{ $service->cta_text ?: 'Book a Strategy Call' }}</x-button>
                    @if ($service->secondary_cta_text)
                        <x-button :href="$secondaryCta" variant="secondary">{{ $service->secondary_cta_text }}</x-button>
                    @endif
                </div>
            </div>

            <div class="reveal order-1 min-w-0 lg:order-2" data-reveal-delay="80">
                @php
                    $heroUrl = media_url($service->featured_image);
                    $heroPath = ltrim(str_replace('storage/', '', (string) $service->featured_image), '/');
                    $heroExists = $heroPath !== '' && (
                        \Illuminate\Support\Facades\Storage::disk('public')->exists($heroPath)
                        || file_exists(public_path('storage/'.$heroPath))
                    );
                @endphp
                @if ($heroExists && $heroUrl)
                    <div class="aspect-[4/3] overflow-hidden rounded-2xl border border-veenso-border bg-veenso-elevated">
                        <img src="{{ $heroUrl }}" alt="{{ $service->title }}" class="h-full w-full object-cover" loading="eager">
                    </div>
                @else
                    <div class="media-fallback relative flex aspect-[4/3] flex-col items-center justify-center gap-3 overflow-hidden rounded-2xl p-6 text-center">
                        <div class="media-fallback-grid absolute inset-0"></div>
                        <div class="glow-orb h-40 w-40 opacity-70"></div>
                        <x-icon :name="$service->icon ?: 'sparkles'" class="relative z-10 h-10 w-10 text-veenso-accent-light" />
                        <p class="relative z-10 max-w-xs font-sans text-base font-semibold text-veenso-text">{{ $service->title }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Key stats --}}
    @if (! empty($service->key_stats))
        <section class="section-y pt-0">
            <div class="container-veenso grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($service->key_stats as $index => $stat)
                    <div class="reveal rounded-2xl border border-veenso-border bg-veenso-elevated/50 p-5" data-reveal-delay="{{ $index * 50 }}">
                        <div class="font-sans text-2xl font-semibold tracking-tight text-[#ece8ff]">{{ $stat['value'] ?? '' }}</div>
                        <p class="mt-2 text-sm leading-relaxed text-veenso-muted">{{ $stat['label'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Why it matters / what is --}}
    @if (count($descriptionParagraphs))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso grid min-w-0 gap-8 lg:grid-cols-2 lg:gap-12">
                <div class="reveal flex flex-col gap-3">
                    <span class="eyebrow">Why It Matters More Than Ever</span>
                    <div class="whitespace-pre-line text-sm leading-relaxed text-veenso-text/90 sm:text-base sm:leading-8">{{ $descriptionParagraphs[0] ?? '' }}@if(isset($descriptionParagraphs[1]))

{{ $descriptionParagraphs[1] }}@endif</div>
                </div>
                <div class="reveal flex flex-col gap-3" data-reveal-delay="80">
                    <span class="eyebrow">What Is SEO?</span>
                    <div class="whitespace-pre-line text-sm leading-relaxed text-veenso-text/90 sm:text-base sm:leading-8">{{ $descriptionParagraphs[2] ?? ($descriptionParagraphs[1] ?? $service->summary) }}</div>
                </div>
            </div>
        </section>
    @endif

    {{-- Sub-services / integrated approach --}}
    @if (! empty($service->sub_services))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-8">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">Our Integrated Approach</span>
                    <h2 class="font-display max-w-2xl text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">Rather than a single tactic, multiple disciplines working together</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($service->sub_services as $index => $sub)
                        <div class="reveal card-veenso flex flex-col gap-3 p-5 sm:p-6" data-reveal-delay="{{ $index * 50 }}">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-veenso-accent/15 text-veenso-accent-light">
                                <x-icon name="sparkles" class="h-5 w-5" />
                            </div>
                            <h3 class="font-sans text-base font-semibold text-veenso-text">{{ $sub['title'] ?? '' }}</h3>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $sub['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Problem matrix --}}
    @if (! empty($service->problem_matrix))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso flex flex-col gap-8">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">Common Problems We Fix</span>
                    <h2 class="font-display text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">Problem → Why it happens → How Veenso fixes it</h2>
                </div>

                <div class="reveal hidden overflow-hidden rounded-2xl border border-veenso-border lg:block">
                    <div class="grid grid-cols-3 bg-veenso-elevated/80 text-xs font-semibold uppercase tracking-widest text-veenso-muted">
                        <div class="border-r border-veenso-border px-5 py-3">Problem</div>
                        <div class="border-r border-veenso-border px-5 py-3">Why It Happens</div>
                        <div class="px-5 py-3 text-veenso-accent-light">How Veenso Fixes It</div>
                    </div>
                    @foreach ($service->problem_matrix as $row)
                        <div class="grid grid-cols-3 border-t border-veenso-border text-sm">
                            <div class="border-r border-veenso-border px-5 py-4 text-veenso-text">{{ $row['problem'] ?? '' }}</div>
                            <div class="border-r border-veenso-border px-5 py-4 text-veenso-muted">{{ $row['why'] ?? '' }}</div>
                            <div class="px-5 py-4 text-veenso-text/90">{{ $row['fix'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="grid gap-3 lg:hidden">
                    @foreach ($service->problem_matrix as $index => $row)
                        <div class="reveal rounded-xl border border-veenso-border bg-veenso-elevated/40 p-4" data-reveal-delay="{{ $index * 40 }}">
                            <p class="text-sm font-semibold text-veenso-text">{{ $row['problem'] ?? '' }}</p>
                            <p class="mt-2 text-xs text-veenso-muted"><span class="font-semibold text-veenso-text/70">Why:</span> {{ $row['why'] ?? '' }}</p>
                            <p class="mt-1 text-xs text-veenso-accent-light"><span class="font-semibold">Fix:</span> {{ $row['fix'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif (! empty($service->problems))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso flex flex-col gap-8">
                <x-section-heading eyebrow="The Problem" title="Common challenges we're brought in to solve" align="left" class="mx-0" />
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($service->problems as $index => $problem)
                        <div class="reveal flex items-start gap-3 rounded-xl border border-veenso-border bg-veenso-elevated/40 p-5" data-reveal-delay="{{ $index * 50 }}">
                            <x-icon name="check" class="mt-0.5 h-5 w-5 shrink-0 text-veenso-accent-light" />
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $problem }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- What you get --}}
    @if (! empty($service->benefits))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-8">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">What You Get — and Why It Matters</span>
                    <h2 class="font-display text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">What's included in this engagement</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($service->benefits as $index => $benefit)
                        <div class="reveal card-veenso flex flex-col gap-3 p-5 sm:p-6" data-reveal-delay="{{ $index * 50 }}">
                            <x-icon name="check" class="h-5 w-5 text-veenso-accent-light" />
                            <h3 class="font-sans text-base font-semibold text-veenso-text">{{ $benefit['title'] ?? '' }}</h3>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $benefit['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Deliverables + gains --}}
    @if (! empty($service->deliverables) || ! empty($service->gains))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso grid gap-8 lg:grid-cols-2">
                @if (! empty($service->deliverables))
                    <div class="reveal flex flex-col gap-4">
                        <span class="eyebrow">Exactly What You'll Receive</span>
                        <ul class="flex flex-col gap-2.5">
                            @foreach ($service->deliverables as $item)
                                <li class="flex gap-2.5 text-sm text-veenso-text/90">
                                    <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-veenso-accent-light" />
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (! empty($service->gains))
                    <div class="reveal flex flex-col gap-4" data-reveal-delay="60">
                        <span class="eyebrow">What You Gain</span>
                        <ul class="flex flex-col gap-2.5">
                            @foreach ($service->gains as $item)
                                <li class="flex gap-2.5 text-sm text-veenso-text/90">
                                    <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-veenso-accent-light" />
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Tools --}}
    @if (! empty($service->tools))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-6">
                <x-section-heading eyebrow="Tools & Technology" title="Tools & technology we use" align="left" class="mx-0" />
                <div class="reveal flex flex-wrap gap-2.5">
                    @foreach ($service->tools as $tool)
                        <span class="tag-veenso">{{ $tool }}</span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Before / after --}}
    @if (! empty($service->metrics_table))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso flex flex-col gap-6">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">Illustrative Before / After</span>
                    <h2 class="font-display text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">Typical improvement patterns</h2>
                </div>
                <div class="reveal overflow-x-auto rounded-2xl border border-veenso-border">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-veenso-elevated/80 text-xs uppercase tracking-widest text-veenso-muted">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Metric</th>
                                <th class="px-4 py-3 font-semibold">Before</th>
                                <th class="px-4 py-3 font-semibold text-veenso-accent-light">After</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service->metrics_table as $row)
                                <tr class="border-t border-veenso-border">
                                    <td class="px-4 py-3 text-veenso-text">{{ $row['metric'] ?? '' }}</td>
                                    <td class="px-4 py-3 text-veenso-muted">{{ $row['before'] ?? '' }}</td>
                                    <td class="px-4 py-3 text-veenso-text/90">{{ $row['after'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="reveal text-xs text-veenso-muted">*Ranges are illustrative examples of typical improvement patterns, not guaranteed or verified figures.</p>
            </div>
        </section>
    @endif

    {{-- Process --}}
    @if (! empty($service->process_steps))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-8">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">The Veenso Growth Framework</span>
                    <h2 class="font-display text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">Our process for {{ $service->title }}</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($service->process_steps as $index => $step)
                        <div class="reveal card-veenso flex flex-col gap-3 p-5" data-reveal-delay="{{ $index * 60 }}">
                            <span class="font-sans text-sm font-semibold text-veenso-accent-light">0{{ $step['step'] ?? ($index + 1) }}</span>
                            <h3 class="font-sans text-lg font-semibold text-veenso-text">{{ $step['title'] ?? '' }}</h3>
                            <p class="whitespace-pre-line text-sm leading-relaxed text-veenso-muted">{{ $step['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Audiences --}}
    @if (! empty($service->audiences))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso flex flex-col gap-8">
                <x-section-heading eyebrow="Who This Is For" title="Industries and business types we support" align="left" class="mx-0" />
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($service->audiences as $index => $audience)
                        <div class="reveal rounded-2xl border border-veenso-border bg-veenso-elevated/40 p-5" data-reveal-delay="{{ $index * 50 }}">
                            <h3 class="font-sans text-base font-semibold text-veenso-text">{{ $audience['title'] ?? '' }}</h3>
                            @if (! empty($audience['items']))
                                <ul class="mt-3 flex flex-col gap-1.5 text-sm text-veenso-muted">
                                    @foreach ($audience['items'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Ideal + why choose --}}
    @if (! empty($service->ideal_clients) || ! empty($service->why_choose))
        <section class="section-y">
            <div class="container-veenso grid gap-8 lg:grid-cols-2">
                @if (! empty($service->ideal_clients))
                    <div class="reveal flex flex-col gap-4">
                        <span class="eyebrow">Ideal If You…</span>
                        <ul class="flex flex-col gap-2.5">
                            @foreach ($service->ideal_clients as $item)
                                <li class="flex gap-2.5 text-sm text-veenso-text/90">
                                    <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-veenso-accent-light" />
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (! empty($service->why_choose))
                    <div class="reveal flex flex-col gap-4" data-reveal-delay="60">
                        <span class="eyebrow">Why Clients Choose Veenso</span>
                        <div class="flex flex-col gap-3">
                            @foreach ($service->why_choose as $item)
                                <div class="rounded-xl border border-veenso-border bg-veenso-elevated/40 p-4">
                                    <h3 class="font-sans text-sm font-semibold text-veenso-text">{{ $item['title'] ?? '' }}</h3>
                                    <p class="mt-1 text-sm text-veenso-muted">{{ $item['description'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Comparison --}}
    @if (! empty($service->comparison))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso flex flex-col gap-8">
                <x-section-heading eyebrow="Veenso vs. a Typical Agency" title="What changes when strategy comes first" align="left" class="mx-0" />
                <div class="grid gap-3">
                    @foreach ($service->comparison as $index => $row)
                        <div class="reveal grid gap-3 rounded-xl border border-veenso-border bg-veenso-elevated/30 p-4 sm:grid-cols-2" data-reveal-delay="{{ $index * 40 }}">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-widest text-veenso-muted">Typical Agency</p>
                                <p class="mt-1 text-sm text-veenso-muted">{{ $row['typical'] ?? '' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-widest text-veenso-accent-light">Veenso</p>
                                <p class="mt-1 text-sm text-veenso-text">{{ $row['veenso'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Packages --}}
    @if (! empty($service->packages))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-8">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">Engagement Options</span>
                    <h2 class="font-display text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">Every engagement is tailored to your goals</h2>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach ($service->packages as $index => $package)
                        <div class="reveal card-veenso flex flex-col gap-3 p-6" data-reveal-delay="{{ $index * 60 }}">
                            <h3 class="font-sans text-lg font-semibold text-veenso-text">{{ $package['title'] ?? '' }}</h3>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $package['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
                <p class="reveal text-xs text-veenso-muted">*Contact Veenso to discuss which engagement option fits your goals and budget.</p>
            </div>
        </section>
    @endif

    {{-- FAQs --}}
    @if (! empty($service->faqs))
        <section class="section-y bg-veenso-charcoal/35">
            <div class="container-veenso flex max-w-3xl flex-col gap-6">
                <x-section-heading eyebrow="FAQ" title="Frequently asked questions" align="left" class="mx-0" />
                <div class="flex flex-col gap-3">
                    @foreach ($service->faqs as $index => $faq)
                        <details class="reveal group rounded-xl border border-veenso-border bg-veenso-elevated/40 p-4" data-reveal-delay="{{ $index * 40 }}">
                            <summary class="cursor-pointer list-none font-sans text-sm font-semibold text-veenso-text">{{ $faq['question'] ?? '' }}</summary>
                            <p class="mt-3 text-sm leading-relaxed text-veenso-muted">{{ $faq['answer'] ?? '' }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Related service buttons (always image cards when other services exist) --}}
    @if ($relatedServices->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-6 sm:gap-8">
                <div class="reveal flex flex-col gap-2">
                    <span class="eyebrow">Related Services</span>
                    <h2 class="font-display text-2xl font-bold tracking-tight text-veenso-text sm:text-3xl">Explore more ways we can help</h2>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:gap-5">
                    @foreach ($relatedServices as $index => $related)
                        <x-service-card :service="$related" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-y pt-0">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-[1.25rem] bg-gradient-to-br from-veenso-accent via-veenso-accent-dark to-[#4c1d95] px-5 py-10 text-center sm:rounded-[1.75rem] sm:px-8 sm:py-14">
                <div class="relative z-10 flex flex-col items-center gap-4">
                    <h2 class="max-w-xl font-display text-2xl font-bold text-white sm:text-3xl">Ready for results with {{ $service->title }}?</h2>
                    <div class="flex w-full max-w-xl flex-col gap-3 sm:flex-row sm:justify-center">
                        <a href="{{ $primaryCta }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-veenso-accent-dark transition hover:bg-white/90">
                            {{ $service->cta_text ?: 'Book Your Free Growth Strategy Session' }} →
                        </a>
                        @if ($service->secondary_cta_text)
                            <a href="{{ $secondaryCta }}" class="inline-flex items-center justify-center rounded-full border border-white/40 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                                {{ $service->secondary_cta_text }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
