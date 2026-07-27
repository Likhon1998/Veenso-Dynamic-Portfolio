@extends('layouts.public')

@section('title', ($page->meta_title ?: $page->title . ' | Veenso'))
@section('meta_description', ($page->meta_description ?: $page->title))

@php
    $htmlContent = \Illuminate\Support\Str::markdown((string) $page->content);
@endphp

@section('content')

    <section class="page-hero">
        <div class="pointer-events-none absolute inset-0">
            <div class="glow-orb left-1/2 top-[-14rem] h-[28rem] w-[28rem] -translate-x-1/2 opacity-40"></div>
        </div>
        <div class="container-veenso relative z-10 flex flex-col items-center gap-5 text-center">
            <span class="eyebrow">{{ $page->title }}</span>
            <h1 class="font-display max-w-3xl text-3xl font-bold leading-snug tracking-tight text-veenso-text sm:text-4xl">
                {{ $page->hero_headline ?: $page->title }}
            </h1>
            @if ($page->hero_subheadline)
                <p class="max-w-xl text-sm sm:text-base leading-relaxed text-veenso-muted">{{ $page->hero_subheadline }}</p>
            @endif
        </div>
    </section>

    <section class="section-y pt-0 pb-32">
        <div class="container-veenso">
            <div class="reveal prose-veenso mx-auto max-w-3xl">
                {!! $htmlContent !!}
            </div>
        </div>
    </section>

@endsection
