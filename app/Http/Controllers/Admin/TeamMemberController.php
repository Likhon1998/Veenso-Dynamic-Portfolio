<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $teamMembers = TeamMember::query()->orderBy('sort_order')->orderBy('name')->paginate(15);

        return view('admin.team-members.index', compact('teamMembers'));
    }

    public function create(): View
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTeamMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storeUploadedImage($request->file('photo'), 'team');
        }

        TeamMember::query()->create($validated);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $this->validateTeamMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storeUploadedImage($request->file('photo'), 'team');
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted successfully.');
    }

    private function validateTeamMember(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
            'photo' => ['nullable', 'image', 'max:5120'],
        ]);

        unset($validated['photo']);

        return $validated;
    }
}
