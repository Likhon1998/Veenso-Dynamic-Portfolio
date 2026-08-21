<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.public', 'home', 'about', 'contact', 'faq', 'blog.*', 'services.*', 'portfolio.*', 'case-studies.*', 'pages.*'], function ($view) {
            if ($view->offsetExists('siteSettings')) {
                return;
            }

            $view->with([
                'navServices' => Service::query()
                    ->where('status', 'published')
                    ->orderBy('sort_order')
                    ->orderBy('title')
                    ->get(['title', 'slug', 'is_primary']),
                'footerServices' => Service::query()
                    ->where('status', 'published')
                    ->where('is_primary', true)
                    ->orderBy('sort_order')
                    ->take(4)
                    ->get(['title', 'slug']),
                'siteSettings' => [
                    'site_name' => SiteSetting::get('site_name', 'Veenso'),
                    'tagline' => SiteSetting::get('tagline'),
                    'phone' => SiteSetting::get('phone'),
                    'email' => SiteSetting::get('email'),
                    'address' => SiteSetting::get('address'),
                    'footer_text' => SiteSetting::get('footer_text'),
                    'social_linkedin' => SiteSetting::get('social_linkedin'),
                    'social_facebook' => SiteSetting::get('social_facebook'),
                    'social_instagram' => SiteSetting::get('social_instagram'),
                    'brand_logo' => SiteSetting::get('brand_logo'),
                    'hero_image' => SiteSetting::get('hero_image'),
                    'hero_regions_badge' => SiteSetting::get('hero_regions_badge'),
                    'header_cta_text' => SiteSetting::get('header_cta_text', 'Book a Call'),
                    'meta_title' => SiteSetting::get('meta_title'),
                    'meta_description' => SiteSetting::get('meta_description'),
                    'home_cta_eyebrow' => SiteSetting::get('home_cta_eyebrow'),
                    'home_cta_subtitle' => SiteSetting::get('home_cta_subtitle'),
                    'home_cta_button' => SiteSetting::get('home_cta_button'),
                    'home_cta_title' => SiteSetting::get('home_cta_title'),
                    'cta_services_title' => SiteSetting::get('cta_services_title', 'Not sure which service fits your goals?'),
                    'cta_services_text' => SiteSetting::get('cta_services_text', "Book a strategy call and we'll map the right mix of services to your growth targets."),
                    'cta_services_button' => SiteSetting::get('cta_services_button', 'Book a Strategy Call'),
                    'cta_portfolio_title' => SiteSetting::get('cta_portfolio_title', 'Have a project in mind?'),
                    'cta_portfolio_text' => SiteSetting::get('cta_portfolio_text', "Let's talk about what you're building and how we can help it perform."),
                    'cta_portfolio_button' => SiteSetting::get('cta_portfolio_button', 'Start a Project'),
                    'cta_case_title' => SiteSetting::get('cta_case_title', 'Want results like these?'),
                    'cta_case_text' => SiteSetting::get('cta_case_text', "Tell us where you want to be in 12 months — we'll show you the strategy to get there."),
                    'cta_case_button' => SiteSetting::get('cta_case_button', 'Book a Strategy Call'),
                    'cta_faq_title' => SiteSetting::get('cta_faq_title', 'Still have questions?'),
                    'cta_faq_text' => SiteSetting::get('cta_faq_text', "Book a call and we'll answer everything specific to your business."),
                    'cta_faq_button' => SiteSetting::get('cta_faq_button', 'Book a Strategy Call'),
                ],
            ]);
        });

        View::composer(['admin.layouts.app', 'admin.partials._sidebar', 'admin.partials._topbar'], function ($view) {
            $view->with([
                'unreadMessagesCount' => ContactMessage::query()->where('status', 'unread')->count(),
                'adminBrandLogo' => SiteSetting::get('brand_logo'),
                'adminSiteName' => SiteSetting::get('site_name', 'Veenso'),
            ]);
        });
    }
}
