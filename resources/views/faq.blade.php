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

    <section class="section-y pt-0 pb-24">
        <div class="container-veenso mx-auto flex max-w-3xl flex-col gap-8">
            @forelse ($faqGroups as $category => $faqs)
                <div class="flex flex-col gap-2">
                    @if ($faqGroups->count() > 1)
                        <h2 class="reveal font-display text-xl font-semibold text-veenso-accent-light">{{ $category }}</h2>
                    @endif
                    <div>
                        @foreach ($faqs as $index => $faq)
                            <x-faq-item :question="$faq->question" :answer="$faq->answer" :open="$faqGroups->keys()->first() === $category && $index === 0" />
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="reveal rounded-2xl border border-dashed border-veenso-border bg-veenso-elevated/30 px-6 py-14 text-center">
                    <p class="font-display text-lg font-semibold text-veenso-text">No FAQs yet</p>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-veenso-muted">Questions and answers will appear here once they are published from the admin panel.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="section-y pt-0">
        <div class="container-veenso">
            <div class="reveal relative overflow-hidden rounded-[2rem] border border-veenso-border bg-gradient-to-br from-veenso-elevated via-veenso-charcoal to-veenso-bg px-8 py-16 text-center lg:px-16">
                <div class="glow-orb left-1/2 top-0 h-72 w-72 -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center gap-6">
                    <h2 class="font-display max-w-xl text-2xl font-bold leading-snug text-veenso-text sm:text-3xl">{{ $siteSettings['cta_faq_title'] }}</h2>
                    <p class="max-w-xl text-veenso-muted">{{ $siteSettings['cta_faq_text'] }}</p>
                    <x-button :href="route('contact')" variant="primary" glow>{{ $siteSettings['cta_faq_button'] }}</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
