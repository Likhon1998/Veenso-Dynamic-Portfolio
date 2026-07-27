<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientLogoController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $clientLogos = ClientLogo::query()->orderBy('sort_order')->orderBy('name')->paginate(20);

        return view('admin.client-logos.index', compact('clientLogos'));
    }

    public function create(): View
    {
        return view('admin.client-logos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateLogo($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeUploadedImage($request->file('logo'), 'clients');
        }

        ClientLogo::query()->create($validated);

        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo created successfully.');
    }

    public function edit(ClientLogo $clientLogo): View
    {
        return view('admin.client-logos.edit', compact('clientLogo'));
    }

    public function update(Request $request, ClientLogo $clientLogo): RedirectResponse
    {
        $validated = $this->validateLogo($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeUploadedImage($request->file('logo'), 'clients');
        }

        $clientLogo->update($validated);

        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo updated successfully.');
    }

    public function destroy(ClientLogo $clientLogo): RedirectResponse
    {
        $clientLogo->delete();

        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo deleted successfully.');
    }

    private function validateLogo(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'logo' => ['nullable', 'image', 'max:5120'],
        ]);

        unset($validated['logo']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}
