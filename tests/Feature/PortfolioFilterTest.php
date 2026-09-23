<?php

namespace Tests\Feature;

use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioFilterTest extends TestCase
{
    use RefreshDatabase;

    private function makeItem(array $overrides = []): PortfolioItem
    {
        return PortfolioItem::query()->create(array_merge([
            'title' => 'Sample Project',
            'slug' => 'sample-project-'.uniqid(),
            'description' => 'Description',
            'category' => 'Website',
            'status' => 'published',
            'featured' => false,
            'sort_order' => 1,
            'meta_title' => 'Meta',
            'meta_description' => 'Desc',
        ], $overrides));
    }

    public function test_portfolio_category_filters_work(): void
    {
        $this->makeItem(['title' => 'Web Build', 'slug' => 'web-build', 'category' => 'Website']);
        $this->makeItem(['title' => 'Brand Kit', 'slug' => 'brand-kit', 'category' => 'Branding']);
        $this->makeItem(['title' => 'SEO Lift', 'slug' => 'seo-lift', 'category' => 'SEO']);

        $all = $this->get(route('portfolio.index'));
        $all->assertOk();
        $all->assertSee('Web Build');
        $all->assertSee('Brand Kit');
        $all->assertSee('SEO Lift');
        $all->assertSee('href="'.route('portfolio.index', ['category' => 'Website']).'"', false);

        $website = $this->get(route('portfolio.index', ['category' => 'Website']));
        $website->assertOk();
        $website->assertSee('Web Build');
        $website->assertDontSee('Brand Kit');
        $website->assertDontSee('SEO Lift');
    }
}
