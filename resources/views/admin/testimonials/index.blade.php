@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Name</th><th>Company</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->company ?? '—' }}</td>
                        <td>{{ $testimonial->rating ?? '—' }}</td>
                        <td><span class="badge badge-{{ $testimonial->status }}">{{ $testimonial->status }}</span></td>
                        <td class="table-actions">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#6b7280;">No testimonials found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $testimonials->links('admin.partials.pagination') }}
</div>
@endsection
