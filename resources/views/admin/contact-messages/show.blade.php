@extends('admin.layouts.app')

@section('title', 'View Message')
@section('page-title', 'Contact Message')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $message->subject ?? 'Message from '.$message->name }}</h2>
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>

    <div class="detail-grid">
        <div class="detail-row"><span class="detail-label">Name</span><span>{{ $message->name }}</span></div>
        <div class="detail-row"><span class="detail-label">Email</span><span><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></span></div>
        <div class="detail-row"><span class="detail-label">Phone</span><span>{{ $message->phone ?? '—' }}</span></div>
        <div class="detail-row"><span class="detail-label">Subject</span><span>{{ $message->subject ?? '—' }}</span></div>
        <div class="detail-row"><span class="detail-label">Received</span><span>{{ $message->created_at->format('M j, Y g:i A') }}</span></div>
        <div class="detail-row"><span class="detail-label">Status</span><span><span class="badge badge-{{ $message->status }}">{{ $message->status }}</span></span></div>
    </div>

    <div class="form-group" style="margin-top:1.5rem;">
        <label>Message</label>
        <div class="message-body">{{ $message->message }}</div>
    </div>

    <form action="{{ route('admin.contact-messages.update', $message) }}" method="POST" style="margin-top:1.5rem;">
        @csrf @method('PUT')
        <div class="form-row">
            <div class="form-group">
                <label for="status">Update Status</label>
                <select id="status" name="status" class="form-control">
                    @foreach (['unread', 'read', 'archived'] as $status)
                        <option value="{{ $status }}" @selected($message->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Status</button>
        </div>
    </form>

    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" style="margin-top:0.75rem;" onsubmit="return confirm('Delete this message?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Message</button>
    </form>
</div>
@endsection
