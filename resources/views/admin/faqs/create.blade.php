@extends('admin.layouts.app')

@section('title', 'Create FAQ')
@section('page-title', 'Create FAQ')

@section('content')
<div class="card">
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        @include('admin.faqs._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
