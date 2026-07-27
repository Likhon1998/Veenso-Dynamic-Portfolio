@extends('admin.layouts.app')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Services</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add Service</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Primary</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td>{{ $service->title }}</td>
                        <td><span class="badge badge-{{ $service->status }}">{{ $service->status }}</span></td>
                        <td>@if($service->is_primary)<span class="badge badge-featured">Primary</span>@else—@endif</td>
                        <td>{{ $service->sort_order }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#6b7280;">No services found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $services->links('admin.partials.pagination') }}
</div>
@endsection
