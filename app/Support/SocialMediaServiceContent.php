<?php

namespace App\Support;

class SocialMediaServiceContent
{
    /**
     * Full Social Media Marketing service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Social Media Marketing',
            'slug' => 'social-media-marketing',
            'summary' => 'Strategic content and community growth engineered to convert followers into paying customers, not just likes.',
            'headline' => 'Turn Social Content Into a Consistent Pipeline of Qualified Leads',
            'description' => "Your social pages are often the first real look a potential customer gets at your business — before they even visit your website. And social growth isn't a campaign with an end date; it's an ongoing relationship-building channel that compounds month over month.\n\nConsistent social presence builds a community asset — an audience you can market to directly, again and again, without paying for reach every time.\n\nSocial Media Marketing is the process of building brand visibility, community trust, and qualified demand across platforms like Facebook, Instagram, LinkedIn, and TikTok — through a mix of strategic content, community management, and paid promotion.",
            'icon' => 'share',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => '2+ hrs', 'label' => 'Average person spends 2+ hours/day on social platforms'],
                ['value' => 'Video', 'label' => 'content gets significantly more reach than static posts'],
                ['value' => 'Consistent', 'label' => 'brands posting regularly see measurably higher engagement'],
                ['value' => 'Pre-buy', 'label' => "Most buyers check a brand's social presence before purchasing"],
            ],
            'sub_services' => [
                ['title' => 'Content Strategy', 'description' => 'Platform selection, audience research, content pillars, and competitor benchmarking that give every post a job.'],
                ['title' => 'Community Management', 'description' => 'Comment/DM responses, engagement monitoring, and follower growth tactics that turn casual followers into a loyal audience.'],
                ['title' => 'Platform-Specific Content', 'description' => 'Reels, carousels, Stories, and static posts designed for each platform — not one-size-fits-all recycling.'],
                ['title' => 'Paid Social Advertising', 'description' => 'Boosted reach and conversion campaigns that amplify what organic content already proves works.'],
                ['title' => 'Performance Reporting', 'description' => 'Monthly analytics covering reach, engagement, growth, and content performance insights you can act on.'],
            ],
            'problems' => [
                'Low engagement',
                'Followers don\'t convert',
                'Posting feels random',
                'Comments/DMs go unanswered',
            ],
            'problem_matrix' => [
                ['problem' => 'Low engagement', 'why' => 'Inconsistent, generic content', 'fix' => 'Strategic content calendar & creative direction'],
                ['problem' => 'Followers don\'t convert', 'why' => 'No clear funnel from post to sale', 'fix' => 'CTA-driven content & landing page tie-ins'],
                ['problem' => 'Posting feels random', 'why' => 'No content pillars/strategy', 'fix' => 'Defined content pillars per platform'],
                ['problem' => 'Comments/DMs go unanswered', 'why' => 'No community management', 'fix' => 'Dedicated engagement & response handling'],
            ],
            'benefits' => [
                ['title' => 'Strategy', 'description' => 'Give your content a clear reason to convert, not just entertain. Platform selection, audience research, content pillars, competitor benchmarking.'],
                ['title' => 'Content Production', 'description' => 'Stay consistently visible without the daily workload. Monthly content calendar, reels/short-form videos, carousel & static posts, captions & hashtags.'],
                ['title' => 'Community Management', 'description' => 'Turn casual followers into a responsive, loyal audience. Comment/DM responses, engagement monitoring, follower growth tactics.'],
                ['title' => 'Reporting', 'description' => 'Know exactly what\'s working and why, every month. Monthly analytics, reach/engagement/growth tracking, content performance insights.'],
            ],
            'deliverables' => [
                'Monthly Content Calendar',
                'Branded Post & Reel Designs',
                'Community Management Log',
                'Monthly Performance Report',
            ],
            'gains' => [
                'Higher engagement & reach',
                'Consistent, on-brand content',
                'Real community, not vanity followers',
                'Clear monthly performance data',
                'A feed that supports ads & SEO efforts too',
            ],
            'tools' => ['Meta Business Suite', 'Canva Pro', 'Adobe Creative Cloud', 'Buffer', 'Metricool'],
            'metrics_table' => [
                ['metric' => 'Engagement rate', 'before' => 'Flat/low', 'after' => 'Steady month-on-month growth'],
                ['metric' => 'Follower quality', 'before' => 'Mixed', 'after' => 'Aligned with target customer profile'],
                ['metric' => 'Posting consistency', 'before' => 'Irregular', 'after' => 'Fixed monthly calendar, zero gaps'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Audit Current Social Presence\n• Define Content Pillars & Voice"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Build Monthly Content Calendar\n• Produce & Schedule Content"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Community Engagement (Daily)\n• Track Performance"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Optimize Based on Data\n• Scale Winning Content Formats"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that want social to generate leads — not just likes.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You want social media that generates leads, not just likes',
                'You\'re posting inconsistently or without a clear strategy',
                'You want a content system you don\'t have to manage yourself',
                'You want engagement data tied to real business outcomes',
            ],
            'why_choose' => [
                ['title' => 'Strategy-first', 'description' => 'Not just a posting calendar — every piece of content has a conversion job.'],
                ['title' => 'Real engagement tracking', 'description' => 'We measure what matters to growth, not vanity metrics alone.'],
                ['title' => 'Creative + data together', 'description' => 'Design and performance insights work as one system.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, ethical white-hat practices only.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'Social content + conversion strategy built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a new website or a brand identity.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across one or more services, built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'How many posts per month do I need?', 'answer' => 'It depends on the platform and goals — most active brands post 3–5 times a week per platform, plus daily engagement.'],
                ['question' => 'Do you write captions in my brand voice?', 'answer' => 'Yes — we build a voice/tone guide first so every caption sounds like you, not generic marketing copy.'],
                ['question' => 'Can you run my Instagram and Facebook together?', 'answer' => 'Yes, most plans cover both, since content can often be adapted across platforms with small adjustments.'],
                ['question' => 'What if I already have some content ideas?', 'answer' => 'We\'re happy to incorporate your ideas into the monthly calendar alongside our strategy recommendations.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free Social Growth Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 5,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Social Media Marketing | Veenso',
            'meta_description' => 'Turn social content into qualified leads. Strategy, content production, community management, and reporting for Facebook, Instagram, LinkedIn, and TikTok.',
        ];
    }
}
