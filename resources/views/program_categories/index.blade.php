@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📂 Program Categories</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('program_categories.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search category..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('program_categories.create') }}" class="btn btn-success">+ Add Category</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>{{ $category->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('program_categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('program_categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('program_categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No categories found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
