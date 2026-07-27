<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\CaseStudy;
use App\Models\ClientLogo;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\WhyChooseItem;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $copy = SiteSetting::many([
            'meta_title', 'meta_description',
            'hero_eyebrow', 'hero_headline', 'hero_headline_accent', 'hero_subheadline',
            'hero_cta_primary', 'hero_cta_url',
            'hero_cta_secondary_label', 'hero_cta_secondary_url',
            'hero_image', 'hero_banner', 'hero_regions_text', 'hero_regions_badge',
            'brand_logo',
            'trust_label',
            'stat_revenue_growth', 'stat_revenue_growth_label',
            'stat_roi', 'stat_roi_label',
            'stat_revenue_generated', 'stat_revenue_generated_label',
            'stat_projects', 'stat_projects_label',
            'home_services_eyebrow', 'home_services_title', 'home_services_subtitle', 'home_services_cta',
            'home_case_eyebrow', 'home_case_title', 'home_case_subtitle',
            'home_portfolio_eyebrow', 'home_portfolio_title', 'home_portfolio_subtitle', 'home_portfolio_cta',
            'home_why_eyebrow', 'home_why_title', 'home_why_subtitle',
            'home_testimonials_eyebrow', 'home_testimonials_title', 'home_testimonials_subtitle',
            'home_blog_eyebrow', 'home_blog_title', 'home_blog_subtitle', 'home_blog_cta',
            'home_cta_eyebrow', 'home_cta_title', 'home_cta_subtitle', 'home_cta_button',
        ]);

        return view('home', [
            'copy' => $copy,
            'heroImage' => $copy['hero_image'] ?: SiteSetting::get('hero_image'),
            'heroRegionsBadge' => $copy['hero_regions_badge'] ?: SiteSetting::get('hero_regions_badge'),
            'heroFlags' => [
                ['emoji' => '🇺🇸', 'label' => 'USA'],
                ['emoji' => '🇬🇧', 'label' => 'UK'],
                ['emoji' => '🇨🇦', 'label' => 'Canada'],
                ['emoji' => '🇦🇺', 'label' => 'Australia'],
                ['emoji' => '🇪🇺', 'label' => 'Europe'],
            ],
            'services' => Service::query()
                ->where('status', 'published')
                ->where('is_primary', true)
                ->orderBy('sort_order')
                ->take(4)
                ->get(),
            'featuredCaseStudy' => CaseStudy::query()
                ->where('status', 'published')
                ->where('featured', true)
                ->orderBy('sort_order')
                ->first(),
            'portfolioItems' => PortfolioItem::query()
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderBy('sort_order')
                ->take(4)
                ->get(),
            'testimonials' => Testimonial::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->get(),
            'blogPosts' => BlogPost::query()
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->take(3)
                ->get(),
            'clientLogos' => ClientLogo::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->get(),
            'whyChooseItems' => WhyChooseItem::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->get(),
            'stats' => [
                ['value' => $copy['stat_revenue_growth'], 'label' => $copy['stat_revenue_growth_label']],
                ['value' => $copy['stat_roi'], 'label' => $copy['stat_roi_label']],
                ['value' => $copy['stat_revenue_generated'], 'label' => $copy['stat_revenue_generated_label']],
                ['value' => $copy['stat_projects'], 'label' => $copy['stat_projects_label']],
            ],
        ]);
    }
}
