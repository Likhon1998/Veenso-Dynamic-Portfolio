@extends('admin.layouts.app')

@section('title', 'Edit FAQ')
@section('page-title', 'Edit FAQ')

@section('content')
<div class="card">
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.faqs._form', ['faq' => $faq])
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
