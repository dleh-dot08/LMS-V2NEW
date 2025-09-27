@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Program Category Details</h2>

    <table class="table table-bordered">
        <tr><th>Name</th><td>{{ $category->name }}</td></tr>
        <tr><th>Description</th><td>{{ $category->description ?? '-' }}</td></tr>
        <tr><th>Meta</th><td>{{ $category->meta ?? '-' }}</td></tr>
        <tr><th>Created At</th><td>{{ $category->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $category->updated_at->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('program_categories.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('program_categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
