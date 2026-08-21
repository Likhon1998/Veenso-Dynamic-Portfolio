<?php

namespace App\Support;

class ProductVisualsServiceContent
{
    /**
     * Full Product Visuals (Photography & 3D Rendering) service payload for seeding.
     *
     * @return array<string, mixed>
     */
    public static function payload(?string $featuredImage = null): array
    {
        return [
            'title' => 'Product Visuals (Photography & 3D Rendering)',
            'slug' => 'product-visuals-photography-3d-rendering',
            'summary' => 'Studio photography and photorealistic 3D rendering built to make listings, ads, and catalogs convert — not just look nice.',
            'headline' => 'Product Visuals Engineered to Increase Add-to-Cart and Conversion Rates',
            'description' => "Online, customers can't touch or try your product — the visual is the entire pitch. Weak visuals quietly lose sales no matter how good the product actually is. And for products still in development, prototyping, or needing impossible-to-photograph angles, 3D rendering closes the gap that photography alone can't.\n\nA single 3D model can be re-rendered endlessly — new angles, colors, backgrounds, and scenes — for a fraction of the cost of a new photoshoot every time.\n\nProduct Visuals covers both real-world and digitally created imagery: studio and lifestyle photography for physical products, and 3D modeling and photorealistic rendering for products that are still in development, need impossible camera angles, or benefit from unlimited reusable variations.",
            'icon' => 'camera',
            'hero_badges' => ['Free Audit', 'Custom Strategy', 'No Long-Term Contracts'],
            'key_stats' => [
                ['value' => 'Decide', 'label' => 'Most online shoppers say product images are the deciding factor before purchase'],
                ['value' => 'Abandon', 'label' => 'Poor product photos are a top reason for cart abandonment'],
                ['value' => 'Multi', 'label' => 'Listings with multiple high-quality images convert noticeably better'],
                ['value' => '3D', 'label' => "renders let you show angles, finishes, and use-cases a camera alone can't capture"],
            ],
            'sub_services' => [
                ['title' => 'Studio & Lifestyle Photography', 'description' => 'Product shots, flat-lay, 360° spins, and lifestyle staging that make the product the hero.'],
                ['title' => '3D Product Modeling & Rendering', 'description' => '3D modeling, texturing, and photorealistic rendering for products, packaging, and scenes — even before a physical unit exists.'],
                ['title' => 'Ad & Catalog Visual Production', 'description' => 'Ad-ready crops, lookbooks, and catalog sets reused across channels from one shoot or 3D asset.'],
                ['title' => 'E-commerce Ready Image Sets', 'description' => 'Marketplace-compliant sizing for Daraz, Amazon, and Shopify with background cleanup.'],
                ['title' => 'Retouching & Consistency Editing', 'description' => 'Color correction, blemish/background removal, and a standardized look across the whole catalog.'],
            ],
            'problems' => [
                'Listings look unprofessional',
                'Low add-to-cart rate',
                'Product not physically ready to shoot',
                'Inconsistent catalog look',
                'Images don\'t fit ad formats',
            ],
            'problem_matrix' => [
                ['problem' => 'Listings look unprofessional', 'why' => 'Phone photos, poor lighting', 'fix' => 'Studio-quality photography setup'],
                ['problem' => 'Low add-to-cart rate', 'why' => 'Missing angles/detail shots', 'fix' => 'Full shot set (front, detail, lifestyle, 360°) or 3D renders'],
                ['problem' => 'Product not physically ready to shoot', 'why' => 'Still in prototyping or manufacturing', 'fix' => 'Photorealistic 3D modeling & rendering instead of a physical shoot'],
                ['problem' => 'Inconsistent catalog look', 'why' => 'Different styles across products', 'fix' => 'Standardized visual style guide across photography and 3D'],
                ['problem' => 'Images don\'t fit ad formats', 'why' => 'Wrong dimensions/backgrounds', 'fix' => 'Ad-ready cropped & background-adapted visuals'],
            ],
            'benefits' => [
                ['title' => 'Studio Photography', 'description' => 'Make the product the hero the moment a listing loads. Product shots, flat-lay, 360° spins, lifestyle staging.'],
                ['title' => '3D Product Modeling & Rendering', 'description' => 'Visualize and sell a product before a single physical unit exists. 3D modeling, texturing, and photorealistic rendering.'],
                ['title' => 'E-commerce Ready Images', 'description' => 'Meet every marketplace\'s requirements without extra back-and-forth. Marketplace-compliant sizing and background cleanup.'],
                ['title' => 'Retouching', 'description' => 'Keep every product looking equally premium. Color correction, blemish/background removal, consistency editing.'],
                ['title' => 'Ad & Catalog Visuals', 'description' => 'Reuse the same shoot or 3D asset across ads, catalogs, and lookbooks. Ad-ready crops, lookbooks, catalog sets.'],
            ],
            'deliverables' => [
                'Final Edited Image Set (per product)',
                'Marketplace-Ready Exports (Daraz/Amazon/Shopify sizing)',
                '3D Rendered Visuals (multiple angles/colorways)',
                'Ad-Ready Cropped Visuals',
                'Visual Style Guide',
            ],
            'gains' => [
                'Studio-quality images without studio overhead',
                'Higher add-to-cart & conversion rates',
                'Unlimited reusable angles/colorways from a single 3D model',
                'Photorealistic 3D visuals for products not yet in production',
                'Consistent, professional catalog look',
            ],
            'tools' => ['Adobe Photoshop', 'Adobe Lightroom', 'Capture One', 'Autodesk Maya', 'Blender', 'KeyShot', 'V-Ray'],
            'metrics_table' => [
                ['metric' => 'Listing conversion', 'before' => 'Below category average', 'after' => 'Competitive with top listings'],
                ['metric' => 'Product page bounce', 'before' => 'High', 'after' => 'Reduced with full detail shot sets'],
                ['metric' => 'Time to visual for pre-production items', 'before' => 'Not possible without a physical sample', 'after' => 'Ready via 3D rendering before manufacturing'],
            ],
            'process_steps' => [
                ['step' => 1, 'title' => 'Discover', 'description' => "We audit your current position, your competitors, and your real growth opportunity — before touching a single tactic.\n• Product Intake & Shot List / 3D Brief Planning"],
                ['step' => 2, 'title' => 'Build', 'description' => "We build the foundation: strategy, structure, creative, and setup done right the first time.\n• Studio/Lifestyle Photography or 3D Modeling\n• Selection, Retouching & Rendering"],
                ['step' => 3, 'title' => 'Optimize', 'description' => "We test, refine, and improve continuously based on real performance data, not assumptions.\n• Platform-Specific Sizing & Export\n• Client Review"],
                ['step' => 4, 'title' => 'Scale', 'description' => "We double down on what's proven to work and expand budget, scope, and reach around it.\n• Ongoing Support for New Products\n• Seasonal/Catalog Refresh (optional)"],
            ],
            'who_for' => 'E-commerce, fashion, beauty, home decor, and manufacturing brands selling on Daraz, Amazon, Shopify, or similar marketplaces — plus professional services and B2B teams that need consistent product imagery.',
            'audiences' => [
                ['title' => 'Professional Services', 'items' => ['Law Firms', 'Dental Clinics', 'Medical Practices', 'Accounting Firms']],
                ['title' => 'Commerce', 'items' => ['E-commerce', 'Fashion', 'Beauty', 'Home Decor']],
                ['title' => 'B2B', 'items' => ['SaaS', 'Agencies', 'Manufacturing']],
            ],
            'ideal_clients' => [
                'You sell on Daraz, Amazon, Shopify, or similar marketplaces',
                'Your product photos look inconsistent or amateur',
                'You need visuals for a product still in prototyping or pre-production',
                'You want visuals that work across store, ads, and catalog',
            ],
            'why_choose' => [
                ['title' => 'Studio quality, without studio overhead', 'description' => 'Premium photography results without the full in-house studio cost.'],
                ['title' => 'In-house 3D', 'description' => 'Modeling and rendering handled in-house — not quietly outsourced.'],
                ['title' => 'One consistent style', 'description' => 'Photography and 3D follow the same visual style guide across your catalog.'],
                ['title' => 'Dedicated support', 'description' => 'One dedicated strategist, weekly communication, ethical white-hat practices only.'],
            ],
            'comparison' => [
                ['typical' => 'Generic, templated strategy', 'veenso' => 'Custom strategy for your business'],
                ['typical' => 'Limited or vague reporting', 'veenso' => 'Transparent, ROI-focused reporting'],
                ['typical' => 'One-size-fits-all execution', 'veenso' => 'Dedicated strategist for your account'],
                ['typical' => 'Slow, occasional communication', 'veenso' => 'Weekly communication as standard'],
                ['typical' => 'Work quietly outsourced elsewhere', 'veenso' => 'Photography + in-house 3D rendering built in'],
            ],
            'packages' => [
                ['title' => 'One-Time Project', 'description' => 'A defined scope with a clear start and finish — ideal when you need a specific outcome delivered, like a new website or a brand identity.'],
                ['title' => 'Growth Partnership', 'description' => 'Ongoing monthly collaboration across one or more services, built around a shared growth goal and reviewed regularly.'],
                ['title' => 'Ongoing Strategic Retainer', 'description' => 'A long-term, dedicated partnership for businesses that treat marketing as a continuous growth function, not a project with an end date.'],
            ],
            'faqs' => [
                ['question' => 'Do I need to ship products to you, or do you shoot on location?', 'answer' => 'Both options are available — studio shoots for controlled lighting, or on-location for lifestyle/context shots.'],
                ['question' => 'Can you create visuals before my product is manufactured?', 'answer' => 'Yes — 3D modeling and rendering lets us produce photorealistic visuals from CAD files, sketches, or reference images before a physical sample exists.'],
                ['question' => 'Can you match marketplace image requirements (Daraz/Amazon)?', 'answer' => 'Yes, images are exported and sized to meet each marketplace\'s specific requirements.'],
                ['question' => 'How long does a product shoot or 3D render take to deliver?', 'answer' => 'Typical turnaround is 5–7 business days for photography, and 7–10 business days for a 3D render set, depending on complexity.'],
            ],
            'related_notes' => null,
            'cta_text' => 'Book Your Free Product Visuals Session',
            'cta_url' => '/contact',
            'secondary_cta_text' => 'Schedule a Revenue Growth Consultation',
            'secondary_cta_url' => '/contact',
            'is_primary' => true,
            'sort_order' => 9,
            'status' => 'published',
            'featured_image' => $featuredImage,
            'meta_title' => 'Product Visuals (Photography & 3D Rendering) | Veenso',
            'meta_description' => 'Studio photography and photorealistic 3D rendering engineered to increase add-to-cart and conversion rates for listings, ads, and catalogs.',
        ];
    }
}
