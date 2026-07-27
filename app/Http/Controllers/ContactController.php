<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        $services = Service::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get(['title', 'slug']);

        return view('contact', [
            'page' => \App\Models\Page::query()->where('slug', 'contact')->where('status', 'published')->first(),
            'services' => $services,
            'phone' => SiteSetting::get('phone'),
            'email' => SiteSetting::get('email'),
            'address' => SiteSetting::get('address'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create([
            ...$validated,
            'status' => 'unread',
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thanks for reaching out — a member of our team will respond within one business day.');
    }
}
