<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(Page $page): View
    {
        abort_unless($page->status === 'published', 404);

        return view('pages.show', [
            'page' => $page,
        ]);
    }

    public function faq(): View
    {
        $faqs = Faq::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('faq', [
            'page' => Page::query()->where('slug', 'faq')->where('status', 'published')->first(),
            'faqGroups' => $faqs,
        ]);
    }

    public function privacy(): View
    {
        $page = Page::query()->where('slug', 'privacy-policy')->where('status', 'published')->firstOrFail();

        return view('pages.show', ['page' => $page]);
    }

    public function terms(): View
    {
        $page = Page::query()->where('slug', 'terms')->where('status', 'published')->firstOrFail();

        return view('pages.show', ['page' => $page]);
    }
}
