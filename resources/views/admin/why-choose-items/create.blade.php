@extends('admin.layouts.app')
@section('title', 'Add Why Choose Item')
@section('content')
<div class="card">
    <form action="{{ route('admin.why-choose-items.store') }}" method="POST">
        @csrf
        @include('admin.why-choose-items._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.why-choose-items.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
