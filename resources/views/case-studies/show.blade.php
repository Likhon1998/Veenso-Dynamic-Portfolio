@extends('layouts.public')

@section('title', ($caseStudy->meta_title ?: $caseStudy->title . ' | Veenso'))
@section('meta_description', $caseStudy->meta_description ?: $caseStudy->excerpt)

@section('content')

    <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
        </div>
        <div class="container-veenso relative z-10 flex flex-col gap-8">
            <a href="{{ route('case-studies.index') }}" class="reveal inline-flex items-center gap-2 text-sm font-semibold text-veenso-muted transition-colors hover:text-veenso-accent-light">
                <x-icon name="arrow-right" class="h-4 w-4 rotate-180" /> All Case Studies
            </a>

            <div class="reveal flex flex-col gap-6" data-reveal-delay="60">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="tag-veenso">{{ $caseStudy->service_category }}</span>
                    @if ($caseStudy->client_name)
                        <span class="text-sm text-veenso-muted">Client: {{ $caseStudy->client_name }}</span>
                    @endif
                </div>
                <h1 class="font-display max-w-4xl text-2xl font-bold leading-snug tracking-tight text-veenso-text sm:text-3xl lg:text-4xl">{{ $caseStudy->title }}</h1>
                <p class="max-w-xl text-sm sm:text-base leading-relaxed text-veenso-muted">{{ $caseStudy->excerpt }}</p>
            </div>

            <x-media :src="$caseStudy->featured_image" :alt="$caseStudy->title" ratio="aspect-[16/8]" icon-name="target" class="reveal" data-reveal-delay="120" />
        </div>
    </section>

    @if (!empty($caseStudy->stats))
        <section class="pb-4">
            <div class="container-veenso">
                <div class="reveal grid grid-cols-2 gap-8 rounded-2xl border border-veenso-border bg-veenso-elevated/40 p-8 lg:grid-cols-4">
                    @foreach ($caseStudy->stats as $index => $stat)
                        <x-stat :value="$stat['value']" :label="$stat['label']" data-reveal-delay="{{ $index * 80 }}" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-y">
        <div class="container-veenso grid gap-10 lg:grid-cols-2">
            <div class="reveal card-veenso flex flex-col gap-4 p-8">
                <span class="eyebrow">The Challenge</span>
                <p class="whitespace-pre-line leading-relaxed text-veenso-text/90">{{ $caseStudy->challenge }}</p>
            </div>
            <div class="reveal card-veenso flex flex-col gap-4 p-8" data-reveal-delay="80">
                <span class="eyebrow">The Strategy</span>
                <p class="whitespace-pre-line leading-relaxed text-veenso-text/90">{{ $caseStudy->strategy }}</p>
            </div>
            <div class="reveal card-veenso flex flex-col gap-4 p-8" data-reveal-delay="160">
                <span class="eyebrow">Implementation</span>
                <p class="whitespace-pre-line leading-relaxed text-veenso-text/90">{{ $caseStudy->implementation }}</p>
            </div>
            <div class="reveal card-veenso flex flex-col gap-4 border-veenso-accent/30 p-8" data-reveal-delay="240">
                <span class="eyebrow">The Results</span>
                <p class="whitespace-pre-line leading-relaxed text-veenso-text/90">{{ $caseStudy->results }}</p>
            </div>
        </div>
    </section>

    @if ($relatedCaseStudies->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-12">
                <x-section-heading eyebrow="More Results" title="Related case studies" />
                <div class="flex flex-col gap-10">
                    @foreach ($relatedCaseStudies as $index => $related)
                        <x-case-study-card :case-study="$related" :index="$index" />
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
                    <h2 class="font-display max-w-xl text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">Let&rsquo;s write your growth story next</h2>
                    <x-button :href="route('contact')" variant="primary" glow>Book a Strategy Call</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
