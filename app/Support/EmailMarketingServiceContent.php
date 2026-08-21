<?php

namespace App\Support;

class EmailMarketingServiceContent
{
    /**
     * Full Email Marketing & Lead Generation service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Email Marketing & Lead Generation',
            'slug' => 'email-marketing-lead-generation',
            'summary' => 'Email and lead-generation systems engineered to nurture prospects and increase repeat revenue — not just fill an inbox.',
            'headline' => 'Turn Subscribers and Website Visitors Into Repeat, Paying Customers',
            'description' => "Your website visitors won't always become customers on their first visit — but that doesn't mean the opportunity is lost. Email marketing is one of the most effective ways to nurture relationships, build trust, and guide potential customers toward a confident purchase. And because your email list is an owned asset, it keeps producing value long after any single campaign ends.\n\nUnlike rented audiences on social media or ad platforms, your email list is an owned marketing asset — the relationship keeps paying back with every new campaign you send.\n\nEmail Marketing is the process of building relationships with prospects and customers through relevant, timely, personalized communication. Lead Generation focuses on attracting and capturing potential customers who are genuinely interested in your business, then guiding them through a structured journey until they're ready to buy.",
            'icon' => 'mail',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Top ROI', 'label' => 'Email marketing consistently ranks among the highest-ROI digital marketing channels'],
                ['value' => 'Carts', 'label' => 'Abandoned cart emails recover a meaningful share of otherwise lost sales'],
                ['value' => 'Nurture', 'label' => "Most website visitors don't buy on their first visit — nurturing recovers that opportunity"],
                ['value' => 'Segmented', 'label' => 'email campaigns perform measurably better than generic blasts'],
            ],
            'sub_services' => [
                ['title' => 'Email Marketing Strategy', 'description' => 'Customized strategy based on your business goals, customer journey, and audience segmentation.'],
                ['title' => 'Marketing Automation', 'description' => 'Welcome series, lead nurturing, abandoned cart & browse abandonment, post-purchase follow-up, and win-back sequences.'],
                ['title' => 'Lead Capture Optimization', 'description' => 'Pop-ups, forms, landing pages, exit-intent offers, and lead magnets that capture interested visitors.'],
                ['title' => 'Audience Segmentation', 'description' => 'Segment by purchase history, website activity, interests, location, and buying intent.'],
                ['title' => 'Email Copywriting & Design', 'description' => 'Compelling copy and mobile-friendly, on-brand email design that gets opened, clicked, and converted.'],
                ['title' => 'Performance Analytics', 'description' => 'Open rate, CTR, conversion rate, revenue attribution, and customer lifetime value tracking.'],
            ],
            'problems' => [
                'Website visitors leave and never return',
                'Abandoned carts never recover',
                'Emails feel generic and get ignored',
                'No idea if email is working',
            ],
            'problem_matrix' => [
                ['problem' => 'Website visitors leave and never return', 'why' => 'No lead capture system in place', 'fix' => 'Pop-ups, forms, and lead magnets to capture visitors'],
                ['problem' => 'Abandoned carts never recover', 'why' => 'No automated recovery sequence', 'fix' => 'Abandoned cart & browse abandonment automation'],
                ['problem' => 'Emails feel generic and get ignored', 'why' => 'No segmentation or personalization', 'fix' => 'Behavior and interest-based audience segmentation'],
                ['problem' => 'No idea if email is working', 'why' => 'No performance tracking', 'fix' => 'Full analytics on opens, clicks, and revenue attribution'],
            ],
            'benefits' => [
                ['title' => 'Email Marketing Strategy', 'description' => 'Turn your list into a predictable revenue channel, not just a newsletter. Customized strategy based on goals, customer journey, and segmentation.'],
                ['title' => 'Marketing Automation', 'description' => 'Nurture and recover customers automatically. Welcome series, lead nurturing, abandoned cart & browse abandonment, post-purchase follow-up, win-back sequences.'],
                ['title' => 'Audience Segmentation', 'description' => 'Send the right message to the right person at the right time. Segmentation by purchase history, website activity, interests, location, and buying intent.'],
                ['title' => 'Email Copywriting & Design', 'description' => 'Get subscribers to actually open, click, and buy. Compelling copy and mobile-friendly, on-brand email design.'],
                ['title' => 'Lead Capture Optimization', 'description' => 'Stop losing website visitors who would have converted with the right offer. Pop-ups, embedded forms, landing pages, exit-intent offers, lead magnets.'],
                ['title' => 'Performance Analytics', 'description' => 'Know exactly how much revenue email is generating. Open rate, CTR, conversion rate, revenue attribution, and CLV tracking.'],
            ],
            'deliverables' => [
                'Email Marketing Strategy Document',
                'Automated Workflow Setup (Welcome, Cart Recovery, Win-Back)',
                'Branded Email Templates',
                'Lead Capture Forms & Landing Pages',
                'Monthly Performance Report',
            ],
            'gains' => [
                'A growing, owned marketing asset',
                'Higher repeat purchase and retention rates',
                'Clear revenue attribution from every campaign',
                'Automated recovery of otherwise lost sales',
                'Personalized messaging at scale',
            ],
            'tools' => ['Klaviyo', 'Mailchimp', 'HubSpot', 'ActiveCampaign', 'Shopify Email'],
            'metrics_table' => [
                ['metric' => 'Abandoned cart recovery', 'before' => 'None', 'after' => 'Automated recovery sequence live'],
                ['metric' => 'Email revenue attribution', 'before' => 'Untracked', 'after' => 'Fully attributed per campaign'],
                ['metric' => 'List engagement', 'before' => 'Generic blasts', 'after' => 'Segmented, personalized campaigns'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Customer Journey & List Audit\n• Audience Segmentation Planning"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Automation Workflow Setup\n• Email Copy & Design Production"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• A/B Testing & Deliverability Optimization\n• Performance Analytics Review"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Expand Segmentation & Campaign Cadence"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that want email to nurture leads and drive repeat revenue.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You have website traffic or an email list that isn\'t being nurtured',
                'You want to recover abandoned carts and lost visitors automatically',
                'You want repeat customers, not just one-time sales',
                'You want marketing that keeps working without daily manual effort',
            ],
            'why_choose' => [
                ['title' => 'Strategic journeys', 'description' => 'Customer journeys built for conversion — not generic promotional blasts.'],
                ['title' => 'Automation that keeps working', 'description' => 'Build once, nurture continuously with welcome, cart recovery, and win-back flows.'],
                ['title' => 'Data-backed recommendations', 'description' => 'Every recommendation based on real performance data, not assumptions.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, ethical white-hat practices only.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'Automation + lead capture expertise built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a new website or a brand identity.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across one or more services, built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'Do I need a large email list to start?', 'answer' => 'No — the automation and segmentation strategy matters more than list size, and lead generation can help grow your list alongside it.'],
                ['question' => 'Which email platform do you recommend?', 'answer' => 'It depends on your business model and existing tools — we\'ll recommend the best fit from platforms like Klaviyo, Mailchimp, or HubSpot.'],
                ['question' => 'Can you help me build my email list, not just email it?', 'answer' => 'Yes — lead capture optimization (forms, pop-ups, lead magnets) is part of this service.'],
                ['question' => 'How is success measured?', 'answer' => 'Through open rates, click-through rates, conversion rates, and — most importantly — revenue directly attributed to email campaigns.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free Email Growth Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 7,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Email Marketing & Lead Generation | Veenso',
            'meta_description' => 'Turn subscribers and visitors into repeat customers. Email strategy, automation, segmentation, lead capture, and revenue attribution.',
        ];
    }
}
