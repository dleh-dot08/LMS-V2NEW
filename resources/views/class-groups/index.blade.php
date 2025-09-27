@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🏫 Class Groups</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('class-groups.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search class group..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('class-groups.create') }}" class="btn btn-success">+ Add Class Group</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>School</th>
                <th>Name</th>
                <th>Grade Label</th>
                <th>Academic Year</th>
                <th>Capacity</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classGroups as $group)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $group->school ? $group->school->name : '-' }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->grade_label ?? '-' }}</td>
                <td>{{ $group->academic_year }}</td>
                <td>{{ $group->capacity }}</td>
                <td>{{ $group->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('class-groups.show', $group->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('class-groups.edit', $group->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('class-groups.destroy', $group->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No class groups found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
