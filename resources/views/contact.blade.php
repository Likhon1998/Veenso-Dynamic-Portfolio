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
        <div class="container-veenso grid gap-12 lg:grid-cols-[1fr_1.3fr]">
            <div class="reveal flex flex-col gap-8">
                <div class="card-veenso flex flex-col gap-6 p-8">
                    <span class="eyebrow">Contact Details</span>
                    <ul class="flex flex-col gap-5 text-sm">
                        @if ($email)
                            <li class="flex items-start gap-3">
                                <x-icon name="mail" class="mt-0.5 h-5 w-5 flex-shrink-0 text-veenso-accent-light" />
                                <div>
                                    <div class="text-veenso-muted">Email</div>
                                    <a href="mailto:{{ $email }}" class="font-medium text-veenso-text transition-colors hover:text-veenso-accent-light">{{ $email }}</a>
                                </div>
                            </li>
                        @endif
                        @if ($phone)
                            <li class="flex items-start gap-3">
                                <x-icon name="target" class="mt-0.5 h-5 w-5 flex-shrink-0 text-veenso-accent-light" />
                                <div>
                                    <div class="text-veenso-muted">Phone</div>
                                    <a href="tel:{{ $phone }}" class="font-medium text-veenso-text transition-colors hover:text-veenso-accent-light">{{ $phone }}</a>
                                </div>
                            </li>
                        @endif
                        @if ($address)
                            <li class="flex items-start gap-3">
                                <x-icon name="sparkles" class="mt-0.5 h-5 w-5 flex-shrink-0 text-veenso-accent-light" />
                                <div>
                                    <div class="text-veenso-muted">Office</div>
                                    <div class="font-medium leading-relaxed text-veenso-text">{{ $address }}</div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="card-veenso flex flex-col gap-3 p-8" data-reveal-delay="80">
                    <span class="eyebrow">Response Time</span>
                    <p class="text-sm leading-relaxed text-veenso-muted">We respond to every inquiry within one business day. For urgent requests, call us directly.</p>
                </div>
            </div>

            <div class="reveal card-veenso p-8 lg:p-10" data-reveal-delay="120">
                @if (session('success'))
                    <div class="mb-6 flex items-start gap-3 rounded-xl border border-veenso-accent/40 bg-veenso-accent/10 p-4 text-sm text-veenso-text">
                        <x-icon name="check" class="mt-0.5 h-5 w-5 flex-shrink-0 text-veenso-accent-light" />
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="flex flex-col gap-6">
                    @csrf

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-sm font-medium text-veenso-text">Full Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="input-veenso" placeholder="Jane Doe">
                            @error('name')
                                <span class="text-xs text-rose-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-medium text-veenso-text">Email Address *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="input-veenso" placeholder="jane@company.com">
                            @error('email')
                                <span class="text-xs text-rose-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="phone" class="text-sm font-medium text-veenso-text">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="input-veenso" placeholder="+1 (555) 000-0000">
                            @error('phone')
                                <span class="text-xs text-rose-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="subject" class="text-sm font-medium text-veenso-text">Service Interested In</label>
                            <select name="subject" id="subject" class="input-veenso">
                                <option value="">Select a service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->title }}" @selected(old('subject') === $service->title)>{{ $service->title }}</option>
                                @endforeach
                                <option value="Other" @selected(old('subject') === 'Other')>Other</option>
                            </select>
                            @error('subject')
                                <span class="text-xs text-rose-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="message" class="text-sm font-medium text-veenso-text">Tell us about your project *</label>
                        <textarea name="message" id="message" rows="6" required class="input-veenso resize-none" placeholder="What are you trying to achieve, and what does success look like?">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-xs text-rose-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <x-button type="submit" tag="button" variant="primary" glow class="self-start">
                        Send Message
                        <x-icon name="arrow-right" class="h-4 w-4" />
                    </x-button>
                </form>
            </div>
        </div>
    </section>

@endsection
