<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait SyncsGalleryImages
{
    protected function syncRelatedGalleryImages(
        Request $request,
        Model $parent,
        string $imageModelClass,
        string $foreignKey,
        string $storageFolder
    ): void {
        if ($request->filled('delete_image_ids')) {
            $imageModelClass::query()
                ->where($foreignKey, $parent->id)
                ->whereIn('id', $request->input('delete_image_ids'))
                ->delete();
        }

        if ($request->filled('image_alts')) {
            foreach ($request->input('image_alts') as $imageId => $alt) {
                $imageModelClass::query()
                    ->where($foreignKey, $parent->id)
                    ->where('id', $imageId)
                    ->update(['alt' => $alt]);
            }
        }

        if ($request->filled('image_captions')) {
            foreach ($request->input('image_captions') as $imageId => $caption) {
                $imageModelClass::query()
                    ->where($foreignKey, $parent->id)
                    ->where('id', $imageId)
                    ->update(['caption' => $caption]);
            }
        }

        if ($request->hasFile('gallery_images')) {
            $sortOrder = (int) $parent->images()->max('sort_order');

            foreach ($request->file('gallery_images') as $file) {
                $sortOrder++;
                $imageModelClass::query()->create([
                    $foreignKey => $parent->id,
                    'path' => $this->storeUploadedImage($file, $storageFolder),
                    'sort_order' => $sortOrder,
                ]);
            }
        }
    }

    protected function galleryValidationRules(string $existsTable): array
    {
        return [
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'max:8192'],
            'delete_image_ids' => ['nullable', 'array'],
            'delete_image_ids.*' => ['integer', "exists:{$existsTable},id"],
            'image_alts' => ['nullable', 'array'],
            'image_alts.*' => ['nullable', 'string', 'max:255'],
            'image_captions' => ['nullable', 'array'],
            'image_captions.*' => ['nullable', 'string', 'max:500'],
        ];
    }
}
