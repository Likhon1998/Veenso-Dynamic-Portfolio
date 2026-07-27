@extends('admin.layouts.app')

@section('title', 'Create Portfolio Item')
@section('page-title', 'Create Portfolio Item')

@section('content')
<div class="card">
    <form action="{{ route('admin.portfolio-items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.portfolio-items._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Item</button>
            <a href="{{ route('admin.portfolio-items.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
