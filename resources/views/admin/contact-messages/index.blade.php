@extends('admin.layouts.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Contact Messages</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($messages as $msg)
                    <tr>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ Str::limit($msg->subject ?? '—', 40) }}</td>
                        <td><span class="badge badge-{{ $msg->status }}">{{ $msg->status }}</span></td>
                        <td>{{ $msg->created_at->format('M j, Y g:i A') }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.contact-messages.show', $msg) }}" class="btn btn-secondary btn-sm">View</a>
                            <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#6b7280;">No messages found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $messages->links('admin.partials.pagination') }}
</div>
@endsection
