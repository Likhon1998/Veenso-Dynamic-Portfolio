@extends('admin.layouts.app')

@section('title', 'Edit Portfolio Item')
@section('page-title', 'Edit Portfolio Item')

@section('content')
<div class="card">
    <form action="{{ route('admin.portfolio-items.update', $portfolioItem) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.portfolio-items._form', ['portfolioItem' => $portfolioItem])
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="{{ route('admin.portfolio-items.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
