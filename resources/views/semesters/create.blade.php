@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>+ Add Semester</h2>

    <form action="{{ route('semesters.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1">
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
