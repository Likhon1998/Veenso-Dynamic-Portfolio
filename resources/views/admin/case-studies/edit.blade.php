@extends('admin.layouts.app')

@section('title', 'Edit Case Study')
@section('page-title', 'Edit Case Study')

@section('content')
<div class="card">
    <form action="{{ route('admin.case-studies.update', $caseStudy) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.case-studies._form', ['caseStudy' => $caseStudy])
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.case-studies.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
