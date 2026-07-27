@extends('admin.layouts.app')
@section('title', 'Add Client Logo')
@section('content')
<div class="card">
    <form action="{{ route('admin.client-logos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.client-logos._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.client-logos.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
