<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $page = Page::query()->where('slug', 'about')->where('status', 'published')->first();

        $teamMembers = TeamMember::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $stats = [
            ['value' => SiteSetting::get('stat_revenue_growth'), 'label' => SiteSetting::get('stat_revenue_growth_label')],
            ['value' => SiteSetting::get('stat_roi'), 'label' => SiteSetting::get('stat_roi_label')],
            ['value' => SiteSetting::get('stat_retention'), 'label' => SiteSetting::get('stat_retention_label')],
            ['value' => SiteSetting::get('stat_regions'), 'label' => SiteSetting::get('stat_regions_label')],
        ];

        return view('about', [
            'page' => $page,
            'teamMembers' => $teamMembers,
            'testimonials' => $testimonials,
            'stats' => $stats,
        ]);
    }
}
