@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Semester Details</h2>

    <table class="table table-bordered">
        <tr><th>Name</th><td>{{ $semester->name }}</td></tr>
        <tr><th>Start Date</th><td>{{ $semester->start_date ?? '-' }}</td></tr>
        <tr><th>End Date</th><td>{{ $semester->end_date ?? '-' }}</td></tr>
        <tr><th>Active</th>
            <td>
                @if($semester->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </td>
        </tr>
        <tr><th>Created At</th><td>{{ $semester->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $semester->updated_at->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
