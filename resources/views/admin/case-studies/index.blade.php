@extends('admin.layouts.app')

@section('title', 'Case Studies')
@section('page-title', 'Case Studies')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Case Studies</h2>
        <a href="{{ route('admin.case-studies.create') }}" class="btn btn-primary">Add Case Study</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Title</th><th>Client</th><th>Status</th><th>Featured</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($caseStudies as $study)
                    <tr>
                        <td>{{ $study->title }}</td>
                        <td>{{ $study->client_name ?? '—' }}</td>
                        <td><span class="badge badge-{{ $study->status }}">{{ $study->status }}</span></td>
                        <td>@if($study->featured)<span class="badge badge-featured">Yes</span>@else—@endif</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.case-studies.edit', $study) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.case-studies.destroy', $study) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#6b7280;">No case studies found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $caseStudies->links('admin.partials.pagination') }}
</div>
@endsection
