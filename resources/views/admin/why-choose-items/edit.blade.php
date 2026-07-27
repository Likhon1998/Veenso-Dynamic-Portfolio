@extends('admin.layouts.app')
@section('title', 'Edit Why Choose Item')
@section('content')
<div class="card">
    <form action="{{ route('admin.why-choose-items.update', $whyChooseItem) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.why-choose-items._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.why-choose-items.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
