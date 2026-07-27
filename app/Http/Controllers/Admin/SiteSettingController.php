<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    use HandlesImageUploads;

    public function edit(): View
    {
        $settings = SiteSetting::query()->orderBy('group')->orderBy('key')->get()->groupBy('group');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'brand_logo' => ['nullable', 'image', 'max:5120'],
            'hero_image' => ['nullable', 'image', 'max:5120'],
            'hero_banner' => ['nullable', 'image', 'max:5120'],
            'hero_regions_badge' => ['nullable', 'image', 'max:5120'],
            'settings' => ['nullable', 'array'],
        ]);

        $values = $request->input('settings', []);

        foreach ($values as $key => $value) {
            SiteSetting::query()->where('key', $key)->update(['value' => $value ?? '']);
        }

        if ($request->hasFile('brand_logo')) {
            $path = $this->storeUploadedImage($request->file('brand_logo'), 'brand');
            SiteSetting::set('brand_logo', $path, 'brand');
        }

        if ($request->hasFile('hero_image')) {
            $path = $this->storeUploadedImage($request->file('hero_image'), 'hero');
            SiteSetting::set('hero_image', $path, 'hero');
        }

        if ($request->hasFile('hero_banner')) {
            $path = $this->storeUploadedImage($request->file('hero_banner'), 'hero');
            SiteSetting::set('hero_banner', $path, 'hero');
        }

        if ($request->hasFile('hero_regions_badge')) {
            $path = $this->storeUploadedImage($request->file('hero_regions_badge'), 'hero');
            SiteSetting::set('hero_regions_badge', $path, 'hero');
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
