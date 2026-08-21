<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesFormArrays;
use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    use HandlesFormArrays, HandlesImageUploads;

    public function index(): View
    {
        $services = Service::query()->orderBy('sort_order')->orderBy('title')->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateService($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'services');
        }

        Service::query()->create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validateService($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'services');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    private function validateService(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'headline' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'who_for' => ['nullable', 'string'],
            'related_notes' => ['nullable', 'string'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'secondary_cta_text' => ['nullable', 'string', 'max:255'],
            'secondary_cta_url' => ['nullable', 'string', 'max:255'],
            'is_primary' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'hero_badges' => ['nullable', 'string'],
            'key_stats' => ['nullable', 'string'],
            'sub_services' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'deliverables' => ['nullable', 'string'],
            'gains' => ['nullable', 'string'],
            'process_steps' => ['nullable', 'string'],
            'tools' => ['nullable', 'string'],
            'faqs' => ['nullable', 'string'],
            'problems' => ['nullable', 'string'],
            'problem_matrix' => ['nullable', 'string'],
            'ideal_clients' => ['nullable', 'string'],
            'audiences' => ['nullable', 'string'],
            'why_choose' => ['nullable', 'string'],
            'comparison' => ['nullable', 'string'],
            'packages' => ['nullable', 'string'],
            'metrics_table' => ['nullable', 'string'],
        ]);

        $validated['is_primary'] = $request->boolean('is_primary');

        $jsonFields = [
            'key_stats',
            'sub_services',
            'benefits',
            'process_steps',
            'faqs',
            'why_choose',
            'problem_matrix',
            'audiences',
            'comparison',
            'packages',
            'metrics_table',
        ];

        foreach ($jsonFields as $field) {
            $validated[$field] = $this->jsonToArray($request->input($field));
        }

        $lineFields = ['tools', 'problems', 'ideal_clients', 'hero_badges', 'deliverables', 'gains'];
        foreach ($lineFields as $field) {
            $validated[$field] = $this->linesToArray($request->input($field));
        }

        unset($validated['featured_image']);

        return $validated;
    }
}
