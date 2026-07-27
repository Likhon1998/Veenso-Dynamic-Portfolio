@extends('admin.layouts.app')
@section('title', 'Client Logos')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Client Logos</h2>
        <a href="{{ route('admin.client-logos.create') }}" class="btn btn-primary">Add Logo</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Logo</th><th>Name</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($clientLogos as $logo)
                    <tr>
                        <td>@if($logo->logo)<img src="{{ media_url($logo->logo) }}" alt="" style="width:48px;height:32px;object-fit:contain;border-radius:6px;background:#0c0c13;">@else — @endif</td>
                        <td>{{ $logo->name }}</td>
                        <td>{{ $logo->sort_order }}</td>
                        <td><span class="badge badge-{{ $logo->status }}">{{ $logo->status }}</span></td>
                        <td class="table-actions">
                            <a href="{{ route('admin.client-logos.edit', $logo) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.client-logos.destroy', $logo) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#8b8b9a;">No client logos yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $clientLogos->links('admin.partials.pagination') }}
</div>
@endsection
