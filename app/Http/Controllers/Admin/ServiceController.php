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
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'who_for' => ['nullable', 'string'],
            'related_notes' => ['nullable', 'string'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'is_primary' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'process_steps' => ['nullable', 'string'],
            'tools' => ['nullable', 'string'],
            'faqs' => ['nullable', 'string'],
            'problems' => ['nullable', 'string'],
            'ideal_clients' => ['nullable', 'string'],
            'why_choose' => ['nullable', 'string'],
        ]);

        $validated['is_primary'] = $request->boolean('is_primary');
        $validated['benefits'] = $this->jsonToArray($request->input('benefits'));
        $validated['process_steps'] = $this->jsonToArray($request->input('process_steps'));
        $validated['faqs'] = $this->jsonToArray($request->input('faqs'));
        $validated['why_choose'] = $this->jsonToArray($request->input('why_choose'));
        $validated['tools'] = $this->linesToArray($request->input('tools'));
        $validated['problems'] = $this->linesToArray($request->input('problems'));
        $validated['ideal_clients'] = $this->linesToArray($request->input('ideal_clients'));

        unset($validated['featured_image']);

        return $validated;
    }
}
