<?php

namespace App\Support;

class VideoEditingServiceContent
{
    /**
     * Full Video Editing & Promotional Video service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Video Editing & Promotional Video',
            'slug' => 'video-editing-promotional-video',
            'summary' => 'Promo videos, reels, and ad edits built to hold attention and convert viewers into enquiries and sales.',
            'headline' => 'Video Content Engineered to Stop the Scroll and Drive Bookings',
            'description' => "Attention spans are short and competition for the scroll is fierce. Video is the fastest way to show — not just tell — customers why your product or service matters. And video content isn't a one-off asset; the strongest brands keep a consistent monthly video pipeline running.\n\nOne strong video can be repurposed across reels, ads, and the website for months — turning a single production cost into ongoing content value.\n\nVideo Editing & Promotional Video services turn raw footage or ideas into polished, platform-optimized videos — reels, ads, and promos — engineered to hold attention and drive action within the first few seconds.",
            'icon' => 'video',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Higher', 'label' => 'Video content generates significantly more engagement than static posts'],
                ['value' => 'Product', 'label' => 'videos can meaningfully increase purchase confidence'],
                ['value' => '3 sec', 'label' => 'Most viewers decide to keep watching within the first 3 seconds'],
                ['value' => 'Shorts', 'label' => 'Short-form video is currently the fastest-growing content format'],
            ],
            'sub_services' => [
                ['title' => 'Short-Form Content Editing', 'description' => 'Reels, TikToks, and YouTube Shorts edited for hooks, retention, and platform-native formats.'],
                ['title' => 'Promotional & Brand Videos', 'description' => 'Brand story videos, company intros, and event recaps that build trust in seconds.'],
                ['title' => 'Ad Video Editing', 'description' => 'Meta & YouTube ad-format edits in multiple aspect ratios built to get skipped less and clicked more.'],
                ['title' => 'Motion Graphics & Captions', 'description' => 'On-brand motion graphics, captions, and subtitles for silent viewing and accessibility.'],
                ['title' => 'Color Grading & Sound Design', 'description' => 'Professional finishing so every video looks and sounds polished.'],
            ],
            'problems' => [
                'Videos don\'t hold attention',
                'Content looks amateur',
                'Low reach on reels/shorts',
                'Ads get skipped',
            ],
            'problem_matrix' => [
                ['problem' => 'Videos don\'t hold attention', 'why' => 'Weak hook in first 3 seconds', 'fix' => 'Hook-first editing structure'],
                ['problem' => 'Content looks amateur', 'why' => 'No color grading/motion graphics', 'fix' => 'Professional edit, grading & captions'],
                ['problem' => 'Low reach on reels/shorts', 'why' => 'Wrong format/length for platform', 'fix' => 'Platform-optimized short-form edits'],
                ['problem' => 'Ads get skipped', 'why' => 'Generic, non-native ad creative', 'fix' => 'Ad-format-specific video editing'],
            ],
            'benefits' => [
                ['title' => 'Promo & Brand Videos', 'description' => 'Give new visitors a reason to trust your brand in seconds. Brand story videos, company intros, event recaps.'],
                ['title' => 'Short-Form Content', 'description' => 'Stay visible in feeds without needing a film crew every week. Reels, TikToks, YouTube Shorts editing.'],
                ['title' => 'Product & Explainer Videos', 'description' => 'Answer buyer questions before they even ask. Product demos, how-to/explainer edits.'],
                ['title' => 'Ad Video Editing', 'description' => 'Get skipped less and clicked more. Meta & YouTube ad-format edits, multiple aspect ratios.'],
                ['title' => 'Post-Production', 'description' => 'Make every video look and sound professionally finished. Motion graphics, captions/subtitles, color grading, sound design.'],
            ],
            'deliverables' => [
                'Edited Video Files (all required aspect ratios)',
                'Motion Graphics Package',
                'Captions/Subtitles',
                'Monthly Content Delivery Schedule',
            ],
            'gains' => [
                'Scroll-stopping first 3 seconds',
                'Clean audio & professional color grading',
                'Platform-optimized formats every time',
                'Content built for shares, not just views',
                'Fast turnaround for ongoing content needs',
            ],
            'tools' => ['Adobe Premiere Pro', 'Adobe After Effects', 'CapCut Pro', 'DaVinci Resolve'],
            'metrics_table' => [
                ['metric' => 'Watch-through rate', 'before' => 'Low', 'after' => 'Significantly improved with hook-first editing'],
                ['metric' => 'Content output', 'before' => 'Sporadic', 'after' => 'Consistent monthly video pipeline'],
                ['metric' => 'Ad creative fatigue', 'before' => 'Fast', 'after' => 'Extended through fresh edit variations'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Brief & Footage/Asset Collection"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Script/Storyboard (if needed)\n• Rough Cut Edit"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Motion Graphics & Captions\n• Color Grading & Sound Design\n• Client Review"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Ongoing Monthly Video Support"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that need scroll-stopping video content.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You want video content that drives enquiries, not just views',
                'You\'re running or planning to run video ads',
                'You need a consistent monthly content pipeline',
                'You want professional editing without hiring in-house',
            ],
            'why_choose' => [
                ['title' => 'Hook-first editing', 'description' => 'Every video is structured to earn attention in the first 3 seconds.'],
                ['title' => 'Platform-native formats', 'description' => 'Exports tailored for reels, shorts, YouTube, and ads — not one-size-fits-all.'],
                ['title' => 'Fast turnaround', 'description' => 'Reliable delivery for ongoing monthly content needs.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, ethical white-hat practices only.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'Hook-first video editing expertise built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a new website or a brand identity.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across one or more services, built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'Do I need to provide the footage?', 'answer' => 'You can provide raw footage, or we can help coordinate a shoot — either way, all editing and post-production is handled by us.'],
                ['question' => 'What formats will I receive?', 'answer' => 'Videos are delivered in the aspect ratios you need — square, vertical (reels/shorts), and horizontal (YouTube/website).'],
                ['question' => 'Can you add captions/subtitles?', 'answer' => 'Yes, captions and subtitles are included as part of post-production for accessibility and silent-viewing engagement.'],
                ['question' => 'How fast is turnaround?', 'answer' => 'Standard edits typically take 3–5 business days; rush turnaround can be arranged for time-sensitive campaigns.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free Video Content Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 8,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Video Editing & Promotional Video | Veenso',
            'meta_description' => 'Promo videos, reels, and ad edits engineered to stop the scroll and drive bookings. Short-form, brand, and ad video editing with professional post-production.',
        ];
    }
}
