@extends('admin.layouts.app')

@section('title', 'Portfolio')
@section('page-title', 'Portfolio Items')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Portfolio Items</h2>
        <a href="{{ route('admin.portfolio-items.create') }}" class="btn btn-primary">Add Item</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($portfolioItems as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category ?? '—' }}</td>
                        <td><span class="badge badge-{{ $item->status }}">{{ $item->status }}</span></td>
                        <td>@if($item->featured)<span class="badge badge-featured">Yes</span>@else—@endif</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.portfolio-items.edit', $item) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.portfolio-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#6b7280;">No portfolio items found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $portfolioItems->links('admin.partials.pagination') }}
</div>
@endsection
