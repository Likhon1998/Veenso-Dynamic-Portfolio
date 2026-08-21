<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', $siteSettings['meta_title'] ?? ($siteSettings['site_name'] . ' — Strategy-First Digital Growth Agency'))</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['meta_description'] ?? $siteSettings['tagline'])">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] }}">
    <meta property="og:title" content="@yield('title', $siteSettings['site_name'])">
    <meta property="og:description" content="@yield('meta_description', $siteSettings['tagline'])">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    @yield('meta')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%2307070b'/%3E%3Ctext x='16' y='22' font-family='sans-serif' font-size='18' font-weight='700' fill='%238b5cf6' text-anchor='middle'%3EV%3C/text%3E%3C/svg%3E">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-veenso-bg text-veenso-text font-sans antialiased selection:bg-veenso-accent selection:text-white">

    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-veenso-accent focus:px-4 focus:py-2 focus:text-sm focus:text-white">
        Skip to content
    </a>

    <header data-site-header class="site-header fixed inset-x-0 top-0 z-50">
        <div class="container-veenso flex h-16 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                @if (!empty($siteSettings['brand_logo']))
                    <img src="{{ media_url($siteSettings['brand_logo']) }}" alt="{{ $siteSettings['site_name'] }}" class="h-8 w-auto max-w-[9.5rem] object-contain sm:h-9">
                @else
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-veenso-accent to-veenso-accent-dark text-sm font-bold text-white shadow-glow-sm">{{ strtoupper(substr($siteSettings['site_name'] ?? 'V', 0, 1)) }}</span>
                    <span class="font-display text-lg font-bold tracking-tight text-veenso-text">{{ $siteSettings['site_name'] }}</span>
                @endif
            </a>

            <nav class="hidden items-center gap-6 lg:flex">
                <a href="{{ route('home') }}" class="nav-link @if(request()->routeIs('home')) is-active @endif">Home</a>
                <a href="{{ route('about') }}" class="nav-link @if(request()->routeIs('about')) is-active @endif">About</a>
                <a href="{{ route('services.index') }}" class="nav-link @if(request()->routeIs('services.*')) is-active @endif">Services</a>
                <a href="{{ route('case-studies.index') }}" class="nav-link @if(request()->routeIs('case-studies.*')) is-active @endif">Case Study</a>
                <a href="{{ route('portfolio.index') }}" class="nav-link @if(request()->routeIs('portfolio.*')) is-active @endif">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="nav-link @if(request()->routeIs('blog.*')) is-active @endif">Blog</a>
                <a href="{{ route('contact') }}" class="nav-link @if(request()->routeIs('contact')) is-active @endif">Contact</a>
            </nav>

            <div class="hidden lg:block">
                <x-button :href="route('contact')" variant="primary" size="sm">{{ $siteSettings['header_cta_text'] ?? 'Book a Call' }}</x-button>
            </div>

            <button type="button" data-nav-toggle aria-expanded="false" aria-label="Toggle navigation menu" class="flex h-10 w-10 items-center justify-center rounded-lg border border-veenso-border text-veenso-text lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
            </button>
        </div>

        <div data-nav-menu class="border-t border-veenso-border bg-veenso-bg/95 backdrop-blur lg:hidden">
            <nav class="container-veenso flex flex-col gap-1 py-4">
                <a href="{{ route('home') }}" class="nav-link py-2.5 @if(request()->routeIs('home')) is-active @endif">Home</a>
                <a href="{{ route('about') }}" class="nav-link py-2.5 @if(request()->routeIs('about')) is-active @endif">About</a>
                <a href="{{ route('services.index') }}" class="nav-link py-2.5 @if(request()->routeIs('services.*')) is-active @endif">Services</a>
                <a href="{{ route('case-studies.index') }}" class="nav-link py-2.5 @if(request()->routeIs('case-studies.*')) is-active @endif">Case Study</a>
                <a href="{{ route('portfolio.index') }}" class="nav-link py-2.5 @if(request()->routeIs('portfolio.*')) is-active @endif">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="nav-link py-2.5 @if(request()->routeIs('blog.*')) is-active @endif">Blog</a>
                <a href="{{ route('contact') }}" class="nav-link py-2.5 @if(request()->routeIs('contact')) is-active @endif">Contact</a>
                <x-button :href="route('contact')" variant="primary" size="sm" class="mt-3 w-full">{{ $siteSettings['header_cta_text'] ?? 'Book a Call' }}</x-button>
            </nav>
        </div>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="glow-orb -left-32 -top-32 h-72 w-72 opacity-30"></div>

        <div class="container-veenso relative z-10">
            <div class="site-footer-grid">
                <div class="site-footer-brand">
                    <a href="{{ route('home') }}" class="inline-flex items-center">
                        @if (!empty($siteSettings['brand_logo']))
                            <img src="{{ media_url($siteSettings['brand_logo']) }}" alt="{{ $siteSettings['site_name'] }}" class="h-8 w-auto max-w-[9.5rem] object-contain">
                        @else
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-veenso-accent to-veenso-accent-dark text-sm font-bold text-white">{{ strtoupper(substr($siteSettings['site_name'] ?? 'V', 0, 1)) }}</span>
                            <span class="ml-2 font-display text-lg font-bold text-veenso-text">{{ $siteSettings['site_name'] }}</span>
                        @endif
                    </a>
                    <p class="site-footer-brand__text">
                        {{ $siteSettings['footer_text'] }}
                    </p>
                    <div class="site-footer-socials">
                        @foreach (['social_linkedin' => 'in', 'social_twitter' => 'X', 'social_instagram' => 'ig'] as $key => $label)
                            @if ($siteSettings[$key])
                                <a href="{{ $siteSettings[$key] }}" target="_blank" rel="noopener" aria-label="{{ $label }}">{{ $label }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="site-footer-col">
                    <h4>Explore</h4>
                    <ul>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('case-studies.index') }}">Case Study</a></li>
                        <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="site-footer-col">
                    <h4>Services</h4>
                    <ul>
                        @forelse ($footerServices as $footerService)
                            <li>
                                <a href="{{ route('services.show', $footerService) }}">{{ $footerService->title }}</a>
                            </li>
                        @empty
                            <li><a href="{{ route('services.index') }}">All Services</a></li>
                        @endforelse
                    </ul>
                </div>

                <div class="site-footer-col">
                    <h4>Important Policies</h4>
                    <ul>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                        @if ($siteSettings['email'])
                            <li><a href="mailto:{{ $siteSettings['email'] }}">{{ $siteSettings['email'] }}</a></li>
                        @endif
                        @if ($siteSettings['phone'])
                            <li><a href="tel:{{ $siteSettings['phone'] }}">{{ $siteSettings['phone'] }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="site-footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $siteSettings['site_name'] }}. All rights reserved.</p>
                <div class="site-footer-bottom__links">
                    <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    <a href="{{ route('terms') }}">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
