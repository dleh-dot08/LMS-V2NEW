@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Class Group Details</h2>

    <table class="table table-bordered">
        <tr><th>School</th><td>{{ $classGroup->school ? $classGroup->school->name : '-' }}</td></tr>
        <tr><th>Name</th><td>{{ $classGroup->name }}</td></tr>
        <tr><th>Grade Label</th><td>{{ $classGroup->grade_label ?? '-' }}</td></tr>
        <tr><th>Academic Year</th><td>{{ $classGroup->academic_year }}</td></tr>
        <tr><th>Capacity</th><td>{{ $classGroup->capacity }}</td></tr>
        <tr><th>Meta</th><td>{{ $classGroup->meta ?? '-' }}</td></tr>
        <tr><th>Created At</th><td>{{ $classGroup->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $classGroup->updated_at->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('class-groups.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('class-groups.edit', $classGroup->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
