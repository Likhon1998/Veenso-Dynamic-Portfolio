@extends('admin.layouts.app')

@section('title', 'Edit Team Member')
@section('page-title', 'Edit Team Member')

@section('content')
<div class="card">
    <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.team-members._form', ['teamMember' => $teamMember])
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.team-members.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
