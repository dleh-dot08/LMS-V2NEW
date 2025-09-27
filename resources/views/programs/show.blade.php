@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Program Details</h2>

    <table class="table table-bordered">
        <tr><th>Title</th><td>{{ $program->title }}</td></tr>
        <tr><th>Slug</th><td>{{ $program->slug }}</td></tr>
        <tr><th>Category</th><td>{{ $program->category ? $program->category->name : '-' }}</td></tr>
        <tr><th>Description</th><td>{{ $program->description ?? '-' }}</td></tr>
        <tr><th>Meta</th><td>{{ $program->meta ?? '-' }}</td></tr>
        <tr><th>Created At</th><td>{{ $program->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $program->updated_at->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('programs.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
