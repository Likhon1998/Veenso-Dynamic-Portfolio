<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Models\CaseStudy;
use App\Models\ClientLogo;
use App\Models\Faq;
use App\Models\Page;
use App\Models\PortfolioImage;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WhyChooseItem;
use App\Support\BrandingServiceContent;
use App\Support\SeoServiceContent;
use App\Support\WebsiteDesignServiceContent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class InstallDemoContent extends Command
{
    protected $signature = 'veenso:install-demo {--fresh : Wipe demo content tables before importing}';

    protected $description = 'Install Veenso demo website content into the database (images in storage/app/public)';

    public function handle(): int
    {
        $this->info('Installing Veenso demo content...');

        if ($this->option('fresh')) {
            $this->wipeDemoContent();
        }

        $this->info('Generating demo images...');
        $brandLogo = $this->installBrandLogo() ?? $this->makeSvgImage('uploads/brand/logo.svg', 'Veenso', '#0B1220', '#6C5CE7');
        $heroImage = $this->installHeroPortrait();
        $heroRegionsBadge = $this->installHeroRegionsBadge();

        $this->info('Importing site settings...');
        $this->importSiteSettings($brandLogo, $heroImage, $heroRegionsBadge);

        $this->info('Importing client logos...');
        $this->importClientLogos();

        $this->info('Importing why-choose items...');
        $this->importWhyChooseItems();

        $this->info('Importing services...');
        $this->importServices();

        $this->info('Importing portfolio...');
        $this->importPortfolio();

        $this->info('Importing case studies...');
        $this->importCaseStudies();

        $this->info('Importing testimonials...');
        $this->importTestimonials();

        $this->info('Importing FAQs...');
        $this->importFaqs();

        $this->info('Importing blog posts...');
        $this->importBlogPosts();

        $this->info('Importing pages...');
        $this->importPages();

        $this->info('Importing team members...');
        $this->importTeamMembers();

        $this->info('Demo content installed successfully.');
        $this->info('Ensure the public storage link exists: php artisan storage:link');

        return self::SUCCESS;
    }

    private function wipeDemoContent(): void
    {
        $this->warn('Wiping demo content tables (--fresh)...');

        Schema::disableForeignKeyConstraints();

        $tables = [
            'portfolio_images',
            'portfolio_items',
            'services',
            'case_study_images',
            'case_studies',
            'blog_post_images',
            'blog_posts',
            'testimonials',
            'faqs',
            'pages',
            'team_members',
            'client_logos',
            'why_choose_items',
            'site_settings',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->delete();
            }
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Demo tables cleared (users preserved).');
    }

    private function makeSvgImage(string $relativePath, string $title, string $fromColor, string $toColor): string
    {
        $safeTitle = htmlspecialchars($title, ENT_QUOTES | ENT_XML1, 'UTF-8');

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="800" viewBox="0 0 1200 800" role="img" aria-label="{$safeTitle}">
  <defs>
    <linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$fromColor}"/>
      <stop offset="100%" stop-color="{$toColor}"/>
    </linearGradient>
    <linearGradient id="shine" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="rgba(255,255,255,0.18)"/>
      <stop offset="100%" stop-color="rgba(255,255,255,0)"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="800" fill="#0B0B12"/>
  <rect width="1200" height="800" fill="url(#g)" opacity="0.92"/>
  <rect width="1200" height="320" fill="url(#shine)"/>
  <circle cx="980" cy="140" r="180" fill="rgba(255,255,255,0.10)"/>
  <circle cx="160" cy="680" r="220" fill="rgba(0,0,0,0.22)"/>
  <rect x="90" y="90" width="220" height="12" rx="6" fill="rgba(255,255,255,0.35)"/>
  <rect x="90" y="120" width="140" height="12" rx="6" fill="rgba(255,255,255,0.18)"/>
  <text x="600" y="390" fill="#ffffff" font-family="Georgia, 'Times New Roman', serif" font-size="48" font-weight="700" text-anchor="middle">{$safeTitle}</text>
  <text x="600" y="455" fill="rgba(255,255,255,0.78)" font-family="system-ui, sans-serif" font-size="22" text-anchor="middle">Veenso Service</text>
</svg>
SVG;

        Storage::disk('public')->put($relativePath, $svg);

        return $relativePath;
    }

    private function installBrandLogo(): ?string
    {
        $source = storage_path('app/demo-assets/veenso-logo.png');
        $dest = 'uploads/brand/veenso-logo.png';

        if (! is_file($source)) {
            return null;
        }

        if (! $this->option('fresh') && Storage::disk('public')->exists($dest)) {
            return $dest;
        }

        Storage::disk('public')->put($dest, file_get_contents($source));

        return $dest;
    }

    private function installHeroRegionsBadge(): ?string
    {
        $source = storage_path('app/demo-assets/regions-badge.png');
        $dest = 'uploads/hero/regions-badge.png';

        if (! is_file($source)) {
            $this->warn('Regions badge demo asset missing at storage/app/demo-assets/regions-badge.png');

            return null;
        }

        if (! $this->option('fresh') && Storage::disk('public')->exists($dest)) {
            return $dest;
        }

        Storage::disk('public')->put($dest, file_get_contents($source));

        return $dest;
    }

    private function installHeroPortrait(): ?string
    {
        $candidates = [
            storage_path('app/demo-assets/hero-portrait.png') => 'uploads/hero/portrait.png',
            storage_path('app/demo-assets/hero-portrait.jpg') => 'uploads/hero/portrait.jpg',
        ];

        foreach ($candidates as $source => $dest) {
            if (! is_file($source)) {
                continue;
            }

            if (! $this->option('fresh') && Storage::disk('public')->exists($dest)) {
                return $dest;
            }

            Storage::disk('public')->put($dest, file_get_contents($source));

            return $dest;
        }

        $this->warn('Hero portrait demo asset missing at storage/app/demo-assets/hero-portrait.png');

        return null;
    }

    private function importSiteSettings(string $brandLogo, ?string $heroImage = null, ?string $heroRegionsBadge = null): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'veenso', 'group' => 'general'],
            ['key' => 'tagline', 'value' => 'Strategy-first digital growth for brands that measure what matters.', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => 'Veenso partners with growth-minded brands to build measurable digital systems — not vanity metrics.', 'group' => 'general'],
            ['key' => 'phone', 'value' => '+1 (555) 482-9100', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'hello@veenso.com', 'group' => 'contact'],
            ['key' => 'address', 'value' => '1200 Market Street, Suite 400, San Francisco, CA 94103', 'group' => 'contact'],
            ['key' => 'socials', 'value' => [
                'linkedin' => 'https://linkedin.com/company/veenso',
                'twitter' => 'https://twitter.com/veenso',
                'instagram' => 'https://instagram.com/veenso',
            ], 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/veenso', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/veenso', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/veenso', 'group' => 'social'],
            ['key' => 'brand_logo', 'value' => $brandLogo, 'group' => 'brand'],
            ['key' => 'hero_image', 'value' => $heroImage ?? '', 'group' => 'hero'],
            ['key' => 'hero_banner', 'value' => '', 'group' => 'hero'],
            ['key' => 'hero_regions_badge', 'value' => $heroRegionsBadge ?? '', 'group' => 'hero'],
            ['key' => 'meta_title', 'value' => 'Veenso — Strategy-First Digital Growth Agency', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Veenso designs, builds, and optimizes the digital channels that drive revenue — SEO, marketing, web, and brand, with transparent reporting and accountable outcomes.', 'group' => 'seo'],
            ['key' => 'header_cta_text', 'value' => 'Book a Free Strategy Call', 'group' => 'header'],

            ['key' => 'hero_eyebrow', 'value' => 'Growth Partner • Not Just an Agency', 'group' => 'hero'],
            ['key' => 'hero_headline', 'value' => 'Helping Service & E-commerce Businesses Grow Through ', 'group' => 'hero'],
            ['key' => 'hero_headline_accent', 'value' => 'SEO, Paid Ads & AI Search.', 'group' => 'hero'],
            ['key' => 'hero_subheadline', 'value' => 'We combine SEO, AI Search Optimization, Paid Advertising, Content Strategy and Conversion-Focused Websites to help businesses grow predictably.', 'group' => 'hero'],
            ['key' => 'hero_cta_primary', 'value' => 'Book a Free Strategy Call', 'group' => 'hero'],
            ['key' => 'hero_cta_url', 'value' => '/contact', 'group' => 'hero'],
            ['key' => 'hero_cta_secondary_label', 'value' => 'View Our Work', 'group' => 'hero'],
            ['key' => 'hero_cta_secondary_url', 'value' => '/portfolio', 'group' => 'hero'],
            ['key' => 'hero_regions_text', 'value' => 'Serving Businesses Across in USA, UK, CANADA, AUSTRALIA & EUROPE.', 'group' => 'hero'],

            ['key' => 'trust_label', 'value' => 'Trusted by growth teams', 'group' => 'home'],

            ['key' => 'stat_revenue_growth', 'value' => '120%+', 'group' => 'stats'],
            ['key' => 'stat_revenue_growth_label', 'value' => 'Average revenue growth for retained clients', 'group' => 'stats'],
            ['key' => 'stat_roi', 'value' => '4.5X', 'group' => 'stats'],
            ['key' => 'stat_roi_label', 'value' => 'Average marketing ROI within 12 months', 'group' => 'stats'],
            ['key' => 'stat_revenue_generated', 'value' => '$8M+', 'group' => 'stats'],
            ['key' => 'stat_revenue_generated_label', 'value' => 'Client revenue attributed to our campaigns', 'group' => 'stats'],
            ['key' => 'stat_projects', 'value' => '50+', 'group' => 'stats'],
            ['key' => 'stat_projects_label', 'value' => 'Projects delivered across industries', 'group' => 'stats'],
            ['key' => 'stat_retention', 'value' => '95%', 'group' => 'stats'],
            ['key' => 'stat_retention_label', 'value' => 'Client retention rate', 'group' => 'stats'],
            ['key' => 'stat_regions', 'value' => '4', 'group' => 'stats'],
            ['key' => 'stat_regions_label', 'value' => 'Regions served: North America, Europe, APAC, MENA', 'group' => 'stats'],

            ['key' => 'home_services_eyebrow', 'value' => 'What We Do', 'group' => 'home'],
            ['key' => 'home_services_title', 'value' => 'Full-funnel services built for measurable growth', 'group' => 'home'],
            ['key' => 'home_services_subtitle', 'value' => 'SEO, marketing, web, and brand — integrated into one accountable growth system.', 'group' => 'home'],
            ['key' => 'home_services_cta', 'value' => 'Explore All Services', 'group' => 'home'],

            ['key' => 'home_case_eyebrow', 'value' => 'Featured Result', 'group' => 'home'],
            ['key' => 'home_case_title', 'value' => 'Proof over promises', 'group' => 'home'],
            ['key' => 'home_case_subtitle', 'value' => 'How strategy-first execution turns into measurable revenue outcomes.', 'group' => 'home'],

            ['key' => 'home_portfolio_eyebrow', 'value' => 'Selected Work', 'group' => 'home'],
            ['key' => 'home_portfolio_title', 'value' => 'A portfolio built on outcomes', 'group' => 'home'],
            ['key' => 'home_portfolio_subtitle', 'value' => 'Websites, brand systems, and campaigns engineered for conversion.', 'group' => 'home'],
            ['key' => 'home_portfolio_cta', 'value' => 'View Full Portfolio', 'group' => 'home'],

            ['key' => 'home_why_eyebrow', 'value' => 'Why Veenso', 'group' => 'home'],
            ['key' => 'home_why_title', 'value' => 'Strategy before tactics. Accountability before applause.', 'group' => 'home'],
            ['key' => 'home_why_subtitle', 'value' => 'Transparent reporting, integrated execution, and outcomes you can measure.', 'group' => 'home'],

            ['key' => 'home_testimonials_eyebrow', 'value' => 'Client Voices', 'group' => 'home'],
            ['key' => 'home_testimonials_title', 'value' => 'What partnering with Veenso looks like', 'group' => 'home'],
            ['key' => 'home_testimonials_subtitle', 'value' => 'Real outcomes, told by the teams who lived them.', 'group' => 'home'],

            ['key' => 'home_blog_eyebrow', 'value' => 'Insights', 'group' => 'home'],
            ['key' => 'home_blog_title', 'value' => 'Strategy notes from the Veenso team', 'group' => 'home'],
            ['key' => 'home_blog_subtitle', 'value' => 'Perspectives on growth, search, and brand — grounded in what moves the needle.', 'group' => 'home'],
            ['key' => 'home_blog_cta', 'value' => 'Read More Insights', 'group' => 'home'],

            ['key' => 'home_cta_eyebrow', 'value' => "Let's Build Something Measurable", 'group' => 'home'],
            ['key' => 'home_cta_title', 'value' => 'Ready to turn your digital presence into a revenue engine?', 'group' => 'home'],
            ['key' => 'home_cta_subtitle', 'value' => "Tell us about your goals — we'll come back with a strategy, not a sales pitch.", 'group' => 'home'],
            ['key' => 'home_cta_button', 'value' => 'Book Your Strategy Call', 'group' => 'home'],

            ['key' => 'cta_services_title', 'value' => 'Not sure which service fits your goals?', 'group' => 'cta'],
            ['key' => 'cta_services_text', 'value' => "Book a strategy call and we'll map the right mix of services to your growth targets.", 'group' => 'cta'],
            ['key' => 'cta_services_button', 'value' => 'Book a Strategy Call', 'group' => 'cta'],
            ['key' => 'cta_portfolio_title', 'value' => 'Have a project in mind?', 'group' => 'cta'],
            ['key' => 'cta_portfolio_text', 'value' => "Let's talk about what you're building and how we can help it perform.", 'group' => 'cta'],
            ['key' => 'cta_portfolio_button', 'value' => 'Start a Project', 'group' => 'cta'],
            ['key' => 'cta_case_title', 'value' => 'Want results like these?', 'group' => 'cta'],
            ['key' => 'cta_case_text', 'value' => "Tell us where you want to be in 12 months — we'll show you the strategy to get there.", 'group' => 'cta'],
            ['key' => 'cta_case_button', 'value' => 'Book a Strategy Call', 'group' => 'cta'],
            ['key' => 'cta_faq_title', 'value' => 'Still have questions?', 'group' => 'cta'],
            ['key' => 'cta_faq_text', 'value' => "Book a call and we'll answer everything specific to your business.", 'group' => 'cta'],
            ['key' => 'cta_faq_button', 'value' => 'Book a Strategy Call', 'group' => 'cta'],
        ];

        foreach ($settings as $setting) {
            if (! $this->option('fresh') && SiteSetting::query()->where('key', $setting['key'])->exists()) {
                continue;
            }

            SiteSetting::set($setting['key'], $setting['value'], $setting['group']);
        }
    }

    private function importClientLogos(): void
    {
        $brands = [
            ['name' => 'Meridian Health', 'from' => '#0F766E', 'to' => '#134E4A'],
            ['name' => 'Atlas Commerce', 'from' => '#1D4ED8', 'to' => '#1E3A8A'],
            ['name' => 'Northwind Labs', 'from' => '#B45309', 'to' => '#78350F'],
            ['name' => 'Summit Financial', 'from' => '#047857', 'to' => '#064E3B'],
            ['name' => 'BluePeak SaaS', 'from' => '#0369A1', 'to' => '#0C4A6E'],
            ['name' => 'Horizon Retail', 'from' => '#BE185D', 'to' => '#831843'],
        ];

        foreach ($brands as $index => $brand) {
            $slug = strtolower(str_replace(' ', '-', $brand['name']));
            $logo = $this->makeSvgImage("uploads/clients/{$slug}.svg", $brand['name'], $brand['from'], $brand['to']);

            ClientLogo::query()->updateOrCreate(
                ['name' => $brand['name']],
                [
                    'logo' => $logo,
                    'url' => null,
                    'sort_order' => $index + 1,
                    'status' => 'published',
                ]
            );
        }
    }

    private function importWhyChooseItems(): void
    {
        $items = [
            [
                'title' => 'Strategy-first',
                'description' => 'Every engagement starts with business goals, not a menu of tactics.',
                'icon' => 'target',
                'sort_order' => 1,
            ],
            [
                'title' => 'Transparent reporting',
                'description' => 'Dashboards tied to revenue and pipeline — never vanity metrics.',
                'icon' => 'search',
                'sort_order' => 2,
            ],
            [
                'title' => 'Integrated team',
                'description' => 'SEO, web, paid, and brand under one roof.',
                'icon' => 'share',
                'sort_order' => 3,
            ],
            [
                'title' => 'Accountable outcomes',
                'description' => 'Clear KPIs, defined milestones, and measurable results.',
                'icon' => 'sparkles',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            WhyChooseItem::query()->updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, ['status' => 'published'])
            );
        }
    }

    private function importServices(): void
    {
        $seoImage = $this->installDemoAsset('seo-service-hero.png', 'uploads/services/seo-service-hero.png')
            ?? $this->makeSvgImage('uploads/services/seo.svg', 'SEO', '#8B5CF6', '#6D28D9');
        $webImage = $this->installDemoAsset('web-service-hero.png', 'uploads/services/web-service-hero.png')
            ?? $this->makeSvgImage('uploads/services/website-design-development.svg', 'Web Design', '#10B981', '#047857');
        $brandImage = $this->installDemoAsset('branding-service-hero.png', 'uploads/services/branding-service-hero.png')
            ?? $this->makeSvgImage('uploads/services/branding.svg', 'Branding', '#EC4899', '#BE185D');

        $services = [
            SeoServiceContent::payload($seoImage),
            WebsiteDesignServiceContent::payload($webImage),
            BrandingServiceContent::payload($brandImage),
        ];

        $keepSlugs = [];

        foreach ($services as $payload) {
            Service::query()->updateOrCreate(['slug' => $payload['slug']], $payload);
            $keepSlugs[] = $payload['slug'];
        }

        // Keep only the seeded live service offerings.
        Service::query()->whereNotIn('slug', $keepSlugs)->delete();
    }

    private function importPortfolio(): void
    {
        $img1 = $this->makeSvgImage('uploads/portfolio/meridian-1.svg', 'Meridian Health', '#0F766E', '#134E4A');
        $img2 = $this->makeSvgImage('uploads/portfolio/meridian-2.svg', 'Meridian Dashboard', '#115E59', '#042F2E');
        $img3 = $this->makeSvgImage('uploads/portfolio/atlas-1.svg', 'Atlas Commerce', '#1D4ED8', '#1E3A8A');
        $img4 = $this->makeSvgImage('uploads/portfolio/atlas-2.svg', 'Atlas Collection', '#2563EB', '#1E40AF');
        $img5 = $this->makeSvgImage('uploads/portfolio/atlas-3.svg', 'Atlas Checkout', '#3B82F6', '#1D4ED8');
        $img6 = $this->makeSvgImage('uploads/portfolio/northwind-1.svg', 'Northwind Brand', '#B45309', '#78350F');
        $img7 = $this->makeSvgImage('uploads/portfolio/northwind-2.svg', 'Northwind Identity', '#D97706', '#92400E');
        $img8 = $this->makeSvgImage('uploads/portfolio/northwind-3.svg', 'Northwind Collateral', '#F59E0B', '#B45309');
        $img9 = $this->makeSvgImage('uploads/portfolio/summit-1.svg', 'Summit SEO', '#047857', '#064E3B');
        $img10 = $this->makeSvgImage('uploads/portfolio/summit-2.svg', 'Summit Clusters', '#059669', '#065F46');
        $img11 = $this->makeSvgImage('uploads/portfolio/summit-3.svg', 'Summit Growth', '#10B981', '#047857');

        $items = [
            [
                'title' => 'Meridian Health Platform',
                'slug' => 'meridian-health-platform',
                'category' => 'Website',
                'description' => 'A patient-centric healthcare portal built on Laravel with real-time appointment scheduling, secure messaging, and integrated analytics. Reduced bounce rate by 38% and increased appointment bookings by 52% within 90 days of launch.',
                'client_name' => 'Meridian Health',
                'year' => '2025',
                'service_tags' => ['Website Design & Development', 'SEO', 'Branding'],
                'featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'featured_image' => $img1,
                'meta_title' => 'Meridian Health Platform | Veenso Portfolio',
                'meta_description' => 'Healthcare portal built on Laravel — 52% increase in appointment bookings post-launch.',
                'images' => [
                    ['path' => $img1, 'alt' => 'Meridian Health homepage', 'sort_order' => 1],
                    ['path' => $img2, 'alt' => 'Meridian Health dashboard', 'sort_order' => 2],
                ],
            ],
            [
                'title' => 'Atlas Commerce Storefront',
                'slug' => 'atlas-commerce-storefront',
                'category' => 'Website',
                'description' => 'Shopify Plus migration and redesign for a multi-category DTC brand. Implemented custom checkout flows, GA4 e-commerce tracking, and email capture automation. Revenue per session increased 41% in the first quarter.',
                'client_name' => 'Atlas Commerce',
                'year' => '2025',
                'service_tags' => ['Website Design & Development', 'Email Marketing', 'Google & Meta Ads'],
                'featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'featured_image' => $img3,
                'meta_title' => 'Atlas Commerce Storefront | Veenso Portfolio',
                'meta_description' => 'Shopify Plus migration with 41% revenue-per-session increase.',
                'images' => [
                    ['path' => $img3, 'alt' => 'Atlas Commerce product page', 'sort_order' => 1],
                    ['path' => $img4, 'alt' => 'Atlas Commerce collection view', 'sort_order' => 2],
                    ['path' => $img5, 'alt' => 'Atlas Commerce checkout flow', 'sort_order' => 3],
                ],
            ],
            [
                'title' => 'Northwind Labs Rebrand',
                'slug' => 'northwind-labs-rebrand',
                'category' => 'Branding',
                'description' => 'Complete brand repositioning for a B2B SaaS company entering enterprise markets. New identity, messaging framework, and sales collateral deployed across web, LinkedIn, and conference materials.',
                'client_name' => 'Northwind Labs',
                'year' => '2024',
                'service_tags' => ['Branding', 'Marketing', 'Social Media Marketing'],
                'featured' => false,
                'status' => 'published',
                'sort_order' => 3,
                'featured_image' => $img6,
                'meta_title' => 'Northwind Labs Rebrand | Veenso Portfolio',
                'meta_description' => 'B2B SaaS rebrand and repositioning for enterprise market entry.',
                'images' => [
                    ['path' => $img6, 'alt' => 'Northwind Labs brand guidelines', 'sort_order' => 1],
                    ['path' => $img7, 'alt' => 'Northwind Labs identity applications', 'sort_order' => 2],
                    ['path' => $img8, 'alt' => 'Northwind Labs sales collateral', 'sort_order' => 3],
                ],
            ],
            [
                'title' => 'Summit Financial SEO Program',
                'slug' => 'summit-financial-seo',
                'category' => 'SEO',
                'description' => '12-month organic search program for a financial advisory firm. Technical audit, content strategy, and link building drove 187% organic traffic growth and 63 qualified leads per month from search.',
                'client_name' => 'Summit Financial',
                'year' => '2024',
                'service_tags' => ['SEO', 'Marketing'],
                'featured' => false,
                'status' => 'published',
                'sort_order' => 4,
                'featured_image' => $img9,
                'meta_title' => 'Summit Financial SEO | Veenso Portfolio',
                'meta_description' => '187% organic traffic growth and 63 monthly qualified leads for financial advisory firm.',
                'images' => [
                    ['path' => $img9, 'alt' => 'Summit Financial SEO results dashboard', 'sort_order' => 1],
                    ['path' => $img10, 'alt' => 'Summit Financial content cluster map', 'sort_order' => 2],
                    ['path' => $img11, 'alt' => 'Summit Financial organic growth chart', 'sort_order' => 3],
                ],
            ],
        ];

        foreach ($items as $itemData) {
            $images = $itemData['images'];
            unset($itemData['images']);

            $item = PortfolioItem::query()->updateOrCreate(['slug' => $itemData['slug']], $itemData);

            PortfolioImage::query()->where('portfolio_item_id', $item->id)->delete();

            foreach ($images as $image) {
                PortfolioImage::query()->create([
                    'portfolio_item_id' => $item->id,
                    'path' => $image['path'],
                    'alt' => $image['alt'],
                    'sort_order' => $image['sort_order'],
                ]);
            }
        }
    }

    private function importCaseStudies(): void
    {
        $jewelryFeatured = $this->installDemoAsset('jewelry-case-hero.png', 'uploads/case-studies/jewelry-case-hero.png')
            ?? $this->installDemoAsset('jewelry-seo-apr-jul.png', 'uploads/case-studies/jewelry-seo-featured.png')
            ?? $this->makeSvgImage('uploads/case-studies/jewelry-seo.svg', 'Jewelry SEO', '#B45309', '#78350F');
        $dentalFeatured = $this->installDemoAsset('dental-case-hero.png', 'uploads/case-studies/dental-case-hero.png')
            ?? $this->installDemoAsset('dental-local-seo-compare.png', 'uploads/case-studies/dental-local-seo-featured.png')
            ?? $this->makeSvgImage('uploads/case-studies/dental-local-seo.svg', 'Dental Local SEO', '#0F766E', '#134E4A');
        $lawFeatured = $this->installDemoAsset('law-case-hero.png', 'uploads/case-studies/law-case-hero.png')
            ?? $this->installDemoAsset('law-firm-new-site-seo.png', 'uploads/case-studies/law-firm-new-site-seo-featured.png')
            ?? $this->makeSvgImage('uploads/case-studies/law-firm-new-site-seo.svg', 'Law Firm SEO', '#1E3A8A', '#1D4ED8');

        $studies = [
            [
                'title' => 'E-Commerce SEO Case Study: Turning a Stalled Jewelry Store Into a Consistent Organic Growth Engine',
                'slug' => 'ecommerce-jewelry-seo-organic-growth',
                'client_name' => 'Confidential U.S. Jewelry Brand',
                'challenge' => "A Shopify-based jewelry brand came to us with a familiar problem: a well-built store with strong products, but organic search wasn't pulling its weight. Product and collection pages were nearly invisible on Google, keyword rankings sat deep on page 3+, and the business was leaning almost entirely on paid ads to bring in traffic. Every new sale was costing money in ad spend — there was no free, compounding channel doing the work in the background.\n\nA deeper audit surfaced the real blockers:\n• Thin, generic product descriptions doing nothing to signal relevance for high-intent buyer searches\n• No structured data (Schema) on product or collection pages, so Google couldn't fully understand — or richly display — the catalog\n• Weak internal linking, leaving collection and product pages isolated with no equity flowing between them\n• Duplicate meta titles and descriptions across near-identical product variants\n• Crawl and indexation gaps that were quietly keeping entire sections of the catalog out of Google's index\n• Little to no informational content, meaning the site had no way to capture buyers earlier in their research journey\n\nThe mandate was clear: build durable, compounding organic visibility — without depending entirely on paid ads to keep the lights on.",
                'strategy' => "Rather than chasing a quick spike, we built a layered SEO system designed to compound month over month.\n\n☑ Technical Foundation\nFull technical audit, indexation fixes, sitemap and robots.txt optimization, canonical cleanup, Core Web Vitals improvements, and full structured data implementation (Product Schema, Breadcrumb Schema) so Google could crawl, understand, and richly render every page.\n\n☑ Keyword & Intent Mapping\nEvery product and collection page was mapped to a primary commercial keyword plus supporting semantic terms — covering high-intent buying searches, long-tail variations, and lower-competition opportunities other jewelry retailers were ignoring.\n\n☑ On-Page & Shopify-Specific SEO\nRewritten titles, meta descriptions, and header structure across priority pages; optimized product images and alt tags; a variant indexing strategy so individual product variations could rank independently instead of competing with each other; and a rebuilt internal linking structure connecting collections, products, and content.\n\n☑ Content & Topical Authority\nBuying guides, FAQ sections, and educational content built around real jewelry search intent — helping the site earn authority beyond just transactional product pages, and capturing shoppers still in the research phase.",
                'implementation' => "Data Source: Google Search Console. Metrics compare the stated reporting periods before and after the SEO campaign.\n\nThe growth wasn't the result of one tactic — it came from fixing the foundation first (technical + indexation), then giving Google a reason to trust and rank the site (structured content + internal linking + Schema), then capturing demand across the full buyer journey (commercial + informational keywords). Each layer supported the next, which is why the growth curve kept climbing instead of plateauing.",
                'results' => "The data tells the story cleanly. Clicks and impressions tracked flat and low through the first quarter of the campaign, then broke into sustained upward momentum as the technical fixes and content began compounding — climbing from a 445-click, 35.6K-impression month in April to a 3.62K-click, 152K-impression month in July, a 713% and 327% lift respectively, with average position improving by nearly 9 spots in the same window.\n\nJust as important as the size of the growth is the shape of it: this wasn't a single-month spike that faded. The upward trend held and continued climbing through the full reporting period, which is the real signal of durable, compounding SEO — not a paid-traffic sugar high.\n\nOver the full campaign window, the store generated 14.2K total organic clicks and 685K impressions — a durable, compounding lift, not a one-month spike.",
                'stats' => [
                    ['label' => 'Organic clicks growth', 'value' => '+713%'],
                    ['label' => 'Impressions growth', 'value' => '+327%'],
                    ['label' => 'Avg CTR', 'value' => '2.4%'],
                    ['label' => 'Avg position', 'value' => '27.2'],
                ],
                'service_category' => 'E-Commerce SEO',
                'featured' => true,
                'status' => 'published',
                'sort_order' => 0,
                'featured_image' => $jewelryFeatured,
                'excerpt' => 'Industry: E-Commerce (Jewelry) | Platform: Shopify | Full-funnel SEO campaign that grew organic clicks 713% and impressions 327% in three months.',
                'meta_title' => 'Jewelry E-Commerce SEO Case Study | Veenso',
                'meta_description' => 'How a U.S. Shopify jewelry brand grew organic clicks 713% and impressions 327% with a full-funnel SEO campaign.',
                '_gallery' => [
                    [
                        'source' => 'jewelry-seo-apr-jul.png',
                        'dest' => 'uploads/case-studies/gallery/jewelry-seo-apr-jul.png',
                        'alt' => 'Google Search Console: April vs July 2025 comparison',
                        'caption' => 'Month comparison: clicks grew 713% and impressions grew 327% (Apr → Jul 2025).',
                    ],
                    [
                        'source' => 'jewelry-seo-full-window.png',
                        'dest' => 'uploads/case-studies/gallery/jewelry-seo-full-window.png',
                        'alt' => 'Google Search Console: full campaign window Jan–Jul 2025',
                        'caption' => 'Full campaign window: 14.2K organic clicks and 685K impressions after project start.',
                    ],
                ],
            ],
            [
                'title' => 'Local SEO Case Study: Growing a Dental Clinic\'s Organic Visibility From the Ground Up',
                'slug' => 'dental-clinic-local-seo-organic-visibility',
                'client_name' => 'Confidential U.S. Dental Practice',
                'challenge' => "A USA-based dental clinic came to us with a problem shared by most local healthcare practices: a professional, well-built website that simply wasn't showing up when patients searched. Service pages weren't ranking, the clinic's local presence was thin, and competitors were consistently outranking them for the exact searches that turn into booked appointments — \"dentist near me,\" specific procedures, and emergency care terms.\n\nOur audit uncovered the gaps holding the site back:\n• Weak, inconsistent Core Web Vitals and page speed dragging down both rankings and user experience\n• Duplicate metadata across service pages, diluting relevance signals\n• An under-optimized Google Business Profile with inconsistent NAP (Name, Address, Phone) data across directories\n• Missing Local Business Schema, so Google had no structured way to understand the clinic's services and service area\n• Thin service pages with little informational content to support patient search intent\n• Very few location-focused landing pages, despite the practice serving multiple nearby communities",
                'strategy' => "We built a campaign around three pillars working together — technical health, local presence, and content depth.\n\n☑ Technical SEO\nFull site audit, crawl error fixes, indexation cleanup, XML sitemap and robots.txt optimization, and targeted Core Web Vitals and page speed improvements to remove the friction holding rankings back.\n\n☑ Local SEO\nGoogle Business Profile optimization, NAP consistency corrections across citations, local citation building, Local Business Schema implementation, and new location-focused landing pages to strengthen relevance for \"near me\" and service-area searches.\n\n☑ On-Page & Content\nKeyword research mapped to real patient search intent, rewritten titles and meta descriptions, stronger internal linking, image SEO, and new content — dental service pages, preventive care guides, and FAQ sections — built to answer the questions patients are actually searching before they book.",
                'implementation' => "Data Source: Google Search Console. Metrics compare the stated reporting periods before and after the SEO campaign.\n\nLocal SEO for healthcare only works when technical health, local signals, and content intent are addressed together — fixing site speed alone doesn't rank a practice if Google Business Profile data is inconsistent, and building citations alone doesn't help if the site's service pages are too thin to satisfy patient intent once they arrive. By solving all three simultaneously, the clinic saw the kind of compounding, sustained growth this data reflects — not a short-lived bump.",
                'results' => "The Search Console data shows a clear inflection point. In the months before the campaign began, clicks and impressions were flat and low. From the point SEO content services began, the trend line broke upward and kept climbing — impressions roughly doubling in range and clicks following the same trajectory, sustained over the following months rather than spiking and fading.\n\nComparing the six months before the ramp-up to the six months after: clicks grew from 130 to 1.9K (+1361.5%), impressions from 4.5K to 22.8K (+407%), and average position improved by more than 12 spots — moving the practice from largely invisible (page 3, position ~28) into consistent page 1–2 visibility (position ~16). CTR climbed alongside it, from 2.9% to 4.8%, meaning more of the people seeing the clinic in search results were choosing to click through.\n\nOver the last 6 months, organic search performance improved significantly across every metric: clicks +1,361.5%, impressions +407%, CTR +66%, and average position improved from 27.9 to 15.6.",
                'stats' => [
                    ['label' => 'Organic clicks growth', 'value' => '+1361%'],
                    ['label' => 'Impressions growth', 'value' => '+407%'],
                    ['label' => 'Avg CTR', 'value' => '4.8%'],
                    ['label' => 'Avg position', 'value' => '15.6'],
                ],
                'service_category' => 'Local SEO',
                'featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'featured_image' => $dentalFeatured,
                'excerpt' => 'Industry: Dental Clinic | Location: USA | Platform: WordPress | Complete Local SEO campaign that grew organic clicks 1,361.5% and impressions 407%.',
                'meta_title' => 'Dental Clinic Local SEO Case Study | Veenso',
                'meta_description' => 'How a U.S. dental practice grew organic clicks 1,361.5% and impressions 407% with a complete Local SEO campaign.',
                '_gallery' => [
                    [
                        'source' => 'dental-local-seo-compare.png',
                        'dest' => 'uploads/case-studies/gallery/dental-local-seo-compare.png',
                        'alt' => 'Google Search Console: previous 6 months vs last 6 months comparison',
                        'caption' => 'Six-month comparison: clicks 130 → 1.9K (+1361.5%), impressions 4.5K → 22.8K (+407%).',
                    ],
                    [
                        'source' => 'dental-local-seo-timeline.png',
                        'dest' => 'uploads/case-studies/gallery/dental-local-seo-timeline.png',
                        'alt' => 'Google Search Console timeline showing SEO content services start',
                        'caption' => 'Clear inflection after SEO content services began — sustained climb in clicks and impressions.',
                    ],
                ],
            ],
            [
                'title' => 'New Website SEO Case Study: Launching a Law Firm From Zero to First-Page Visibility',
                'slug' => 'law-firm-new-website-seo-zero-to-first-page',
                'client_name' => 'Confidential U.S. Law Firm',
                'challenge' => "Launching a new law firm website is one of the hardest SEO projects to win. There's no domain authority, no existing rankings, no backlink profile, and — in a field as competitive and high-value as legal services — established firms with years of accumulated trust dominate the search results for every meaningful keyword.\n\nThis client came to us with exactly that starting point: a professionally built lawyer website with strong service offerings, but completely invisible on Google. No practice area pages were ranking, there was no indexed content for Google to evaluate, and the firm had no way to compete against long-established competitors without either overspending on ads or waiting years for organic authority to build naturally.\n\nThe brief was to build visibility fast, but sustainably — creating a foundation that would keep compounding long after the initial launch phase.",
                'strategy' => "☑ Technical Foundation First\nBefore any content or keyword work began, we ensured the site was fully crawlable and indexable — XML sitemap setup, robots.txt configuration, canonical URL structure, mobile usability, Core Web Vitals, and HTTPS validation, so nothing technical stood between the site and Google's index.\n\n☑ Keyword Research Built for a New Domain\nRather than targeting the most competitive head terms immediately — \"personal injury lawyer,\" \"divorce lawyer,\" and similarly saturated searches — we identified achievable opportunities with strong commercial intent: long-tail variations, supporting semantic keywords, and topic clusters around each practice area. This gave the site a realistic path to visibility while still building toward the high-value commercial terms over time.\n\n☑ On-Page SEO Across Every Practice Area\nEvery service page was optimized individually — SEO-friendly title tags, compelling meta descriptions, proper heading hierarchy, internal linking between related practice areas, schema markup, and content structured to directly answer what a prospective client is searching for at the moment of intent.\n\n☑ Content Built to Establish Authority\nA structured content plan — practice area pages, FAQ content, and informational articles answering real client questions — helped Google understand the firm's expertise across its core legal specialties, while also capturing long-tail, research-stage traffic that head-term competition would have blocked entirely.\n\n☑ Continuous Monitoring\nWeekly Search Console analysis identified which pages were gaining traction, which needed reinforcement, and where new keyword opportunities were emerging — allowing the strategy to adapt in real time rather than running on a fixed plan.",
                'implementation' => "New websites don't get penalized for being new — they get overlooked because they haven't yet given Google a reason to trust them. By fixing the technical foundation first, targeting realistic keyword opportunities instead of the most competitive terms out of the gate, and building genuine topical authority through content, the site earned visibility Google could justify — which is why the growth held and compounded instead of stalling after an initial bump.",
                'results' => "The growth curve tells the real story: for the first few weeks after launch, clicks and impressions sat close to zero — the expected reality for any brand-new domain with no search history. From there, the trend broke upward and kept climbing through the full four-month window, with impressions and clicks both showing a clear, sustained acceleration rather than a single spike.\n\nBy the end of the period, the site had earned 2.42K organic clicks and 56.8K impressions, with an average position of 12.9 — meaning the firm was now regularly appearing on page 1–2 for its target legal search terms. This organic visibility was achieved without relying on paid advertising for organic search traffic.\n\nStarting from a website with zero search visibility, zero keyword rankings, and no backlink or trust history, the firm reached page 1–2 visibility (average position 12.9) across dozens of legal search terms within four months — without any paid advertising.",
                'stats' => [
                    ['label' => 'Organic clicks', 'value' => '2.42K'],
                    ['label' => 'Impressions', 'value' => '56.8K'],
                    ['label' => 'Avg CTR', 'value' => '3.9%'],
                    ['label' => 'Avg position', 'value' => '12.9'],
                ],
                'service_category' => 'New Website SEO',
                'featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'featured_image' => $lawFeatured,
                'excerpt' => 'Industry: Law Firm | Location: Texas, USA | New website SEO launch from zero visibility to 2.42K clicks and average position 12.9 in four months.',
                'meta_title' => 'Law Firm New Website SEO Case Study | Veenso',
                'meta_description' => 'How a Texas law firm went from zero search visibility to 2.42K organic clicks and page 1–2 rankings in four months.',
                '_gallery' => [
                    [
                        'source' => 'law-firm-new-site-seo.png',
                        'dest' => 'uploads/case-studies/gallery/law-firm-new-site-seo.png',
                        'alt' => 'Google Search Console: first 4 months Jan–Apr 2024',
                        'caption' => 'From zero to 2.42K clicks and 56.8K impressions in the first four months after launch.',
                    ],
                ],
            ],
        ];

        $keptSlugs = [];

        foreach ($studies as $study) {
            $gallery = $study['_gallery'] ?? [];
            unset($study['_gallery']);

            $caseStudy = CaseStudy::query()->updateOrCreate(['slug' => $study['slug']], $study);
            $keptSlugs[] = $caseStudy->slug;

            foreach ($gallery as $index => $image) {
                $path = $this->installDemoAsset($image['source'], $image['dest']);
                if (! $path) {
                    continue;
                }

                \App\Models\CaseStudyImage::query()->updateOrCreate(
                    [
                        'case_study_id' => $caseStudy->id,
                        'path' => $path,
                    ],
                    [
                        'alt' => $image['alt'] ?? null,
                        'caption' => $image['caption'] ?? null,
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        CaseStudy::query()
            ->whereNotIn('slug', $keptSlugs)
            ->get()
            ->each(function (CaseStudy $caseStudy) {
                $caseStudy->images()->delete();
                $caseStudy->delete();
            });
    }

    private function installDemoAsset(string $filename, string $dest): ?string
    {
        $source = storage_path('app/demo-assets/'.$filename);

        if (! is_file($source)) {
            return null;
        }

        Storage::disk('public')->put($dest, file_get_contents($source));

        return $dest;
    }

    private function importTestimonials(): void
    {
        $sarah = $this->makeSvgImage('uploads/testimonials/sarah-chen.svg', 'SC', '#BE185D', '#831843');
        $marcus = $this->makeSvgImage('uploads/testimonials/marcus-webb.svg', 'MW', '#1D4ED8', '#1E3A8A');
        $elena = $this->makeSvgImage('uploads/testimonials/elena-rodriguez.svg', 'ER', '#047857', '#064E3B');

        $testimonials = [
            [
                'name' => 'Sarah Chen',
                'role' => 'VP of Marketing',
                'company' => 'Atlas Commerce',
                'quote' => 'Veenso did not just redesign our store — they rebuilt our entire acquisition system. Revenue per session up 41%, ROAS nearly doubled, and we finally have analytics we trust. They operate like an extension of our team, not a vendor.',
                'avatar' => $sarah,
                'rating' => 5,
                'status' => 'published',
                'sort_order' => 1,
            ],
            [
                'name' => 'Marcus Webb',
                'role' => 'CEO',
                'company' => 'Northwind Labs',
                'quote' => 'Our rebrand was not cosmetic — Veenso repositioned us for enterprise buyers and rebuilt every touchpoint to match. Pipeline from enterprise accounts increased 2.3X within two quarters of launch.',
                'avatar' => $marcus,
                'rating' => 5,
                'status' => 'published',
                'sort_order' => 2,
            ],
            [
                'name' => 'Elena Rodriguez',
                'role' => 'Director of Growth',
                'company' => 'Summit Financial',
                'quote' => 'We went from 12 non-branded keywords to 340 in twelve months. Veenso tied every SEO recommendation to lead volume and revenue — the most transparent agency relationship we have had.',
                'avatar' => $elena,
                'rating' => 5,
                'status' => 'published',
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::query()->updateOrCreate(
                ['name' => $testimonial['name'], 'company' => $testimonial['company']],
                $testimonial
            );
        }
    }

    private function importFaqs(): void
    {
        $faqs = [
            [
                'question' => 'What makes Veenso different from other agencies?',
                'answer' => 'We are strategy-first and outcome-accountable. Every engagement starts with business goals, not service menus. You get transparent reporting tied to revenue and pipeline — not vanity metrics — and a single team that integrates SEO, web, paid, and brand instead of siloed vendors.',
                'category' => 'General',
                'status' => 'published',
                'sort_order' => 1,
            ],
            [
                'question' => 'What is your typical engagement model?',
                'answer' => 'Most clients work with us on monthly retainers for ongoing SEO, marketing, or ads management. Project-based engagements cover website builds, rebrands, and one-time audits. We scope based on your goals and provide clear deliverables and KPIs upfront.',
                'category' => 'General',
                'status' => 'published',
                'sort_order' => 2,
            ],
            [
                'question' => 'How do you measure success?',
                'answer' => 'We define success metrics during onboarding — typically revenue, leads, ROAS, organic traffic quality, or conversion rate depending on the engagement. Monthly dashboards show progress against these KPIs with clear commentary on what we are doing next.',
                'category' => 'General',
                'status' => 'published',
                'sort_order' => 3,
            ],
            [
                'question' => 'Do you work with startups or only established companies?',
                'answer' => 'Both. We work with Series A startups building their first growth engine and established companies optimizing existing channels. The common thread is clients who value strategy and measurable outcomes over cheap execution.',
                'category' => 'General',
                'status' => 'published',
                'sort_order' => 4,
            ],
            [
                'question' => 'How long does a website project take?',
                'answer' => 'Marketing sites typically take 6–10 weeks. E-commerce migrations and custom Laravel builds run 10–16 weeks. Timelines depend on scope, content readiness, and revision cycles. We provide a detailed timeline during discovery.',
                'category' => 'Services',
                'status' => 'published',
                'sort_order' => 5,
            ],
            [
                'question' => 'Can you work with our existing marketing team?',
                'answer' => 'Yes. We frequently collaborate with in-house teams — providing strategy, overflow execution, or specialized expertise in SEO, paid media, or development while your team handles day-to-day operations.',
                'category' => 'Partnership',
                'status' => 'published',
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(['question' => $faq['question']], $faq);
        }
    }

    private function importBlogPosts(): void
    {
        $img1 = $this->makeSvgImage('uploads/blog/website-growth-asset.svg', 'Website Growth', '#0EA5E9', '#0369A1');
        $img2 = $this->makeSvgImage('uploads/blog/seo-2025.svg', 'SEO 2025', '#10B981', '#047857');
        $img3 = $this->makeSvgImage('uploads/blog/fragmented-marketing.svg', 'Fragmented Marketing', '#F59E0B', '#B45309');
        $img4 = $this->makeSvgImage('uploads/blog/brand-digital.svg', 'Brand Digital', '#EC4899', '#BE185D');

        $posts = [
            [
                'title' => 'Why Your Website Is Your Highest-Leverage Growth Asset',
                'slug' => 'website-highest-leverage-growth-asset',
                'excerpt' => 'Most companies treat their website as a brochure. The ones winning in 2025 treat it as a conversion engine integrated with their entire growth stack.',
                'content' => "Your website is not a cost center. It is the single asset that every marketing channel points to — paid ads, organic search, email, social, referrals. When it underperforms, every dollar you spend on acquisition works harder for less return.\n\n## The three failure modes we see most often\n\n**Speed kills conversions.** A one-second delay in page load reduces conversions by 7%. If your site loads in four seconds on mobile, you are leaving revenue on the table before a visitor reads a single word.\n\n**Design without data.** Beautiful sites that ignore user behavior data convert poorly. We design against heatmaps, session recordings, and funnel analytics — not subjective preferences.\n\n**Disconnected stack.** If GA4, your CRM, and your email platform are not wired into your site from launch, you are flying blind on attribution.\n\n## What high-performing sites do differently\n\nThey treat launch as the beginning, not the end. Post-launch CRO testing, performance monitoring, and content iteration are built into the engagement — not optional add-ons.\n\nThey choose platform based on requirements, not preference. Shopify for e-commerce. Webflow for marketing sites. Laravel for custom applications. The platform serves the strategy.\n\nThey integrate analytics before the first visitor arrives. GA4, GTM, conversion events, and CRM tracking are configured during development — not patched on after launch.\n\n## The bottom line\n\nCompanies that invest in their website as a growth asset see compounding returns across every channel. Those that treat it as a one-time project keep paying acquisition costs without improving efficiency.\n\nIf your site is slow, outdated, or disconnected from your marketing stack, that is not a design problem — it is a revenue problem.",
                'featured_image' => $img1,
                'author' => 'Veenso Team',
                'category' => 'Strategy',
                'tags' => ['Web Development', 'Conversion Optimization', 'Growth Strategy'],
                'status' => 'published',
                'published_at' => now()->subDays(14),
                'meta_title' => 'Why Your Website Is Your Highest-Leverage Growth Asset | Veenso',
                'meta_description' => 'Your website is the asset every marketing channel points to. Here is why underperformance is a revenue problem, not a design problem.',
            ],
            [
                'title' => 'SEO in 2025: What Actually Moves the Needle',
                'slug' => 'seo-2025-what-moves-the-needle',
                'excerpt' => 'Keyword stuffing and link schemes are dead. Here is what is driving organic growth for our clients this year.',
                'content' => "SEO in 2025 is not about gaming algorithms. It is about building genuine topical authority, technical excellence, and content that matches search intent to business outcomes.\n\n## Technical foundation still wins\n\nCore Web Vitals, crawl efficiency, and proper indexation remain non-negotiable. We still find enterprise sites with fundamental technical issues blocking 30–40% of their content from ranking. Fix the foundation before scaling content.\n\n## Topical authority over keyword volume\n\nGoogle rewards sites that comprehensively cover a topic cluster — not pages targeting individual keywords in isolation. Our highest-performing clients build pillar content with supporting articles that interlink strategically.\n\n## AI search is the next frontier\n\nChatGPT, Perplexity, and Google AI Overviews are changing how people discover brands. Structured data, entity optimization, and authoritative content formats are becoming as important as traditional ranking factors.\n\n## Measurement must tie to revenue\n\nRankings and traffic are inputs, not outcomes. We track organic leads, pipeline contribution, and revenue attribution. If SEO cannot connect to business results, the strategy needs revision.\n\n## What to do next\n\nAudit your technical health. Map your keyword clusters to funnel stages. Build content that answers real buyer questions. And measure what matters — not what is easy to report.",
                'featured_image' => $img2,
                'author' => 'Veenso Team',
                'category' => 'SEO',
                'tags' => ['SEO', 'AI Search', 'Content Strategy'],
                'status' => 'published',
                'published_at' => now()->subDays(7),
                'meta_title' => 'SEO in 2025: What Actually Moves the Needle | Veenso',
                'meta_description' => 'Technical excellence, topical authority, and AI search optimization — the SEO strategies driving results in 2025.',
            ],
            [
                'title' => 'The Real Cost of Fragmented Marketing',
                'slug' => 'real-cost-fragmented-marketing',
                'excerpt' => 'Five vendors, five strategies, zero accountability. Here is what fragmentation actually costs — and how to fix it.',
                'content' => "The average mid-market company works with 3–5 marketing vendors simultaneously: an SEO agency, a paid ads freelancer, a web developer, a social media manager, and maybe a branding studio. Each operates independently. None owns the outcome.\n\n## What fragmentation costs you\n\n**Attribution chaos.** When SEO, paid, and email vendors each report in their own tools with their own definitions, you cannot answer the basic question: which channel drove this sale?\n\n**Strategy conflicts.** Your SEO team publishes content your paid team would never bid on. Your social team promotes offers your email team has not set up nurture flows for. Channels compete instead of complement.\n\n**Hidden overhead.** Managing five vendor relationships, five invoices, five reporting formats, and five communication threads consumes 10–15 hours per month of internal time — time your team should spend on strategy.\n\n## The integrated alternative\n\nOne partner. One strategy. One reporting dashboard. Channels designed to work together from the start.\n\nThis does not mean doing everything in-house. It means having one team that owns the strategy and coordinates execution — whether that execution happens internally or through specialized resources under one roof.\n\n## How to evaluate your current setup\n\nAsk: Can I trace a customer from first touch to purchase across all channels in one report? Do my vendors collaborate or compete? Does any single partner own my growth KPIs?\n\nIf the answers are no, fragmentation is costing you more than you think.",
                'featured_image' => $img3,
                'author' => 'Veenso Team',
                'category' => 'Strategy',
                'tags' => ['Marketing Strategy', 'Agency Partnership', 'ROI'],
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'meta_title' => 'The Real Cost of Fragmented Marketing | Veenso',
                'meta_description' => 'Five vendors, five strategies, zero accountability. What marketing fragmentation actually costs and how to fix it.',
            ],
            [
                'title' => 'Building a Brand That Performs in Digital Channels',
                'slug' => 'brand-that-performs-digital',
                'excerpt' => 'A brand identity that looks great in a PDF but fails on Instagram, Google Ads, and your homepage is not a brand system — it is a poster.',
                'content' => "Brand identity work often stops at the logo and color palette. The result: a visual system that looks polished in a brand book but falls apart when applied to a LinkedIn ad, a mobile product page, or a Google Display banner.\n\n## Design for channels, not portfolios\n\nEvery brand element should be tested against real application contexts: social thumbnails at 40px, hero images at full bleed, product photography on white backgrounds, and ad creatives with text overlay.\n\n## Verbal identity is half the equation\n\nYour tone of voice, messaging hierarchy, and value proposition matter as much as your logo. We develop verbal and visual identity together — because a beautiful brand that cannot write a compelling headline fails at the first touchpoint.\n\n## Guidelines that teams actually use\n\nA 60-page brand book nobody reads is wasted investment. We deliver practical guidelines with templates, asset libraries, and channel-specific specs that marketing and sales teams use daily.\n\n## Brand as a growth lever\n\nStrong brands reduce acquisition costs, increase conversion rates, and command premium pricing. Weak brands force you to compete on price and outspend on ads.\n\nInvest in a brand system built for performance — not just aesthetics.",
                'featured_image' => $img4,
                'author' => 'Veenso Team',
                'category' => 'Branding',
                'tags' => ['Branding', 'Digital Marketing', 'Brand Strategy'],
                'status' => 'published',
                'published_at' => now()->subDay(),
                'meta_title' => 'Building a Brand That Performs in Digital Channels | Veenso',
                'meta_description' => 'Brand identity built for digital performance — not just aesthetics. How to create systems that work across every channel.',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::query()->updateOrCreate(['slug' => $post['slug']], $post);
        }
    }

    private function importPages(): void
    {
        $aboutImage = $this->makeSvgImage('uploads/pages/about.svg', 'About Veenso', '#0B1220', '#334155');

        $pages = [
            [
                'title' => 'About',
                'slug' => 'about',
                'meta_title' => 'About Veenso | Strategy-First Digital Growth Agency',
                'meta_description' => 'Veenso is a digital growth agency built on strategy, transparency, and measurable outcomes. Learn about our team, approach, and values.',
                'hero_headline' => 'We build growth systems, not campaigns.',
                'hero_subheadline' => 'Veenso partners with brands that measure what matters.',
                'content' => "Veenso was founded on a simple premise: most agencies sell tactics without strategy, and report vanity metrics instead of revenue. We built the agency we wished existed — one that integrates SEO, web, paid, and brand under a single growth strategy with transparent, accountable reporting.\n\n## Our approach\n\nEvery engagement starts with your business goals. We reverse-engineer the channels, assets, and systems needed to hit those targets — then execute with weekly optimization cadences and monthly performance reviews.\n\nWe do not believe in black-box reporting or long-term contracts that lock you in. You see exactly what we are doing, why we are doing it, and what it is producing.\n\n## Who we work with\n\nGrowth-stage B2B SaaS companies, e-commerce brands, and professional services firms investing \$5K–\$50K/month in digital growth. Our clients value partnership over vendor relationships and outcomes over activity.\n\n## By the numbers\n\n- 120%+ average revenue growth for retained clients\n- 4.5X average marketing ROI within 12 months\n- \$8M+ in client revenue attributed to our campaigns\n- 95% client retention rate\n- 4 regions served globally",
                'content_blocks' => [
                    ['type' => 'stats', 'items' => ['120%+ revenue growth', '4.5X ROI', '$8M+ attributed revenue', '95% retention']],
                    ['type' => 'values', 'items' => ['Strategy before tactics', 'Transparent reporting', 'Accountable outcomes', 'Long-term partnership']],
                    ['type' => 'team', 'eyebrow' => 'Our Team', 'title' => 'The people behind the strategy'],
                    ['type' => 'testimonials', 'eyebrow' => 'Client Voices', 'title' => "What it's like to work with us"],
                    ['type' => 'cta', 'title' => "Let's build your growth system", 'button' => 'Book a Strategy Call'],
                ],
                'status' => 'published',
                'featured_image' => $aboutImage,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'meta_title' => 'Privacy Policy | Veenso',
                'meta_description' => 'Veenso privacy policy — how we collect, use, and protect your personal information.',
                'hero_headline' => 'Privacy Policy',
                'hero_subheadline' => 'Last updated: July 2025',
                'content' => "## Information We Collect\n\nWe collect information you provide directly — name, email, phone number, and message content when you submit our contact form. We also collect standard analytics data via Google Analytics 4, including pages visited, referral source, device type, and general location.\n\n## How We Use Your Information\n\nContact form submissions are used to respond to your inquiry and, with your consent, to send relevant communications about our services. Analytics data is used to improve our website experience and understand audience behavior.\n\n## Data Sharing\n\nWe do not sell your personal information. We share data only with service providers necessary to operate our business (email delivery, analytics, CRM) under strict data processing agreements.\n\n## Your Rights\n\nYou may request access to, correction of, or deletion of your personal data at any time by contacting hello@veenso.com. California residents have additional rights under CCPA.\n\n## Cookies\n\nWe use essential cookies for site functionality and analytics cookies (GA4) to understand usage patterns. You may disable analytics cookies through your browser settings.\n\n## Contact\n\nFor privacy-related inquiries: hello@veenso.com",
                'status' => 'published',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms',
                'meta_title' => 'Terms of Service | Veenso',
                'meta_description' => 'Veenso terms of service — conditions governing use of our website and services.',
                'hero_headline' => 'Terms of Service',
                'hero_subheadline' => 'Last updated: July 2025',
                'content' => "## Acceptance of Terms\n\nBy accessing veenso.com or engaging our services, you agree to these terms. If you do not agree, please do not use our website or services.\n\n## Services\n\nVeenso provides digital marketing, web development, branding, and related consulting services. Specific deliverables, timelines, and fees are defined in individual service agreements or statements of work.\n\n## Intellectual Property\n\nContent on this website — including text, graphics, logos, and design — is owned by Veenso and protected by applicable copyright laws. Client deliverables are governed by the intellectual property terms in each service agreement.\n\n## Limitation of Liability\n\nVeenso provides services on a best-effort basis. We do not guarantee specific rankings, traffic levels, or revenue outcomes. Our liability is limited to the fees paid for the specific service giving rise to the claim.\n\n## Payment Terms\n\nFees are due as specified in your service agreement. Monthly retainers are billed in advance. Project-based work follows milestone payment schedules defined at engagement start.\n\n## Termination\n\nEither party may terminate a retainer engagement with 30 days written notice. Project-based engagements follow termination terms defined in the statement of work.\n\n## Governing Law\n\nThese terms are governed by the laws of the State of California. Disputes shall be resolved in San Francisco County courts.\n\n## Contact\n\nQuestions about these terms: hello@veenso.com",
                'status' => 'published',
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'meta_title' => 'Services | Veenso',
                'meta_description' => "Explore Veenso's full-funnel digital services — SEO, marketing, web design & development, branding, paid ads, and more. Strategy-first, outcome-accountable.",
                'hero_headline' => 'Growth services engineered to move revenue, not just metrics',
                'hero_subheadline' => 'Every Veenso service is designed to integrate with the others — so your SEO, brand, web, and paid strategies compound instead of compete.',
                'content' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'meta_title' => 'Portfolio | Veenso',
                'meta_description' => "Browse Veenso's portfolio of websites, brand systems, and campaigns — built for measurable conversion and growth outcomes.",
                'hero_headline' => 'Work that blends craft with conversion',
                'hero_subheadline' => 'A selection of websites, brand systems, and campaigns delivered for clients across industries.',
                'content' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Case Studies',
                'slug' => 'case-studies',
                'meta_title' => 'Case Studies | Veenso',
                'meta_description' => 'Real client results from Veenso — organic traffic growth, revenue-per-session lifts, and brand repositioning backed by data.',
                'hero_headline' => "Outcomes we can point to, not just work we're proud of",
                'hero_subheadline' => 'Every case study below ties strategy to a measurable business result — revenue, traffic, or pipeline.',
                'content' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Blog',
                'slug' => 'blog',
                'meta_title' => 'Blog | Veenso',
                'meta_description' => 'Strategy notes on SEO, marketing, branding, and web from the Veenso team — grounded in what actually drives growth.',
                'hero_headline' => 'Strategy notes from the Veenso team',
                'hero_subheadline' => 'Perspectives on SEO, marketing, brand, and web — grounded in what actually moves the needle.',
                'content' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'meta_title' => 'Contact Veenso | Book a Strategy Call',
                'meta_description' => 'Get in touch with Veenso to discuss SEO, marketing, web development, or branding for your business. Book a strategy call today.',
                'hero_headline' => "Let's build a strategy tied to your goals",
                'hero_subheadline' => "Tell us a bit about your business and what you're trying to achieve. We'll follow up within one business day.",
                'content' => null,
                'status' => 'published',
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'meta_title' => 'Frequently Asked Questions | Veenso',
                'meta_description' => 'Answers to common questions about working with Veenso — engagement models, timelines, pricing, and how we measure success.',
                'hero_headline' => 'Questions worth answering upfront',
                'hero_subheadline' => 'Everything you need to know before booking a strategy call.',
                'content' => null,
                'status' => 'published',
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page);
        }
    }

    private function importTeamMembers(): void
    {
        $alex = $this->makeSvgImage('uploads/team/alex-rivera.svg', 'Alex Rivera', '#0F172A', '#334155');
        $jordan = $this->makeSvgImage('uploads/team/jordan-kim.svg', 'Jordan Kim', '#1E3A8A', '#3B82F6');
        $priya = $this->makeSvgImage('uploads/team/priya-sharma.svg', 'Priya Sharma', '#064E3B', '#10B981');

        $members = [
            [
                'name' => 'Alex Rivera',
                'role' => 'Founder & CEO',
                'bio' => 'Alex founded Veenso after a decade leading growth at B2B SaaS companies. He built the agency around the principle that digital growth should be measurable, transparent, and strategy-led — not a black box of tactics.',
                'photo' => $alex,
                'sort_order' => 1,
                'status' => 'published',
            ],
            [
                'name' => 'Jordan Kim',
                'role' => 'Head of Strategy',
                'bio' => 'Jordan leads client strategy across SEO, paid media, and web engagements. Previously at a top-tier performance agency, she brings a data-first approach to every growth roadmap.',
                'photo' => $jordan,
                'sort_order' => 2,
                'status' => 'published',
            ],
            [
                'name' => 'Priya Sharma',
                'role' => 'Lead Developer',
                'bio' => 'Priya architects and builds the web platforms that power our clients\' growth — from Shopify storefronts to custom Laravel applications. She ensures every build meets performance, accessibility, and SEO standards.',
                'photo' => $priya,
                'sort_order' => 3,
                'status' => 'published',
            ],
        ];

        foreach ($members as $member) {
            TeamMember::query()->updateOrCreate(['name' => $member['name']], $member);
        }
    }
}
