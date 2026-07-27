<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesFormArrays;
use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\PortfolioImage;
use App\Models\PortfolioItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioItemController extends Controller
{
    use HandlesFormArrays, HandlesImageUploads;

    public function index(): View
    {
        $portfolioItems = PortfolioItem::query()->orderBy('sort_order')->orderBy('title')->paginate(15);

        return view('admin.portfolio-items.index', compact('portfolioItems'));
    }

    public function create(): View
    {
        return view('admin.portfolio-items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePortfolioItem($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'portfolio');
        }

        $item = PortfolioItem::query()->create($validated);
        $this->syncGalleryImages($request, $item);

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(PortfolioItem $portfolioItem): View
    {
        $portfolioItem->load('images');

        return view('admin.portfolio-items.edit', ['portfolioItem' => $portfolioItem]);
    }

    public function update(Request $request, PortfolioItem $portfolioItem): RedirectResponse
    {
        $validated = $this->validatePortfolioItem($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'portfolio');
        }

        $portfolioItem->update($validated);
        $this->syncGalleryImages($request, $portfolioItem);

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(PortfolioItem $portfolioItem): RedirectResponse
    {
        $portfolioItem->images()->delete();
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Portfolio item deleted successfully.');
    }

    private function validatePortfolioItem(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:4'],
            'featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'service_tags' => ['nullable', 'string'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'max:5120'],
            'delete_image_ids' => ['nullable', 'array'],
            'delete_image_ids.*' => ['integer', 'exists:portfolio_images,id'],
            'image_alts' => ['nullable', 'array'],
            'image_alts.*' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['featured'] = $request->boolean('featured');
        $validated['service_tags'] = $this->linesToArray($request->input('service_tags'));

        unset($validated['featured_image'], $validated['gallery_images'], $validated['delete_image_ids'], $validated['image_alts']);

        return $validated;
    }

    private function syncGalleryImages(Request $request, PortfolioItem $item): void
    {
        if ($request->filled('delete_image_ids')) {
            PortfolioImage::query()
                ->where('portfolio_item_id', $item->id)
                ->whereIn('id', $request->input('delete_image_ids'))
                ->delete();
        }

        if ($request->filled('image_alts')) {
            foreach ($request->input('image_alts') as $imageId => $alt) {
                PortfolioImage::query()
                    ->where('portfolio_item_id', $item->id)
                    ->where('id', $imageId)
                    ->update(['alt' => $alt]);
            }
        }

        if ($request->hasFile('gallery_images')) {
            $sortOrder = (int) $item->images()->max('sort_order');

            foreach ($request->file('gallery_images') as $file) {
                $sortOrder++;
                PortfolioImage::query()->create([
                    'portfolio_item_id' => $item->id,
                    'path' => $this->storeUploadedImage($file, 'portfolio/gallery'),
                    'sort_order' => $sortOrder,
                ]);
            }
        }
    }
}
