<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WhyChooseItemController extends Controller
{
    public function index(): View
    {
        $items = WhyChooseItem::query()->orderBy('sort_order')->orderBy('title')->paginate(20);

        return view('admin.why-choose-items.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.why-choose-items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        WhyChooseItem::query()->create($this->validateItem($request));

        return redirect()->route('admin.why-choose-items.index')->with('success', 'Item created successfully.');
    }

    public function edit(WhyChooseItem $whyChooseItem): View
    {
        return view('admin.why-choose-items.edit', compact('whyChooseItem'));
    }

    public function update(Request $request, WhyChooseItem $whyChooseItem): RedirectResponse
    {
        $whyChooseItem->update($this->validateItem($request));

        return redirect()->route('admin.why-choose-items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(WhyChooseItem $whyChooseItem): RedirectResponse
    {
        $whyChooseItem->delete();

        return redirect()->route('admin.why-choose-items.index')->with('success', 'Item deleted successfully.');
    }

    private function validateItem(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}
