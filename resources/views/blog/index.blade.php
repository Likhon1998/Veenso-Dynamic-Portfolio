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

    <section class="section-y pt-0">
        <div class="container-veenso flex flex-col gap-10">
            @if ($categories->isNotEmpty())
                <div class="reveal flex flex-wrap justify-center gap-3">
                    <a href="{{ route('blog.index') }}" class="tag-veenso {{ !$activeCategory ? '!bg-veenso-accent/25' : '' }}">All</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category]) }}" class="tag-veenso {{ $activeCategory === $category ? '!bg-veenso-accent/25' : '' }}">{{ $category }}</a>
                    @endforeach
                </div>
            @endif

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($blogPosts as $index => $post)
                    <x-blog-card :post="$post" :index="$index" />
                @endforeach
            </div>

            @if ($blogPosts->isEmpty())
                <p class="reveal text-center text-veenso-muted">No articles in this category yet — check back soon.</p>
            @endif

            @if ($blogPosts->hasPages())
                <div class="reveal pt-4">
                    {{ $blogPosts->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection
