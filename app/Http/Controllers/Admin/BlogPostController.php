<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesFormArrays;
use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Admin\Concerns\SyncsGalleryImages;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    use HandlesFormArrays, HandlesImageUploads, SyncsGalleryImages;

    public function index(): View
    {
        $blogPosts = BlogPost::query()->latest('published_at')->latest()->paginate(15);

        return view('admin.blog-posts.index', compact('blogPosts'));
    }

    public function create(): View
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBlogPost($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'blog');
        }

        $blogPost = BlogPost::query()->create($validated);
        $this->syncRelatedGalleryImages(
            $request,
            $blogPost,
            BlogPostImage::class,
            'blog_post_id',
            'blog/gallery'
        );

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost): View
    {
        $blogPost->load('images');

        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $validated = $this->validateBlogPost($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'blog');
        }

        $blogPost->update($validated);
        $this->syncRelatedGalleryImages(
            $request,
            $blogPost,
            BlogPostImage::class,
            'blog_post_id',
            'blog/gallery'
        );

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->images()->delete();
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }

    private function validateBlogPost(Request $request): array
    {
        $validated = $request->validate(array_merge([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'author' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'max:8192'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'tags' => ['nullable', 'string'],
        ], $this->galleryValidationRules('blog_post_images')));

        $validated['tags'] = $this->commaToArray($request->input('tags'));

        unset(
            $validated['featured_image'],
            $validated['gallery_images'],
            $validated['delete_image_ids'],
            $validated['image_alts'],
            $validated['image_captions']
        );

        return $validated;
    }
}
