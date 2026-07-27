@extends('admin.layouts.app')
@section('title', 'Edit Client Logo')
@section('content')
<div class="card">
    <form action="{{ route('admin.client-logos.update', $clientLogo) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.client-logos._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.client-logos.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
