@extends('admin.layouts.app')
@section('title', 'Why Choose Items')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Why Choose Veenso</h2>
        <a href="{{ route('admin.why-choose-items.create') }}" class="btn btn-primary">Add Item</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Title</th><th>Icon</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->icon ?? '—' }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td><span class="badge badge-{{ $item->status }}">{{ $item->status }}</span></td>
                        <td class="table-actions">
                            <a href="{{ route('admin.why-choose-items.edit', $item) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.why-choose-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#8b8b9a;">No items yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links('admin.partials.pagination') }}
</div>
@endsection
