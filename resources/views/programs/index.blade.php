@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📘 Programs</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('programs.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search program..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('programs.create') }}" class="btn btn-success">+ Add Program</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($programs as $program)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $program->title }}</td>
                <td>{{ $program->category ? $program->category->name : '-' }}</td>
                <td>{{ $program->slug }}</td>
                <td>{{ Str::limit($program->description, 50, '...') }}</td>
                <td>{{ $program->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('programs.show', $program->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No programs found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
