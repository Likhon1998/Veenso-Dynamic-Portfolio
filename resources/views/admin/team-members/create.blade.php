@extends('admin.layouts.app')

@section('title', 'Create Team Member')
@section('page-title', 'Create Team Member')

@section('content')
<div class="card">
    <form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.team-members._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.team-members.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
