@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🏫 School Management</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('schools.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search school..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('schools.create') }}" class="btn btn-success">+ Add School</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
                <th>Contact</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schools as $school)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $school->name }}</td>
                <td>{{ $school->code ?? '-' }}</td>
                <td>{{ $school->contact ?? '-' }}</td>
                <td>{{ $school->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('schools.destroy', $school->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">No schools found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
