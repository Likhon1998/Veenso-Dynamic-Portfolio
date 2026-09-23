@extends('layouts.public')

@section('title', ($blogPost->meta_title ?: $blogPost->title . ' | Veenso'))
@section('meta_description', $blogPost->meta_description ?: $blogPost->excerpt)

@php
    $htmlContent = \Illuminate\Support\Str::markdown((string) $blogPost->content);
@endphp

@section('content')

    <article>
        <section class="page-hero pb-8 sm:pb-10">
            <div class="pointer-events-none absolute inset-0">
                <div class="glow-orb left-1/2 top-[-14rem] h-[32rem] w-[32rem] -translate-x-1/2 opacity-50"></div>
            </div>
            <div class="container-veenso relative z-10 flex min-w-0 flex-col gap-6 sm:gap-8">
                <a href="{{ route('blog.index') }}" class="reveal inline-flex items-center gap-2 text-sm font-semibold text-veenso-muted transition-colors hover:text-veenso-accent-light">
                    <x-icon name="arrow-right" class="h-4 w-4 rotate-180" /> All Articles
                </a>

                <div class="reveal flex min-w-0 flex-col gap-4 sm:gap-6" data-reveal-delay="60">
                    <div class="flex flex-wrap items-center gap-2 text-sm text-veenso-muted sm:gap-3">
                        @if ($blogPost->category)
                            <span class="tag-veenso">{{ $blogPost->category }}</span>
                        @endif
                        @if ($blogPost->author)
                            <span>{{ $blogPost->author }}</span>
                        @endif
                        @if ($blogPost->published_at)
                            <span>&middot;</span>
                            <span>{{ $blogPost->published_at->format('F j, Y') }}</span>
                        @endif
                    </div>
                    <h1 class="font-display max-w-3xl text-2xl font-bold leading-snug tracking-tight break-words text-veenso-text sm:text-3xl lg:text-4xl">{{ $blogPost->title }}</h1>
                    @if ($blogPost->excerpt)
                        <p class="max-w-xl text-sm leading-relaxed text-veenso-muted sm:text-base">{{ $blogPost->excerpt }}</p>
                    @endif
                </div>

                <x-media :src="$blogPost->featured_image" :alt="$blogPost->title" ratio="aspect-[16/10]" icon-name="sparkles" loading="eager" fetchpriority="high" class="reveal w-full min-w-0" data-reveal-delay="120" />
            </div>
        </section>

        <section class="section-y pt-0">
            <div class="container-veenso grid min-w-0 gap-8 lg:grid-cols-[minmax(0,1fr)_280px]">
                <div class="prose-veenso min-w-0 max-w-none">
                    {!! $htmlContent !!}

                    @if ($blogPost->images->isNotEmpty())
                        <div class="not-prose mt-10 flex flex-col gap-6 sm:mt-12 sm:gap-8">
                            @foreach ($blogPost->images as $index => $image)
                                <figure class="flex min-w-0 flex-col gap-3">
                                    <div class="overflow-hidden rounded-xl border border-veenso-border bg-veenso-elevated/30 sm:rounded-2xl">
                                        <img
                                            src="{{ media_url($image->path) }}"
                                            alt="{{ $image->alt ?: $blogPost->title }}"
                                            class="h-auto w-full max-w-full object-contain"
                                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                        >
                                    </div>
                                    @if ($image->caption || $image->alt)
                                        <figcaption class="text-sm text-veenso-muted">{{ $image->caption ?: $image->alt }}</figcaption>
                                    @endif
                                </figure>
                            @endforeach
                        </div>
                    @endif
                </div>

                <aside class="reveal flex min-w-0 flex-col gap-6 lg:sticky lg:top-24 lg:self-start" data-reveal-delay="100">
                    @if (!empty($blogPost->tags))
                        <div class="card-veenso flex flex-col gap-4 p-5 sm:p-6">
                            <span class="eyebrow">Tags</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($blogPost->tags as $tag)
                                    <span class="tag-veenso">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="card-veenso flex flex-col gap-4 p-5 sm:p-6">
                        <span class="eyebrow">{{ $siteSettings['home_cta_eyebrow'] ?? 'Ready to grow?' }}</span>
                        <p class="text-sm leading-relaxed text-veenso-muted">{{ $siteSettings['home_cta_subtitle'] ?? 'Book a strategy call and see how we can turn this into results for your brand.' }}</p>
                        <x-button :href="route('contact')" variant="primary" class="w-full">{{ $siteSettings['home_cta_button'] ?? ($siteSettings['header_cta_text'] ?? 'Book a Call') }}</x-button>
                    </div>
                </aside>
            </div>
        </section>
    </article>

    @if ($relatedPosts->isNotEmpty())
        <section class="section-y bg-veenso-charcoal/40">
            <div class="container-veenso flex flex-col gap-8 sm:gap-12">
                <x-section-heading eyebrow="Keep Reading" :title="'More insights from ' . ($siteSettings['site_name'] ?? 'us')" />
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedPosts as $index => $related)
                        <x-blog-card :post="$related" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
