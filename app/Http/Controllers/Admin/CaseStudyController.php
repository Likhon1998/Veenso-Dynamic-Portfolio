<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesFormArrays;
use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    use HandlesFormArrays, HandlesImageUploads;

    public function index(): View
    {
        $caseStudies = CaseStudy::query()->orderBy('sort_order')->orderBy('title')->paginate(15);

        return view('admin.case-studies.index', compact('caseStudies'));
    }

    public function create(): View
    {
        return view('admin.case-studies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCaseStudy($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'case-studies');
        }

        CaseStudy::query()->create($validated);

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study created successfully.');
    }

    public function edit(CaseStudy $caseStudy): View
    {
        return view('admin.case-studies.edit', compact('caseStudy'));
    }

    public function update(Request $request, CaseStudy $caseStudy): RedirectResponse
    {
        $validated = $this->validateCaseStudy($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeUploadedImage($request->file('featured_image'), 'case-studies');
        }

        $caseStudy->update($validated);

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study updated successfully.');
    }

    public function destroy(CaseStudy $caseStudy): RedirectResponse
    {
        $caseStudy->delete();

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study deleted successfully.');
    }

    private function validateCaseStudy(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'challenge' => ['nullable', 'string'],
            'strategy' => ['nullable', 'string'],
            'implementation' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'service_category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'stats' => ['nullable', 'string'],
        ]);

        $validated['featured'] = $request->boolean('featured');
        $validated['stats'] = $this->jsonToArray($request->input('stats'));

        unset($validated['featured_image']);

        return $validated;
    }
}
