@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🗓️ Semester Management</h2>

    <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ route('semesters.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search semester..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('semesters.create') }}" class="btn btn-success">+ Add Semester</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Active</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semesters as $semester)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $semester->name }}</td>
                <td>{{ $semester->start_date ?? '-' }}</td>
                <td>{{ $semester->end_date ?? '-' }}</td>
                <td>
                    @if($semester->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>{{ $semester->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('semesters.show', $semester->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('semesters.destroy', $semester->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No semesters found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
