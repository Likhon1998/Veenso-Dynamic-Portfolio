@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $firstName = explode(' ', $user->name ?? 'Admin')[0];
@endphp

<div class="dash-head">
    <div>
        <h1>Dashboard</h1>
        <p>Welcome back, {{ $firstName }}! Live numbers from your CMS database.</p>
    </div>
    <div class="dash-actions">
        <a href="{{ url('/') }}" target="_blank" class="btn btn-primary">
            Visit Website
            @include('admin.partials.icon', ['name' => 'external'])
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="btn btn-secondary">Site Settings</a>
    </div>
</div>

<div class="metric-grid">
    @foreach ($metricCards as $card)
        @php
            $spark = $card['spark'] ?: [1,1,1,1,1,1,1,1,1,1,1,1];
            $max = max($spark) ?: 1;
            $min = min($spark);
            $points = [];
            foreach ($spark as $i => $v) {
                $x = count($spark) > 1 ? ($i / (count($spark) - 1)) * 100 : 0;
                $y = 28 - (($v - $min) / max(1, ($max - $min))) * 22;
                $points[] = round($x, 2).','.round($y, 2);
            }
            $polyline = implode(' ', $points);
            $iconMap = [
                'mail' => 'mail',
                'folder' => 'portfolio',
                'doc' => 'blog',
                'cube' => 'services',
                'star' => 'testimonial',
                'users' => 'users',
            ];
        @endphp
        <a href="{{ $card['href'] }}" class="metric-card" style="text-decoration:none;color:inherit;">
            <div class="metric-top">
                <div class="metric-icon" style="color: {{ $card['color'] }}; background: {{ $card['color'] }}22;">
                    @include('admin.partials.icon', ['name' => $iconMap[$card['icon']] ?? 'pages'])
                </div>
            </div>
            <div class="metric-label">{{ $card['label'] }}</div>
            <div class="metric-value">{{ $card['value'] }}</div>
            <div class="metric-change {{ ($card['change'] ?? 0) < 0 ? 'down' : '' }}">
                @if ($card['change'] !== null)
                    {{ $card['change'] >= 0 ? '↑' : '↓' }} {{ abs($card['change']) }}%
                    <span>{{ $card['change_label'] }}</span>
                @else
                    <span>{{ $card['change_label'] }}</span>
                @endif
            </div>
            <svg class="sparkline" viewBox="0 0 100 34" preserveAspectRatio="none" aria-hidden="true">
                <defs>
                    <linearGradient id="spark-{{ $loop->index }}" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="{{ $card['color'] }}" stop-opacity="0.35"/>
                        <stop offset="100%" stop-color="{{ $card['color'] }}" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <polygon fill="url(#spark-{{ $loop->index }})" points="0,34 {{ $polyline }} 100,34"></polygon>
                <polyline fill="none" stroke="{{ $card['color'] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="{{ $polyline }}"></polyline>
            </svg>
        </a>
    @endforeach
</div>

<div class="dash-grid">
    <section class="panel">
        <div class="panel-head">
            <h2>Site Activity</h2>
            <div class="panel-legend">
                <span><i class="legend-dot" style="background:#8b5cf6"></i>Messages</span>
                <span><i class="legend-dot" style="background:#c4b5fd"></i>Content updates</span>
            </div>
        </div>
        <div class="chart-wrap">
            <canvas id="trafficChart"></canvas>
        </div>
        <div class="traffic-stats">
            <div class="traffic-stat">
                <strong>{{ $activitySummary['messages_month'] }}</strong>
                <span>Messages this month</span>
                @if ($activitySummary['messages_change'] !== null)
                    <div class="{{ $activitySummary['messages_change'] >= 0 ? 'delta-up' : 'delta-down' }}">
                        {{ $activitySummary['messages_change'] >= 0 ? '↑' : '↓' }} {{ abs($activitySummary['messages_change']) }}%
                    </div>
                @endif
            </div>
            <div class="traffic-stat">
                <strong>{{ $activitySummary['unread'] }}</strong>
                <span>Unread inbox</span>
            </div>
            <div class="traffic-stat">
                <strong>{{ $activitySummary['published_total'] }}</strong>
                <span>Published items</span>
            </div>
            <div class="traffic-stat">
                <strong>{{ $activitySummary['faqs'] }} / {{ $activitySummary['team'] }}</strong>
                <span>FAQs / Team</span>
            </div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Recent Messages</h2>
            <a href="{{ route('admin.contact-messages.index') }}" style="font-size:0.78rem;color:#c4b5fd;font-weight:650;">View All</a>
        </div>

        @if ($recentMessages->isEmpty())
            <p style="color:#8b8b9a;font-size:0.875rem;padding:1rem 0;">No messages yet.</p>
        @else
            <div class="message-list">
                @foreach ($recentMessages as $msg)
                    <a href="{{ route('admin.contact-messages.show', $msg) }}" class="message-row">
                        <div class="msg-avatar">{{ strtoupper(substr($msg->name, 0, 1)) }}</div>
                        <div style="min-width:0;">
                            <div class="msg-name">{{ $msg->name }}</div>
                            <div class="msg-email">{{ $msg->email }}</div>
                            <div class="msg-preview">{{ \Illuminate\Support\Str::limit($msg->message, 42) }}</div>
                        </div>
                        <div class="msg-time">{{ $msg->created_at->diffForHumans(null, true) }} ago</div>
                    </a>
                @endforeach
            </div>
        @endif

        <a href="{{ route('admin.contact-messages.index') }}" class="view-all-btn">View All Messages</a>
    </section>
</div>

<div class="dash-grid-2">
    <section class="panel">
        <div class="panel-head">
            <h2>Content Overview</h2>
            <span style="font-size:0.72rem;color:#8b8b9a;">Published only</span>
        </div>
        <div class="content-overview">
            @foreach ($contentOverview as $item)
                @php
                    $map = [
                        'doc' => 'pages',
                        'cube' => 'services',
                        'folder' => 'portfolio',
                        'chart' => 'case',
                        'edit' => 'blog',
                        'star' => 'testimonial',
                        'faq' => 'faq',
                        'users' => 'users',
                        'media' => 'media',
                    ];
                @endphp
                <a href="{{ route($item['route']) }}" class="content-pill" style="text-decoration:none;color:inherit;">
                    <div class="ico" style="color: {{ $item['color'] }};">
                        @include('admin.partials.icon', ['name' => $map[$item['icon']] ?? 'pages'])
                    </div>
                    <strong>{{ $item['count'] }}</strong>
                    <span>{{ $item['label'] }}</span>
                    <em>Published</em>
                </a>
            @endforeach
        </div>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Quick Links</h2>
            <a href="{{ url('/') }}" target="_blank" style="font-size:0.78rem;color:#c4b5fd;font-weight:650;">Open site</a>
        </div>
        <div class="table-wrap">
            <table class="top-pages">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Public URL</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quickLinks as $link)
                        <tr>
                            <td>
                                <div class="page-cell">
                                    <span>
                                        <div class="page-name">{{ $link['name'] }}</div>
                                        <div class="page-slug">{{ $link['slug'] }}</div>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <a href="{{ $link['url'] }}" target="_blank" style="color:#c4b5fd;">View</a>
                            </td>
                            <td>
                                @if ($link['route'])
                                    <a href="{{ route($link['route']) }}" style="color:#c4b5fd;">Edit</a>
                                @else
                                    <span style="color:#6f6f80;">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
(() => {
    const labels = @json($activityLabels);
    const messages = @json($messagesSeries);
    const content = @json($contentSeries);
    const ctx = document.getElementById('trafficChart');
    if (!ctx || typeof Chart === 'undefined') return;

    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(139, 92, 246, 0.35)');
    gradient.addColorStop(1, 'rgba(139, 92, 246, 0.02)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Messages',
                    data: messages,
                    borderColor: '#8b5cf6',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.45,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    borderWidth: 2.5,
                },
                {
                    label: 'Content updates',
                    data: content,
                    borderColor: '#c4b5fd',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.45,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    borderWidth: 2,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#171722',
                    borderColor: 'rgba(255,255,255,0.08)',
                    borderWidth: 1,
                    titleColor: '#f4f4f8',
                    bodyColor: '#c4b5fd',
                    padding: 10,
                },
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255,255,255,0.04)', drawBorder: false },
                    ticks: { color: '#6f6f80', maxTicksLimit: 7, font: { size: 11 } },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6f6f80',
                        font: { size: 11 },
                        precision: 0,
                    },
                    grid: { color: 'rgba(255,255,255,0.05)', drawBorder: false },
                },
            },
        },
    });
})();
</script>
@endpush
