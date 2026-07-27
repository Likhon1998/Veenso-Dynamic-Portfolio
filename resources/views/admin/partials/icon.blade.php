@php
$icons = [
    'home' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1v-10.5z"/>',
    'pages' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5M9 13h6M9 17h6"/>',
    'services' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 8h6v6H4V8zm10 0h6v6h-6V8zM9 14h6v6H9v-6z"/>',
    'portfolio' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 8h18v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8zm5-4h8l1 4H7l1-4z"/>',
    'case' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m0 14h16M8 15V9m4 6V7m4 8v-4"/>',
    'blog' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 4h10l4 4v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 4v4h4M8 12h8M8 16h6"/>',
    'testimonial' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M7 16c1.5 1.2 3.2 2 5 2s3.5-.8 5-2"/><circle cx="12" cy="12" r="9"/>',
    'faq' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.1 9a3 3 0 1 1 4.7 2.5c-.8.6-1.3 1-1.3 2M12 17h.01"/><circle cx="12" cy="12" r="9"/>',
    'mail' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4V6zm0 0 8 7 8-7"/>',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1"/><circle cx="9.5" cy="8" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M19 19v-1a3.5 3.5 0 0 0-2.5-3.35M15.5 5.1a3 3 0 0 1 0 5.8"/>',
    'media' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4V6zm3 9 3-4 2 2 3-4 3 6H7z"/><circle cx="9" cy="10" r="1.2" fill="currentColor" stroke="none"/>',
    'settings' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 13a7.7 7.7 0 0 0 .05-2l2-1.15-2-3.45-2.3.75a7.7 7.7 0 0 0-1.75-1L15 3h-6l-.4 2.15a7.7 7.7 0 0 0-1.75 1L4.55 6.4l-2 3.45L4.55 11a7.7 7.7 0 0 0 0 2l-2 1.15 2 3.45 2.3-.75a7.7 7.7 0 0 0 1.75 1L9 21h6l.4-2.15a7.7 7.7 0 0 0 1.75-1l2.3.75 2-3.45L19.4 13z"/>',
    'user' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v1"/><circle cx="10" cy="8" r="3"/>',
    'shield' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3 5 6v6c0 4.5 3 7.5 7 9 4-1.5 7-4.5 7-9V6l-7-3z"/>',
    'backup' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v10m0 0 3.5-3.5M12 14l-3.5-3.5M5 16.5A4.5 4.5 0 0 0 8.5 21h7a4.5 4.5 0 0 0 1.7-8.7A6 6 0 0 0 6.1 9.2 4.5 4.5 0 0 0 5 16.5z"/>',
    'activity' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16M6 16l3-5 3 3 4-7 2 3"/>',
    'eye' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
    'search' => '<circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-3.5-3.5"/>',
    'bell' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 16h12l-1.2-1.5A5 5 0 0 1 16 11V9a4 4 0 1 0-8 0v2a5 5 0 0 1-.8 3.5L6 16zm4 2a2 2 0 0 0 4 0"/>',
    'external' => '<path stroke-linecap="round" stroke-linejoin="round" d="M14 4h6v6M20 4 11 13M10 5H5a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-5"/>',
    'chevron' => '<path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>',
    'star' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3.5l2.4 4.86 5.36.78-3.88 3.78.92 5.36L12 15.9l-4.8 2.52.92-5.36-3.88-3.78 5.36-.78L12 3.5z"/>',
];
$path = $icons[$name ?? 'pages'] ?? $icons['pages'];
@endphp

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="icon-svg" aria-hidden="true">
    {!! $path !!}
</svg>
