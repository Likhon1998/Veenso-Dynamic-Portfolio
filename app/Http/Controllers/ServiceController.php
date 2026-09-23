<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', [
            'page' => Page::query()->where('slug', 'services')->where('status', 'published')->first(),
            'primaryServices' => Service::query()
                ->where('status', 'published')
                ->where('is_primary', true)
                ->orderBy('sort_order')
                ->get(),
            'secondaryServices' => Service::query()
                ->where('status', 'published')
                ->where('is_primary', false)
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->status === 'published', 404);

        return view('services.show', [
            'service' => $service,
            'allServices' => Service::query()
                ->where('status', 'published')
                ->orderByDesc('is_primary')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->get(['id', 'title', 'slug', 'summary', 'icon', 'is_primary', 'sort_order']),
            'relatedServices' => Service::query()
                ->where('status', 'published')
                ->where('id', '!=', $service->id)
                ->orderByDesc('is_primary')
                ->orderBy('sort_order')
                ->take(3)
                ->get(),
        ]);
    }
}
