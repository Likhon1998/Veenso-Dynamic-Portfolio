<header class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" type="button" onclick="document.getElementById('sidebar').classList.toggle('is-open')" aria-label="Toggle menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <div class="search-box">
            @include('admin.partials.icon', ['name' => 'search'])
            <input type="search" placeholder="Search anything..." aria-label="Search">
            <kbd>⌘ K</kbd>
        </div>
    </div>

    <div class="topbar-right">
        <button type="button" class="icon-btn" aria-label="Notifications">
            @include('admin.partials.icon', ['name' => 'bell'])
            @if (($unreadMessagesCount ?? 0) > 0)
                <span class="dot"></span>
            @endif
        </button>

        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
            <span class="user-meta">
                <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                <small>Administrator</small>
            </span>
            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    @include('admin.partials.icon', ['name' => 'chevron'])
                </button>
            </form>
        </div>
    </div>
</header>
