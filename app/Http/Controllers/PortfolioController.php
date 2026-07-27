<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolioItems = PortfolioItem::query()
            ->where('status', 'published')
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->get();

        $categories = $portfolioItems->pluck('category')->unique()->values();

        return view('portfolio.index', [
            'page' => \App\Models\Page::query()->where('slug', 'portfolio')->where('status', 'published')->first(),
            'portfolioItems' => $portfolioItems,
            'categories' => $categories,
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
