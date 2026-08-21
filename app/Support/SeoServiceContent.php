<?php

namespace App\Support;

class SeoServiceContent
{
    /**
     * Full SEO service page payload for seeding / demo install.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'SEO (Search Engine Optimization)',
            'slug' => 'seo',
            'summary' => 'An SEO foundation that consistently increases qualified organic leads and revenue — not just rankings on a report.',
            'headline' => 'Turn Search Traffic Into Booked Consultations and Sales',
            'description' => "Search is where buying decisions begin. A business invisible on page one is invisible to nearly all of its potential customers — no matter how good the product is. SEO isn't a one-time project either — it's an ongoing growth channel that compounds the longer it's actively managed.\n\nUnlike paid ads, SEO keeps generating traffic and leads long after the initial work is done — making it one of the strongest long-term marketing investments a business can make.\n\nSEO (Search Engine Optimization) is the process of improving your website so that search engines and AI-powered platforms can better understand, trust, and recommend your content. It goes beyond keywords — combining technical performance, user experience, content quality, and website authority to help your site become the best answer for your audience.",
            'icon' => 'search',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => '68%', 'label' => 'of online journeys start with a search engine'],
                ['value' => '~10x', 'label' => 'more clicks for position #1 vs position #10'],
                ['value' => '90%+', 'label' => 'of searchers never open page two'],
                ['value' => 'Higher', 'label' => 'close rate for organic leads vs cold outbound'],
            ],
            'sub_services' => [
                ['title' => 'Technical SEO', 'description' => 'Crawlability, indexation, Core Web Vitals, schema, and site architecture that let Google understand and trust your site.'],
                ['title' => 'On-Page SEO', 'description' => 'Keyword mapping, titles, metas, headers, internal linking, and page structure aligned to real search intent.'],
                ['title' => 'Off-Page SEO', 'description' => 'White-hat authority building through outreach, citations, and link campaigns that strengthen competitive position.'],
                ['title' => 'Local SEO', 'description' => 'Google Business Profile, NAP consistency, local keywords, and review strategy to win map-pack searches.'],
                ['title' => 'Semantic & Entity SEO', 'description' => 'Topical depth and entity clarity so search engines associate your brand with the topics that matter.'],
                ['title' => 'Content SEO', 'description' => 'Topic clusters, calendars, snippet targeting, and refreshes that attract and convert high-intent visitors.'],
                ['title' => 'AI Search Optimization (AEO/GEO)', 'description' => 'Structure and authority signals that help AI-powered platforms recommend your business as a trusted answer.'],
            ],
            'problems' => [
                'Ranking on page 2–3 or nowhere',
                'Traffic comes but doesn\'t convert',
                'Slow-loading website',
                'No backlinks / low authority',
                'Poor mobile experience',
            ],
            'problem_matrix' => [
                ['problem' => 'Ranking on page 2–3 or nowhere', 'why' => 'No keyword/content strategy', 'fix' => 'Full keyword mapping + on-page rebuild'],
                ['problem' => 'Traffic comes but doesn\'t convert', 'why' => 'Wrong search intent targeted', 'fix' => 'Intent-matched content & landing pages'],
                ['problem' => 'Slow-loading website', 'why' => 'Unoptimized images/code', 'fix' => 'Core Web Vitals & speed audit'],
                ['problem' => 'No backlinks / low authority', 'why' => 'Weak off-page presence', 'fix' => 'White-hat link building campaigns'],
                ['problem' => 'Poor mobile experience', 'why' => 'Not built mobile-first', 'fix' => 'Responsive UX audit & fixes'],
            ],
            'benefits' => [
                ['title' => 'Technical SEO Foundation', 'description' => 'Full site audit, sitemap & robots.txt setup, crawl error fixes, Core Web Vitals optimization, schema markup, HTTPS/security check — build an SEO foundation that consistently increases qualified organic leads.'],
                ['title' => 'On-Page Optimization', 'description' => 'Keyword research & mapping, title/meta optimization, header structure, image alt text, internal linking — turn existing pages into consistent lead-generating assets.'],
                ['title' => 'Off-Page Authority Building', 'description' => 'Backlink audit, white-hat outreach, guest posting, directory citations — build the trust signals that help you outrank competitors.'],
                ['title' => 'Local SEO', 'description' => 'Google Business Profile setup & optimization, NAP consistency, local keyword targeting, review strategy — win the map-pack searches that turn into calls and visits.'],
                ['title' => 'Content SEO', 'description' => 'Topic clusters, blog content calendar, featured-snippet targeting, content refresh strategy — attract and convert visitors already searching for what you sell.'],
            ],
            'deliverables' => [
                'SEO Audit PDF',
                'Monthly Performance Report',
                'Technical SEO Audit',
                'Keyword Strategy Document',
                'Competitor Analysis',
                'Content Roadmap',
            ],
            'gains' => [
                'Page-one visibility',
                'Lower cost per lead over time',
                'Transparent monthly reporting',
                'Compounding, long-term traffic',
                'High-intent visitors',
                'A ranking advantage competitors can\'t copy overnight',
            ],
            'tools' => ['Ahrefs', 'SEMrush', 'Screaming Frog', 'Google Search Console', 'Google Analytics 4'],
            'metrics_table' => [
                ['metric' => 'Monthly organic traffic', 'before' => 'Low hundreds', 'after' => 'Several thousand within 6–12 months'],
                ['metric' => 'Keywords in Google Top 10', 'before' => 'Single digits', 'after' => '50+'],
                ['metric' => 'Cost per organic lead', 'before' => 'High, unpredictable', 'after' => 'Steadily declining as rankings mature'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Free Website & Ranking Audit\n• Keyword & Competitor Research"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Technical Fixes First\n• On-Page Optimization"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Content Publishing\n• Link Building\n• Monthly Transparent Reporting"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Scale to New Keyword Clusters"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that want qualified organic demand.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You want more qualified leads, not just traffic',
                'You already have a website but it isn\'t ranking',
                'You\'re looking for long-term, compounding growth',
                'You need SEO results tied to measurable ROI',
            ],
            'why_choose' => [
                ['title' => 'Tailored strategies', 'description' => 'Not one-size-fits-all templates — custom strategy for your business.'],
                ['title' => 'Ethical, white-hat only', 'description' => 'Sustainable practices focused on lasting visibility, not temporary spikes.'],
                ['title' => 'Transparent reporting', 'description' => 'Plain-language monthly reporting tied to traffic, rankings, and next actions.'],
                ['title' => 'Dedicated strategist', 'description' => 'One dedicated strategist for your account with weekly communication — not radio silence.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'AI Search (AEO/GEO) expertise built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a technical rebuild or launch SEO package.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across SEO (and related channels), built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'How long does SEO take to show results?', 'answer' => 'Meaningful movement typically starts in 2–4 months, with stronger compounding results building over 6–12 months as authority builds.'],
                ['question' => 'Do you guarantee #1 rankings?', 'answer' => 'No ethical SEO provider can honestly guarantee an exact rank — Google\'s algorithm isn\'t controlled by any agency. We focus on sustainable, white-hat growth instead.'],
                ['question' => 'Will I get reports I can actually understand?', 'answer' => 'Yes — monthly reports are written in plain language covering traffic, rankings, and what we\'re doing next, not just raw data exports.'],
                ['question' => 'What if my site was penalized before?', 'answer' => 'We start with a full technical and backlink audit to identify and fix any past issues before building forward.'],
            ],
            'related_notes' => 'Related services often paired with SEO: AI Search Optimization (AEO/GEO), Google & Meta Ads, and Website Design & Development.',
            'cta_text' => 'Book Your Free Growth Strategy Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 1,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'SEO Services | Veenso — Organic Growth That Converts',
            'meta_description' => 'Turn search traffic into booked consultations and sales. Technical SEO, on-page, local, content, and AI search optimization with transparent reporting.',
        ];
    }
}
