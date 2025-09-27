@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>School Details</h2>

    <table class="table table-bordered">
        <tr><th>Name</th><td>{{ $school->name }}</td></tr>
        <tr><th>Code</th><td>{{ $school->code ?? '-' }}</td></tr>
        <tr><th>Contact</th><td>{{ $school->contact ?? '-' }}</td></tr>
        <tr><th>Meta</th><td>{{ $school->meta ?? '-' }}</td></tr>
        <tr><th>Created At</th><td>{{ $school->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $school->updated_at->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('schools.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
