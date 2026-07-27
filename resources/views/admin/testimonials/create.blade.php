@extends('admin.layouts.app')

@section('title', 'Create Testimonial')
@section('page-title', 'Create Testimonial')

@section('content')
<div class="card">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.testimonials._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
