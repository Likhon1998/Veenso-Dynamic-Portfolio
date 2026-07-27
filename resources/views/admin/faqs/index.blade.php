@extends('admin.layouts.app')

@section('title', 'FAQs')
@section('page-title', 'FAQs')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">FAQs</h2>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Add FAQ</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Question</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($faqs as $faq)
                    <tr>
                        <td>{{ Str::limit($faq->question, 60) }}</td>
                        <td>{{ $faq->category ?? '—' }}</td>
                        <td><span class="badge badge-{{ $faq->status }}">{{ $faq->status }}</span></td>
                        <td class="table-actions">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;color:#6b7280;">No FAQs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $faqs->links('admin.partials.pagination') }}
</div>
@endsection
