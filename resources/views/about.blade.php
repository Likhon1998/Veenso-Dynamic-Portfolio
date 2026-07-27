@extends('layouts.public')

@section('title', ($page?->meta_title ?: ($page?->title ?: $siteSettings['site_name'])))
@section('meta_description', ($page?->meta_description ?: ($siteSettings['meta_description'] ?? '')))

@php
    $htmlContent = \Illuminate\Support\Str::markdown((string) ($page?->content ?? ''));
    $valuesBlock = collect($page?->content_blocks ?? [])->firstWhere('type', 'values');
    $teamBlock = collect($page?->content_blocks ?? [])->firstWhere('type', 'team');
    $voicesBlock = collect($page?->content_blocks ?? [])->firstWhere('type', 'testimonials');
    $ctaBlock = collect($page?->content_blocks ?? [])->firstWhere('type', 'cta');
@endphp

@section('content')

    <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
        </div>
        <div class="container-veenso relative z-10 flex flex-col items-center gap-3 text-center">
            <span class="eyebrow">{{ $page?->title ?: $siteSettings['site_name'] }}</span>
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
        <div class="container-veenso grid gap-10 lg:grid-cols-[1fr_320px]">
            <div class="reveal prose-veenso max-w-none">
                {!! $htmlContent !!}
            </div>

            @if ($valuesBlock)
                <div class="reveal card-veenso flex flex-col gap-5 p-8" data-reveal-delay="100">
                    <span class="eyebrow">Our Values</span>
                    <ul class="flex flex-col gap-4">
                        @foreach ($valuesBlock['items'] as $value)
                            <li class="flex items-start gap-3 text-sm leading-relaxed text-veenso-text/90">
                                <x-icon name="check" class="mt-0.5 h-4 w-4 flex-shrink-0 text-veenso-accent-light" />
                                {{ $value }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    <section class="section-y bg-veenso-charcoal/40">
        <div class="container-veenso grid grid-cols-2 gap-10 lg:grid-cols-4">
            @foreach ($stats as $index => $stat)
                <x-stat :value="$stat['value']" :label="$stat['label']" data-reveal-delay="{{ $index * 100 }}" />
            @endforeach
        </div>
    </section>

    @if ($teamMembers->isNotEmpty())
        <section class="section-y">
            <div class="container-veenso section-stack">
                <x-section-heading
                    :eyebrow="$teamBlock['eyebrow'] ?? 'Our Team'"
                    :title="$teamBlock['title'] ?? 'The people behind the strategy'"
                />
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($teamMembers as $index => $member)
                        <div class="reveal card-veenso flex flex-col gap-4 p-7" data-reveal-delay="{{ $index * 80 }}">
                            <x-media :src="$member->photo" :alt="$member->name" ratio="aspect-square" icon-name="sparkles" class="w-24 !rounded-full" />
                            <div>
                                <h3 class="font-display text-base font-semibold text-veenso-text">{{ $member->name }}</h3>
                                <p class="text-sm text-veenso-accent-light">{{ $member->role }}</p>
                            </div>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $member->bio }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($testimonials->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso section-stack">
                <x-section-heading
                    :eyebrow="$voicesBlock['eyebrow'] ?? 'Client Voices'"
                    :title="$voicesBlock['title'] ?? 'What it\'s like to work with us'"
                />
                <div class="grid gap-6 lg:grid-cols-3">
                    @foreach ($testimonials as $index => $testimonial)
                        <x-testimonial-card :testimonial="$testimonial" :index="$index" />
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
                    <h2 class="font-display max-w-xl text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">
                        {{ $ctaBlock['title'] ?? ($siteSettings['home_cta_title'] ?? 'Let\'s build your growth system') }}
                    </h2>
                    <x-button :href="route('contact')" variant="primary" glow>
                        {{ $ctaBlock['button'] ?? ($siteSettings['header_cta_text'] ?? 'Book a Strategy Call') }}
                    </x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
