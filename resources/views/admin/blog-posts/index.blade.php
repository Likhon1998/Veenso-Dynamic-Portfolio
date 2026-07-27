@extends('admin.layouts.app')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Blog Posts</h2>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Title</th><th>Category</th><th>Status</th><th>Published</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($blogPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category ?? '—' }}</td>
                        <td><span class="badge badge-{{ $post->status }}">{{ $post->status }}</span></td>
                        <td>{{ $post->published_at?->format('M j, Y') ?? '—' }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#6b7280;">No blog posts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $blogPosts->links('admin.partials.pagination') }}
</div>
@endsection
