@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Semester</h2>

    <form action="{{ route('semesters.update', $semester->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $semester->name }}" required>
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $semester->start_date }}">
        </div>
        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $semester->end_date }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $semester->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
