<?php

namespace App\Support;

class AiSearchServiceContent
{
    /**
     * Full AI Search Optimization (AEO/GEO) service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'AI Search Optimization (AEO/GEO)',
            'slug' => 'ai-search-optimization',
            'summary' => 'Position your business as the trusted, cited answer inside ChatGPT, Gemini, Perplexity, and Google AI Overviews.',
            'headline' => 'Be the Answer AI Recommends — Not Just a Search Result',
            'description' => "Search behavior is shifting from typing keywords into Google to asking an AI assistant a direct question. If your brand isn't structured to be understood and cited by AI systems, you become invisible in an entire new discovery channel — even while ranking fine on traditional search. This is also a continuously evolving channel, not a one-time setup.\n\nBusinesses that structure their content for AI search now are positioning themselves as the default answer before this channel becomes as competitive as traditional SEO.\n\nAI Search Optimization (AEO/GEO) is the process of structuring your content and brand data so AI-powered platforms — ChatGPT, Perplexity, Gemini, Microsoft Copilot, and Google AI Overviews — can understand, trust, and recommend your business directly in generated answers.",
            'icon' => 'brain',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Growing', 'label' => 'share of searches now end in an AI-generated answer instead of a list of links'],
                ['value' => 'Cited', 'label' => 'brands gain visibility in AI answers even without a click'],
                ['value' => 'Direct', 'label' => 'Buyers increasingly ask AI tools for product/service recommendations'],
                ['value' => 'SEO alone', 'label' => "doesn't guarantee visibility inside AI-generated answers"],
            ],
            'sub_services' => [
                ['title' => 'AI Visibility Auditing', 'description' => 'Test how your brand currently appears across major AI answer engines and where gaps exist.'],
                ['title' => 'Entity & Structured Data Setup', 'description' => 'Schema, consistent brand facts, and machine-readable structure AI systems can trust and cite.'],
                ['title' => 'AEO Content Formatting', 'description' => 'Rewrite key pages into clear, quotable, question-and-answer style content AI tools can extract.'],
                ['title' => 'Citation & Mention Building', 'description' => 'Get referenced on the authoritative sources AI models pull from most often.'],
                ['title' => 'Ongoing AI Monitoring', 'description' => 'Regular checks on how your brand appears in AI-generated answers, with adjustments over time.'],
            ],
            'problems' => [
                'Never mentioned by ChatGPT/AI tools',
                'AI gives inaccurate info about your brand',
                'Competitors get recommended, not you',
                'Content technically ranks but isn\'t quoted',
            ],
            'problem_matrix' => [
                ['problem' => 'Never mentioned by ChatGPT/AI tools', 'why' => 'Content isn\'t structured for AI comprehension', 'fix' => 'Structured, entity-clear content rewrites'],
                ['problem' => 'AI gives inaccurate info about your brand', 'why' => 'No authoritative, consistent source data', 'fix' => 'Consistent facts across site, listings & citations'],
                ['problem' => 'Competitors get recommended, not you', 'why' => 'They\'re cited across more trusted sources', 'fix' => 'Targeted citation & mention building'],
                ['problem' => 'Content technically ranks but isn\'t quoted', 'why' => 'Not formatted for extraction (Q&A, lists, clear facts)', 'fix' => 'AEO-friendly content formatting'],
            ],
            'benefits' => [
                ['title' => 'AI Visibility Audit', 'description' => 'Find out exactly how — or if — AI tools currently describe your business. Testing across major AI answer engines.'],
                ['title' => 'Entity & Structured Data Setup', 'description' => 'Give AI systems accurate, consistent facts to cite. Schema markup, consistent NAP/brand facts, structured content for machine readability.'],
                ['title' => 'AEO Content Rewrites', 'description' => 'Make your key pages the ones AI tools actually quote. Reformatting into clear, quotable, Q&A-style content.'],
                ['title' => 'Citation & Mention Building', 'description' => 'Get referenced on the sources AI models trust and pull from most. Targeted outreach on authoritative sources.'],
                ['title' => 'Ongoing AI Monitoring', 'description' => 'Stay visible as AI models and their sources keep changing. Regular checks with adjustments over time.'],
            ],
            'deliverables' => [
                'AI Visibility Audit Report',
                'Entity & Schema Setup',
                'AEO Content Rewrite (per page)',
                'Citation Building Report',
                'Quarterly AI Mention Tracking Report',
            ],
            'gains' => [
                'Visibility in ChatGPT, Perplexity & AI Overviews',
                'A brand AI tools describe accurately',
                'An early-mover advantage in a still-maturing channel',
                'Content that works for both traditional SEO and AI search',
                'Protection against being left out as search behavior shifts',
            ],
            'tools' => ['ChatGPT', 'Gemini', 'Perplexity', 'Claude', 'Google AI Overviews', 'Microsoft Copilot'],
            'metrics_table' => [
                ['metric' => 'Brand mentioned by AI tools', 'before' => 'Rarely or inaccurately', 'after' => 'Consistently, with accurate details'],
                ['metric' => 'Content structure', 'before' => 'Written for humans only', 'after' => 'Written for both humans and AI extraction'],
                ['metric' => 'Discovery channels covered', 'before' => 'Google search only', 'after' => 'Google search + AI answer engines'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• AI Visibility Audit (current state across tools)"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Entity & Fact Consistency Cleanup\n• Structured Data & Schema Implementation"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Content Rewrites for Clarity & Extraction\n• Citation & Source Building"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Ongoing Monitoring Across AI Platforms\n• Quarterly Strategy Adjustment"],
            ],
            'who_for' => 'Professional services, law firms, dental clinics, medical practices, accounting firms, e-commerce, fashion, beauty, home decor, B2B SaaS, agencies, and manufacturing brands that want to be recommended by AI tools.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You want to stay ahead of the shift to AI-driven search',
                'You want to be the AI\'s top recommendation in your category',
                'You\'re already investing in SEO and want the next layer of visibility',
                'You want to be cited as a go-to expert by AI tools',
            ],
            'why_choose' => [
                ['title' => 'Early-mover expertise', 'description' => 'Specialized focus on a still-emerging channel before it becomes as competitive as traditional SEO.'],
                ['title' => 'SEO + AI dual-purpose content', 'description' => 'Content built for both traditional rankings and AI extraction.'],
                ['title' => 'Honest reporting', 'description' => 'No inflated AI-visibility claims — plain-language reporting you can trust.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, ethical white-hat practices only.'],
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
                ['question' => 'Is this different from regular SEO?', 'answer' => 'Yes — traditional SEO targets search engine rankings, while AI Search Optimization focuses on how AI models understand, summarize, and cite your brand in generated answers.'],
                ['question' => 'Can you guarantee ChatGPT will recommend my brand?', 'answer' => 'No one can guarantee specific AI outputs since these models change constantly, but we can meaningfully improve the odds through structure, consistency, and citations.'],
                ['question' => 'Do I need a new website for this?', 'answer' => 'Usually not — most of this work involves restructuring and rewriting existing content rather than rebuilding the site.'],
                ['question' => 'Should I do this instead of SEO, or alongside it?', 'answer' => 'Alongside — AEO and traditional SEO reinforce each other since both rely on clear, authoritative, well-structured content.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free AI Visibility Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 4,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'AI Search Optimization (AEO/GEO) | Veenso',
            'meta_description' => 'Be the answer AI recommends. AEO/GEO for ChatGPT, Gemini, Perplexity, Copilot, and Google AI Overviews — audits, entities, content, citations, and monitoring.',
        ];
    }
}
