@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Class Group</h2>

    <form action="{{ route('class-groups.update', $classGroup->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>School</label>
            <select name="school_id" class="form-control" required>
                <option value="">-- Select School --</option>
                @foreach($schools as $school)
                <option value="{{ $school->id }}" {{ $classGroup->school_id == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $classGroup->name }}" required>
        </div>
        <div class="mb-3">
            <label>Grade Label</label>
            <input type="text" name="grade_label" class="form-control" value="{{ $classGroup->grade_label }}">
        </div>
        <div class="mb-3">
            <label>Academic Year</label>
            <input type="number" name="academic_year" class="form-control" value="{{ $classGroup->academic_year }}" required>
        </div>
        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $classGroup->capacity }}">
        </div>
        <div class="mb-3">
            <label>Meta</label>
            <textarea name="meta" class="form-control">{{ $classGroup->meta }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('class-groups.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
