@extends('admin.layouts.app')

@section('title', 'Create Blog Post')
@section('page-title', 'Create Blog Post')

@section('content')
<div class="card">
    <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.blog-posts._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
