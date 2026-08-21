<?php

namespace App\Support;

class WebsiteDesignServiceContent
{
    /**
     * Full Website Design & Development service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Website Design & Development',
            'slug' => 'website-design-development',
            'summary' => 'Not just a fast, modern website — a revenue-generating asset that turns visitors into paying customers.',
            'headline' => 'Websites Engineered to Increase Enquiries, Booked Calls, and Online Sales',
            'description' => "Your website is your digital storefront — open 24/7. A slow, outdated, or confusing site turns paying customers away before they even see what you offer. And a website is never really 'finished' — the best-performing sites are continuously refined based on how real visitors behave.\n\nA well-built website keeps working for you 24/7 — the investment pays back every time it turns a visitor into a customer without any extra ad spend.\n\nWebsite Design & Development is the process of building a fast, functional, conversion-focused website — one that represents your brand accurately, works flawlessly on every device, and gives visitors a clear path to becoming customers.",
            'icon' => 'code',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Seconds', 'label' => 'Most visitors judge credibility by a website within seconds'],
                ['value' => '50%+', 'label' => 'of web traffic today is mobile'],
                ['value' => '1s delay', 'label' => 'can meaningfully drop conversions'],
                ['value' => 'Clear CTAs', 'label' => 'convert noticeably better than cluttered pages'],
            ],
            'sub_services' => [
                ['title' => 'UI/UX Design', 'description' => 'Custom interfaces and user journeys that build trust fast and guide visitors toward clear next actions.'],
                ['title' => 'Responsive Development', 'description' => 'Mobile-first builds that perform cleanly across phones, tablets, and desktops.'],
                ['title' => 'CMS & E-commerce Setup', 'description' => 'WordPress, Shopify, or custom CMS setups that are easy to manage and ready to sell.'],
                ['title' => 'Performance Optimization', 'description' => 'Speed, image compression, hosting guidance, and Core Web Vitals improvements that keep visitors on-page.'],
                ['title' => 'SEO-Ready Architecture', 'description' => 'Clean structure, meta setup, and schema-ready pages so the site can rank from day one.'],
                ['title' => 'Conversion Rate Optimization', 'description' => 'CTA placement, layout hierarchy, and UX decisions designed to increase enquiries and sales.'],
            ],
            'problems' => [
                'Site looks outdated',
                'Slow load times',
                'Visitors leave without acting',
                'Hard to update content',
                'Not mobile-friendly',
            ],
            'problem_matrix' => [
                ['problem' => 'Site looks outdated', 'why' => 'Old template, no design refresh', 'fix' => 'Modern, brand-aligned custom design'],
                ['problem' => 'Slow load times', 'why' => 'Unoptimized images/code/hosting', 'fix' => 'Performance audit & optimization'],
                ['problem' => 'Visitors leave without acting', 'why' => 'Weak or missing CTAs', 'fix' => 'Conversion-focused UX & CTA placement'],
                ['problem' => 'Hard to update content', 'why' => 'No proper CMS setup', 'fix' => 'Easy-to-manage CMS (WordPress/Shopify/custom)'],
                ['problem' => 'Not mobile-friendly', 'why' => 'Desktop-only design approach', 'fix' => 'Mobile-first responsive build'],
            ],
            'benefits' => [
                ['title' => 'Design', 'description' => 'Give visitors a reason to trust you within the first 3 seconds. Custom UI/UX design, brand-matched visuals, wireframing & prototyping.'],
                ['title' => 'Development', 'description' => 'Make sure the site works flawlessly everywhere your customers are. Responsive coding, CMS setup (WordPress/Shopify/custom), e-commerce integration.'],
                ['title' => 'Performance', 'description' => 'Stop losing visitors to slow load times before they even see your offer. Speed optimization, image compression, hosting recommendations.'],
                ['title' => 'SEO-Ready Build', 'description' => 'Give your new site a head start on search visibility from day one. Clean code structure, meta tag setup, schema-ready pages.'],
                ['title' => 'Ongoing Support', 'description' => 'Keep the site secure, fast, and easy to update long after launch. Maintenance, security updates, content edits.'],
            ],
            'deliverables' => [
                'UX Wireframes',
                'Design Mockups (Desktop + Mobile)',
                'Fully Developed Website',
                'CMS Training Walkthrough',
                'Speed & SEO Health Report',
                '30-Day Post-Launch Support',
            ],
            'gains' => [
                'Fast-loading, professional site',
                'Perfect experience on any device',
                'E-commerce ready when needed',
                'SEO-friendly from day one',
                'Easy to update without a developer',
            ],
            'tools' => ['WordPress', 'Shopify', 'Webflow', 'Framer', 'Google PageSpeed Insights', 'GA4', 'Google Tag Manager'],
            'metrics_table' => [
                ['metric' => 'Page load time', 'before' => '5+ seconds', 'after' => 'Under 2–3 seconds'],
                ['metric' => 'Bounce rate', 'before' => 'High', 'after' => 'Significantly reduced'],
                ['metric' => 'Mobile usability', 'before' => 'Poor', 'after' => 'Fully responsive across devices'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Discovery & Requirement Gathering"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Wireframe & Design Mockup\n• Development & CMS Setup"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Content & SEO Integration\n• Testing (speed, devices, browsers)"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Launch\n• Maintenance & Support Plan"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that need a website built to convert.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You want a website that generates enquiries, not just looks nice',
                'Your current site is outdated, slow, or hard to update',
                'You\'re launching a new brand and need a strong first impression',
                'You want a site built with SEO in mind from day one',
            ],
            'why_choose' => [
                ['title' => 'Conversion-focused design', 'description' => 'Not decoration — layouts and CTAs built to generate enquiries and sales.'],
                ['title' => 'Mobile-first from the first wireframe', 'description' => 'Every experience is designed for phones first, then scaled up.'],
                ['title' => 'SEO-ready foundation', 'description' => 'Clean structure and on-page SEO basics included in every build.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, and transparent reporting.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'AI Search (AEO/GEO) expertise built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a new website or a brand identity.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across one or more services, built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'How long does a website take to build?', 'answer' => 'A standard business website typically takes 3–5 weeks; e-commerce or custom builds can take longer depending on scope.'],
                ['question' => 'Will I be able to edit the site myself afterward?', 'answer' => 'Yes — we set up a CMS so you can update text, images, and products without touching code.'],
                ['question' => 'Is SEO included in the website build?', 'answer' => 'Basic on-page SEO structure is included in every build; ongoing SEO campaigns are a separate, dedicated service.'],
                ['question' => 'What if I need changes after launch?', 'answer' => 'Support & maintenance plans are available for ongoing edits, updates, and security monitoring.'],
            ],
            'related_notes' => 'Related services often paired with Website Design & Development: SEO, Branding & Graphic Design, and Product Visuals (Photography & 3D Rendering).',
            'cta_text' => 'Book Your Free Website Growth Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 2,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Website Design & Development | Veenso',
            'meta_description' => 'Websites engineered to increase enquiries, booked calls, and online sales. Conversion-focused design, responsive development, and SEO-ready builds.',
        ];
    }
}
