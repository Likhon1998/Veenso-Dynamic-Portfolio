@extends('admin.layouts.app')

@section('title', 'Create Case Study')
@section('page-title', 'Create Case Study')

@section('content')
<div class="card">
    <form action="{{ route('admin.case-studies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.case-studies._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.case-studies.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
