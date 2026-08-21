<?php

namespace App\Support;

class BrandingServiceContent
{
    /**
     * Full Branding & Graphic Design service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Branding & Graphic Design',
            'slug' => 'branding-graphic-design',
            'summary' => 'A visual identity system engineered to make customers trust and choose you before they read a single word.',
            'headline' => 'Brand Identity That Builds Instant Trust and Higher Perceived Value',
            'description' => "People buy from brands that look established and trustworthy. Inconsistent or amateur visuals quietly cost you credibility — and customers — before they read a single word. Branding also isn't a one-time deliverable; the strongest brands keep their identity refined and consistent as they grow.\n\nA strong brand identity compounds in value — the same logo and guideline system keeps paying off across every future campaign, page, and product launch.\n\nBranding & Graphic Design is the process of creating a consistent visual identity — logo, color, typography, tone — that makes your business instantly recognizable and builds trust before a single word is read.",
            'icon' => 'sparkles',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Higher', 'label' => 'revenue potential from consistent branding across platforms'],
                ['value' => 'Color', 'label' => 'alone can meaningfully affect brand recognition'],
                ['value' => 'Seconds', 'label' => 'Most people form a design opinion within a few seconds'],
                ['value' => 'Trust', 'label' => 'Inconsistent branding is a top reason customers distrust a business'],
            ],
            'sub_services' => [
                ['title' => 'Identity Design', 'description' => 'Logo systems, color palettes, and typography that make your brand instantly recognizable.'],
                ['title' => 'Brand Guidelines', 'description' => 'A clear brand book so every future asset stays consistent without starting from scratch.'],
                ['title' => 'Marketing & Social Design', 'description' => 'Reusable templates and creatives that keep campaigns on-brand and fast to produce.'],
                ['title' => 'Print & Packaging', 'description' => 'Business cards, letterheads, and packaging that feel as premium as your digital brand.'],
                ['title' => 'Rebranding Strategy', 'description' => 'Refresh your image while protecting the equity you have already built.'],
            ],
            'problems' => [
                'Logo looks generic/unprofessional',
                'Inconsistent look across platforms',
                'Social posts look mismatched',
                'Print materials feel outdated',
            ],
            'problem_matrix' => [
                ['problem' => 'Logo looks generic/unprofessional', 'why' => 'No proper design process', 'fix' => 'Custom logo design from concept to final files'],
                ['problem' => 'Inconsistent look across platforms', 'why' => 'No brand guidelines', 'fix' => 'Full brand guideline document (colors, fonts, tone)'],
                ['problem' => 'Social posts look mismatched', 'why' => 'No design templates', 'fix' => 'Branded, reusable social templates'],
                ['problem' => 'Print materials feel outdated', 'why' => 'No cohesive brand system', 'fix' => 'Business cards, letterheads, presentation decks'],
            ],
            'benefits' => [
                ['title' => 'Identity Design', 'description' => 'Give your business a look customers recognize and trust instantly. Logo design & variations, color palette, typography system.'],
                ['title' => 'Brand Guidelines', 'description' => 'Keep every future asset consistent without needing to ask us first. Full brand book, usage rules, tone of voice.'],
                ['title' => 'Marketing Design', 'description' => 'Move faster on daily marketing without hiring an in-house designer. Social media templates, ad creatives, presentation decks.'],
                ['title' => 'Print & Packaging', 'description' => 'Make your brand feel premium in the physical world too. Business cards, letterheads, packaging design.'],
                ['title' => 'Rebranding', 'description' => 'Refresh your image without losing the equity you\'ve already built. Brand refresh for growing/scaling businesses.'],
            ],
            'deliverables' => [
                'Logo Files (PNG, SVG, EPS/AI)',
                'Full Brand Guideline PDF',
                'Social Media Template Pack',
                'Business Card & Letterhead Design',
                'Source Files, Fully Handed Over',
            ],
            'gains' => [
                'A distinct, professional identity',
                'Total visual consistency everywhere',
                'Ready-to-use templates for daily marketing',
                'A brand system that scales as you grow',
                'Packaging & print that match your digital brand',
            ],
            'tools' => ['Adobe Illustrator', 'Adobe Photoshop', 'Figma', 'Canva Pro'],
            'metrics_table' => [
                ['metric' => 'Brand consistency', 'before' => 'Scattered/inconsistent', 'after' => 'Unified guideline-based system'],
                ['metric' => 'Design turnaround', 'before' => 'Ad-hoc requests', 'after' => 'Templated, fast production'],
                ['metric' => 'Perceived credibility', 'before' => 'Generic', 'after' => 'Premium, memorable'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Brand Discovery & Questionnaire"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Mood Board & Concept Direction\n• Logo & Identity Design"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Client Review & Refinement\n• Brand Guideline Document"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Template & Asset Delivery\n• Ongoing Design Support (optional)"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that need identity customers trust instantly.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You\'re launching a new business and need identity from scratch',
                'Your current branding feels inconsistent or outdated',
                'You\'re scaling and need a system, not just a logo',
                'You want print and packaging to match your digital brand',
            ],
            'why_choose' => [
                ['title' => 'Strategy-led design', 'description' => 'Not just decoration — identity decisions tied to how customers perceive and choose you.'],
                ['title' => 'Full brand guideline delivered', 'description' => 'More than a logo — colors, typography, spacing, and tone documented for long-term consistency.'],
                ['title' => 'Source files fully handed over', 'description' => 'No lock-in. You own the files and can scale the system with or without us.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, and transparent process.'],
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
                ['question' => 'What files will I receive for my logo?', 'answer' => 'You\'ll receive all standard formats (PNG, SVG, EPS/AI) with color, black & white, and reversed versions.'],
                ['question' => 'Do you provide a brand guideline document?', 'answer' => 'Yes — every branding package includes a guideline document covering colors, typography, spacing, and tone of voice.'],
                ['question' => 'Can you redesign my existing brand instead of starting fresh?', 'answer' => 'Yes — rebranding projects start with an audit of what\'s working before deciding what to keep or refresh.'],
                ['question' => 'Do you design packaging too?', 'answer' => 'Yes, packaging and print design are part of our branding service for physical product brands.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free Brand Strategy Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 3,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Branding & Graphic Design | Veenso',
            'meta_description' => 'Brand identity that builds instant trust and higher perceived value. Logo systems, guidelines, marketing design, print, and rebranding.',
        ];
    }
}
