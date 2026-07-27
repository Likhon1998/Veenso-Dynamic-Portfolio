@extends('layouts.public')

@section('title', ($service->meta_title ?: $service->title . ' | Veenso'))
@section('meta_description', $service->meta_description ?: $service->summary)

@php
    $descriptionParagraphs = array_values(array_filter(explode("\n\n", (string) $service->description)));
@endphp

@section('content')

    {{-- Hero --}}
    <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
        </div>
        <div class="container-veenso relative z-10 grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="reveal flex flex-col gap-6">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-veenso-muted transition-colors hover:text-veenso-accent-light">
                    <x-icon name="arrow-right" class="h-4 w-4 rotate-180" /> All Services
                </a>
                <span class="eyebrow">{{ $service->is_primary ? 'Core Service' : 'Specialized Service' }}</span>
                <h1 class="font-display text-3xl font-bold leading-snug tracking-tight text-veenso-text sm:text-4xl">{{ $service->title }}</h1>
                <p class="max-w-xl text-lg leading-relaxed text-veenso-muted">{{ $service->summary }}</p>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <x-button :href="$service->cta_url ?: route('contact')" variant="primary" glow>{{ $service->cta_text ?: 'Get Started' }}</x-button>
                    <x-button :href="route('contact')" variant="secondary">Talk to Our Team</x-button>
                </div>
            </div>

            <x-media :src="$service->featured_image" :alt="$service->title" :icon-name="$service->icon" ratio="aspect-[4/3]" class="reveal" data-reveal-delay="120" />
        </div>
    </section>

    {{-- What it is / Why it matters --}}
    <section class="section-y pt-0">
        <div class="container-veenso grid gap-10 lg:grid-cols-2">
            <div class="reveal card-veenso flex flex-col gap-4 p-8">
                <span class="eyebrow">What It Is</span>
                <p class="leading-relaxed text-veenso-text/90">{{ $descriptionParagraphs[0] ?? $service->summary }}</p>
            </div>
            <div class="reveal card-veenso flex flex-col gap-4 p-8" data-reveal-delay="100">
                <span class="eyebrow">Why It Matters</span>
                <p class="leading-relaxed text-veenso-text/90">{{ $descriptionParagraphs[1] ?? $service->summary }}</p>
            </div>
        </div>
    </section>

    {{-- Problems --}}
    @if (!empty($service->problems))
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="The Problem" title="Common challenges we're brought in to solve" align="left" class="mx-0" />
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($service->problems as $index => $problem)
                        <div class="reveal flex items-start gap-3 rounded-xl border border-veenso-border bg-veenso-elevated/40 p-5" data-reveal-delay="{{ $index * 60 }}">
                            <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-veenso-accent/15 text-veenso-accent-light">
                                <svg viewBox="0 0 8 8" class="h-2 w-2 fill-current"><circle cx="4" cy="4" r="4"/></svg>
                            </span>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $problem }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- What you get (benefits) --}}
    @if (!empty($service->benefits))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="What You Get" title="What's included in this engagement" align="left" class="mx-0" />
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($service->benefits as $index => $benefit)
                        <div class="reveal card-veenso flex flex-col gap-3 p-7" data-reveal-delay="{{ $index * 80 }}">
                            <x-icon name="check" class="h-6 w-6 text-veenso-accent-light" />
                            <h3 class="font-display text-base font-semibold text-veenso-text">{{ $benefit['title'] }}</h3>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $benefit['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Tools --}}
    @if (!empty($service->tools))
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-10">
                <x-section-heading eyebrow="Our Stack" title="Tools and platforms we work with" align="left" class="mx-0" />
                <div class="reveal flex flex-wrap gap-3">
                    @foreach ($service->tools as $tool)
                        <span class="tag-veenso">{{ $tool }}</span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Process --}}
    @if (!empty($service->process_steps))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="Our Process" title="How we approach this engagement" align="left" class="mx-0" />
                <div class="grid gap-6 lg:grid-cols-2">
                    @foreach ($service->process_steps as $index => $step)
                        <div class="reveal flex gap-5" data-reveal-delay="{{ $index * 80 }}">
                            <span class="step-marker">{{ $step['step'] ?? $index + 1 }}</span>
                            <div class="flex flex-col gap-1.5 pt-1">
                                <h3 class="font-display text-base font-semibold text-veenso-text">{{ $step['title'] }}</h3>
                                <p class="text-sm leading-relaxed text-veenso-muted">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Who for / Ideal clients --}}
    <section class="section-y bg-veenso-charcoal/40">
        <div class="container-veenso grid gap-10 lg:grid-cols-2">
            @if ($service->who_for)
                <div class="reveal card-veenso flex flex-col gap-4 p-8">
                    <span class="eyebrow">Who This Is For</span>
                    <p class="leading-relaxed text-veenso-text/90">{{ $service->who_for }}</p>
                </div>
            @endif

            @if (!empty($service->ideal_clients))
                <div class="reveal card-veenso flex flex-col gap-4 p-8" data-reveal-delay="100">
                    <span class="eyebrow">Ideal Clients</span>
                    <ul class="flex flex-col gap-3">
                        @foreach ($service->ideal_clients as $client)
                            <li class="flex items-start gap-3 text-sm leading-relaxed text-veenso-text/90">
                                <x-icon name="check" class="mt-0.5 h-4 w-4 flex-shrink-0 text-veenso-accent-light" />
                                {{ $client }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    {{-- Why choose --}}
    @if (!empty($service->why_choose))
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="Why Veenso" title="Why clients choose us for {{ $service->title }}" align="left" class="mx-0" />
                <div class="grid gap-6 sm:grid-cols-2">
                    @foreach ($service->why_choose as $index => $item)
                        <div class="reveal flex flex-col gap-2 rounded-2xl border border-veenso-border bg-veenso-elevated/40 p-6" data-reveal-delay="{{ $index * 80 }}">
                            <h3 class="font-display text-base font-semibold text-veenso-text">{{ $item['title'] }}</h3>
                            <p class="text-sm leading-relaxed text-veenso-muted">{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FAQ --}}
    @if (!empty($service->faqs))
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-8 lg:max-w-3xl">
                <x-section-heading eyebrow="FAQ" title="Common questions about {{ $service->title }}" align="left" class="mx-0" />
                <div>
                    @foreach ($service->faqs as $index => $faq)
                        <x-faq-item :question="$faq['question']" :answer="$faq['answer']" :open="$index === 0" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($service->related_notes)
        <section class="section-y pt-0">
            <div class="container-veenso">
                <div class="reveal rounded-2xl border border-veenso-border bg-veenso-elevated/40 p-6 text-sm text-veenso-muted">
                    <span class="font-semibold text-veenso-accent-light">Pairs well with: </span>{{ $service->related_notes }}
                </div>
            </div>
        </section>
    @endif

    {{-- Related services --}}
    @if ($relatedServices->isNotEmpty())
        <section class="section-y">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="Explore More" title="Related services" />
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedServices as $index => $related)
                        <x-service-card :service="$related" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="section-y pt-0">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-[2rem] border border-veenso-border bg-gradient-to-br from-veenso-elevated via-veenso-charcoal to-veenso-bg px-8 py-16 text-center lg:px-16">
                <div class="glow-orb left-1/2 top-0 h-72 w-72 -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center gap-6">
                    <h2 class="font-display max-w-xl text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">{{ $service->cta_text ?: 'Ready to get started?' }}</h2>
                    <p class="max-w-xl text-veenso-muted">Let&rsquo;s scope a plan tied to your goals — no generic packages, no guesswork.</p>
                    <x-button :href="$service->cta_url ?: route('contact')" variant="primary" glow>{{ $service->cta_text ?: 'Book a Strategy Call' }}</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
