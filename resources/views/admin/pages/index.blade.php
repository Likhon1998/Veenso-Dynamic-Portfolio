@extends('admin.layouts.app')

@section('title', 'Pages')
@section('page-title', 'Pages')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Pages</h2>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add Page</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Title</th><th>Slug</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->slug }}</td>
                        <td><span class="badge badge-{{ $page->status }}">{{ $page->status }}</span></td>
                        <td class="table-actions">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;color:#6b7280;">No pages found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $pages->links('admin.partials.pagination') }}
</div>
@endsection
