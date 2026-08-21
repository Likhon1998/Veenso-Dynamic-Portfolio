<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::query()
            ->where('status', 'published')
            ->orderByDesc('published_at');

        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }

        $blogPosts = $query->paginate(9)->withQueryString();

        $categories = BlogPost::query()
            ->where('status', 'published')
            ->pluck('category')
            ->unique()
            ->values();

        return view('blog.index', [
            'page' => \App\Models\Page::query()->where('slug', 'blog')->where('status', 'published')->first(),
            'blogPosts' => $blogPosts,
            'categories' => $categories,
            'activeCategory' => $category ?? null,
        ]);
    }

    public function show(BlogPost $blogPost): View
    {
        abort_unless($blogPost->status === 'published', 404);

        $blogPost->load('images');

        $relatedPosts = BlogPost::query()
            ->where('status', 'published')
            ->where('id', '!=', $blogPost->id)
            ->where('category', $blogPost->category)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $relatedPosts = BlogPost::query()
                ->where('status', 'published')
                ->where('id', '!=', $blogPost->id)
                ->orderByDesc('published_at')
                ->take(3)
                ->get();
        }

        return view('blog.show', [
            'blogPost' => $blogPost,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
