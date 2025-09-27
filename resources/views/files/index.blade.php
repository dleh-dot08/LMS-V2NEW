@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📁 File Management</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('files.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search filename..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('files.create') }}" class="btn btn-success">+ Add File</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Filename</th>
                <th>Path</th>
                <th>MIME</th>
                <th>Size (bytes)</th>
                <th>Uploaded By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($files as $file)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $file->filename }}</td>
                <td>{{ $file->storage_path }}</td>
                <td>{{ $file->mime }}</td>
                <td>{{ $file->size }}</td>
                <td>{{ $file->uploader ? $file->uploader->name : '-' }}</td>
                <td>{{ $file->created_at->format('d M Y H:i') }}</td>
                <td>
                    <a href="{{ route('files.show', $file->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No files found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
