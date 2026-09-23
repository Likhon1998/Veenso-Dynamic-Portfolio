<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $query = PortfolioItem::query()
            ->where('status', 'published')
            ->orderByDesc('featured')
            ->orderBy('sort_order');

        $activeCategory = $request->query('category');

        if (filled($activeCategory)) {
            $query->where('category', $activeCategory);
        }

        $portfolioItems = $query->get();

        $categories = PortfolioItem::query()
            ->where('status', 'published')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->pluck('category')
            ->unique()
            ->values();

        return view('portfolio.index', [
            'page' => \App\Models\Page::query()->where('slug', 'portfolio')->where('status', 'published')->first(),
            'portfolioItems' => $portfolioItems,
            'categories' => $categories,
            'activeCategory' => $activeCategory ?: null,
        ]);
    }

    public function show(PortfolioItem $portfolioItem): View
    {
        abort_unless($portfolioItem->status === 'published', 404);

        $portfolioItem->load('images');

        $relatedItems = PortfolioItem::query()
            ->where('status', 'published')
            ->where('id', '!=', $portfolioItem->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('portfolio.show', [
            'portfolioItem' => $portfolioItem,
            'relatedItems' => $relatedItems,
        ]);
    }
}
