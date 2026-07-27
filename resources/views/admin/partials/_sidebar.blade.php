<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            @if (! empty($adminBrandLogo))
                <img src="{{ media_url($adminBrandLogo) }}" alt="{{ $adminSiteName }}" class="h-8 w-auto max-w-[7.5rem] object-contain">
            @else
                <span class="brand-mark">{{ strtoupper(substr($adminSiteName ?? 'V', 0, 1)) }}</span>
                <span class="brand-copy">
                    <strong>{{ strtoupper($adminSiteName ?? 'VEENSO') }}</strong>
                    <small>GROWTH PARTNER</small>
                </span>
            @endif
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'home'])</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'pages'])</span>
            <span>Pages</span>
        </a>
        <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'services'])</span>
            <span>Services</span>
        </a>
        <a href="{{ route('admin.portfolio-items.index') }}" class="nav-link {{ request()->routeIs('admin.portfolio-items.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'portfolio'])</span>
            <span>Portfolio</span>
        </a>
        <a href="{{ route('admin.case-studies.index') }}" class="nav-link {{ request()->routeIs('admin.case-studies.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'case'])</span>
            <span>Case Studies</span>
        </a>
        <a href="{{ route('admin.blog-posts.index') }}" class="nav-link {{ request()->routeIs('admin.blog-posts.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'blog'])</span>
            <span>Blog Posts</span>
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'testimonial'])</span>
            <span>Testimonials</span>
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'faq'])</span>
            <span>FAQs</span>
        </a>
        <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'mail'])</span>
            <span>Contact Messages</span>
            @if (($unreadMessagesCount ?? 0) > 0)
                <span class="nav-badge">{{ $unreadMessagesCount > 99 ? '99+' : $unreadMessagesCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.team-members.index') }}" class="nav-link {{ request()->routeIs('admin.team-members.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'users'])</span>
            <span>Team</span>
        </a>
        <a href="{{ route('admin.client-logos.index') }}" class="nav-link {{ request()->routeIs('admin.client-logos.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'media'])</span>
            <span>Client Logos</span>
        </a>
        <a href="{{ route('admin.why-choose-items.index') }}" class="nav-link {{ request()->routeIs('admin.why-choose-items.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'star'])</span>
            <span>Why Choose</span>
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'is-active' : '' }}">
            <span class="nav-ico">@include('admin.partials.icon', ['name' => 'settings'])</span>
            <span>Site Settings</span>
        </a>
    </nav>
</aside>
