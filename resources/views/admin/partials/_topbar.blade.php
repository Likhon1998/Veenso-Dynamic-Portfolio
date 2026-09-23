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
        <details class="topbar-dropdown notif-menu">
            <summary class="icon-btn" aria-label="Notifications">
                @include('admin.partials.icon', ['name' => 'bell'])
                @if (($unreadMessagesCount ?? 0) > 0)
                    <span class="dot"></span>
                @endif
            </summary>
            <div class="topbar-panel notif-panel">
                <div class="topbar-panel-head">
                    <strong>Notifications</strong>
                    @if (($unreadMessagesCount ?? 0) > 0)
                        <span class="notif-count">{{ $unreadMessagesCount }} unread</span>
                    @endif
                </div>
                <div class="notif-list">
                    @forelse (($recentAdminMessages ?? collect()) as $msg)
                        <a href="{{ route('admin.contact-messages.show', $msg) }}" class="notif-item {{ $msg->status === 'unread' ? 'is-unread' : '' }}">
                            <span class="notif-item-title">{{ $msg->name }}</span>
                            <span class="notif-item-preview">{{ \Illuminate\Support\Str::limit($msg->subject ?: $msg->message, 64) }}</span>
                            <span class="notif-item-time">{{ $msg->created_at?->diffForHumans() }}</span>
                        </a>
                    @empty
                        <p class="notif-empty">No contact messages yet.</p>
                    @endforelse
                </div>
                <a href="{{ route('admin.contact-messages.index') }}" class="topbar-panel-footer">View all messages</a>
            </div>
        </details>

        <details class="topbar-dropdown user-menu">
            <summary class="user-chip" aria-label="Account menu">
                <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                <span class="user-meta">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <small>Administrator</small>
                </span>
                <span class="user-caret" aria-hidden="true">
                    @include('admin.partials.icon', ['name' => 'chevron'])
                </span>
            </summary>
            <div class="topbar-panel user-panel">
                <div class="topbar-panel-head">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <small>{{ auth()->user()->email ?? '' }}</small>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="topbar-panel-link">Dashboard</a>
                <a href="{{ route('admin.settings.edit') }}" class="topbar-panel-link">Site Settings</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="topbar-panel-logout">
                        @include('admin.partials.icon', ['name' => 'logout'])
                        <span>Log out</span>
                    </button>
                </form>
            </div>
        </details>
    </div>
</header>

<script>
document.querySelectorAll('.topbar-dropdown').forEach(function (menu) {
    menu.addEventListener('toggle', function () {
        if (!menu.open) return;
        document.querySelectorAll('.topbar-dropdown').forEach(function (other) {
            if (other !== menu) other.open = false;
        });
    });
});
</script>
