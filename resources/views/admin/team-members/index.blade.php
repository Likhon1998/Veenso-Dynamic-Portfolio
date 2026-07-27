@extends('admin.layouts.app')

@section('title', 'Team Members')
@section('page-title', 'Team Members')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Team Members</h2>
        <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary">Add Member</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Name</th><th>Role</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($teamMembers as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->role ?? '—' }}</td>
                        <td><span class="badge badge-{{ $member->status }}">{{ $member->status }}</span></td>
                        <td>{{ $member->sort_order }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#6b7280;">No team members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $teamMembers->links('admin.partials.pagination') }}
</div>
@endsection
