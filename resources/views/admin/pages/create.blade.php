@extends('admin.layouts.app')

@section('title', 'Create Page')
@section('page-title', 'Create Page')

@section('content')
<div class="card">
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pages._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
