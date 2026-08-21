<?php

namespace App\Support;

class GoogleMetaAdsServiceContent
{
    /**
     * Full Google & Meta Ads service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Google & Meta Ads',
            'slug' => 'google-meta-ads',
            'summary' => 'Every dollar spent is tracked back to a result, so your budget shifts toward what\'s proven to work.',
            'headline' => 'Turn Ad Spend Into Tracked, Predictable Revenue',
            'description' => "Ads can generate leads immediately — but only when targeting, creative, and tracking are set up correctly. Most wasted ad spend comes from broken tracking or the wrong audience, not the platform itself. And ad accounts need continuous optimization, not a one-time launch, to keep costs down as platforms change.\n\nEvery dollar spent is tracked back to a result — so your budget shifts toward what's proven to work, not what simply used up the spend.\n\nGoogle & Meta Ads is data-driven paid advertising across Google Search, Display, YouTube, Facebook, and Instagram — built on audience research, conversion tracking, and continuous testing so ad spend turns into measurable revenue, not just impressions.",
            'icon' => 'megaphone',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Higher', 'label' => 'Paid search visitors convert at notably higher rates than average web traffic'],
                ['value' => 'Wasted', 'label' => 'Most ad accounts leave performance on the table due to poor targeting/tracking'],
                ['value' => 'Retarget', 'label' => 'Retargeted ads see significantly higher click-through than cold audiences'],
                ['value' => 'Video', 'label' => 'ad creative typically outperforms static image ads on cost-per-result'],
            ],
            'sub_services' => [
                ['title' => 'Google Search & Shopping Ads', 'description' => 'Capture customers already searching for exactly what you offer with Search, Display, and Shopping campaigns.'],
                ['title' => 'Meta (Facebook/Instagram) Ads', 'description' => 'Reach and re-engage the audiences most likely to buy across Facebook and Instagram.'],
                ['title' => 'Display & Remarketing Campaigns', 'description' => 'Recover almost-customers with retargeting that brings intent back into the funnel.'],
                ['title' => 'Conversion Tracking & Analytics', 'description' => 'Full pixel, GA4, and conversion setup so every result is measurable from day one.'],
                ['title' => 'Creative & Copy Testing', 'description' => 'Ongoing A/B testing of ad creative and copy to keep cost-per-result falling over time.'],
            ],
            'problems' => [
                'High ad spend, few results',
                'Can\'t tell what\'s working',
                'Ad fatigue, rising costs',
                'Leads come in but don\'t convert',
            ],
            'problem_matrix' => [
                ['problem' => 'High ad spend, few results', 'why' => 'Poor targeting/audience setup', 'fix' => 'Precision audience research & segmentation'],
                ['problem' => 'Can\'t tell what\'s working', 'why' => 'No proper conversion tracking', 'fix' => 'Full pixel/analytics & conversion setup'],
                ['problem' => 'Ad fatigue, rising costs', 'why' => 'Same creative running too long', 'fix' => 'Ongoing A/B creative testing'],
                ['problem' => 'Leads come in but don\'t convert', 'why' => 'Landing page/offer mismatch', 'fix' => 'Landing page & funnel alignment'],
            ],
            'benefits' => [
                ['title' => 'Strategy & Setup', 'description' => 'Make sure every dollar has a clear job before it\'s spent. Account audit/setup, audience research, campaign structure planning.'],
                ['title' => 'Google Ads', 'description' => 'Capture the customers already searching for exactly what you offer. Search, Display, Shopping campaign management.'],
                ['title' => 'Meta Ads', 'description' => 'Reach and re-engage the exact audience most likely to buy. Facebook & Instagram campaign management, retargeting setups.'],
                ['title' => 'Creative Testing', 'description' => 'Keep cost-per-result falling instead of rising over time. Ad copy & creative A/B testing, landing page alignment.'],
                ['title' => 'Tracking & Reporting', 'description' => 'Know exactly what your ad spend is actually producing. Pixel/conversion tracking setup, weekly performance reports, spend optimization.'],
            ],
            'deliverables' => [
                'Ad Account Audit Report',
                'Conversion Tracking Setup',
                'Campaign Structure Document',
                'Weekly Performance Reports',
                'Monthly Optimization Summary',
            ],
            'gains' => [
                'Ads shown to people actually likely to buy',
                'Full visibility into what\'s working (and what\'s not)',
                'Budget spent on results, not guesswork',
                'Lower cost-per-lead over time through testing',
                'Retargeting that recovers "almost-customers"',
            ],
            'tools' => ['Google Ads', 'Meta Ads Manager', 'GA4', 'Google Tag Manager'],
            'metrics_table' => [
                ['metric' => 'Cost per lead', 'before' => 'High, inconsistent', 'after' => 'Steadily optimized down'],
                ['metric' => 'Conversion tracking', 'before' => 'Missing/incomplete', 'after' => 'Fully accurate attribution'],
                ['metric' => 'Ad creative', 'before' => 'Single static set', 'after' => 'Rotating tested variations'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Ad Account & Tracking Audit\n• Audience & Keyword Research"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Campaign Structure Build\n• Creative & Copy Development"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Launch & Initial Monitoring\n• A/B Testing & Optimization\n• Weekly Performance Reporting"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Scale Winning Campaigns"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that want ad spend tied to tracked revenue.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You want leads and sales tracked directly to ad spend',
                'You\'ve tried ads before with disappointing or unclear results',
                'You have a website ready to receive paid traffic',
                'You want a partner who reports in plain numbers, not jargon',
            ],
            'why_choose' => [
                ['title' => 'Tracking before spend', 'description' => 'Full tracking setup before a single dollar is spent.'],
                ['title' => 'Ongoing A/B testing', 'description' => 'Not set-and-forget campaigns — continuous creative and audience testing.'],
                ['title' => 'Plain-language reporting', 'description' => 'Weekly performance reports you can actually understand and act on.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, ethical white-hat practices only.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'Full tracking + continuous optimization built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a new website or a brand identity.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across one or more services, built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'How much should I budget for ad spend?', 'answer' => 'Ad spend is separate from our management fee and depends on your goals — we\'ll recommend a realistic starting budget after the audit.'],
                ['question' => 'How soon will I see results?', 'answer' => 'Search/Meta campaigns can start generating clicks and leads within days, though optimization for lower cost-per-result typically takes 2–4 weeks.'],
                ['question' => 'Do you set up conversion tracking?', 'answer' => 'Yes, proper pixel and conversion tracking setup is included from day one so every result is measurable.'],
                ['question' => 'What if my previous ads didn\'t work?', 'answer' => 'We start with a full account and tracking audit to identify exactly what went wrong before rebuilding campaigns.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free Ad Account Growth Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 6,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Google & Meta Ads | Veenso',
            'meta_description' => 'Turn ad spend into tracked, predictable revenue. Google Search, Display, YouTube, Facebook & Instagram ads with full conversion tracking and continuous optimization.',
        ];
    }
}
