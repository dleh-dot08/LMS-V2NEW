@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit School</h2>

    <form action="{{ route('schools.update', $school->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $school->name }}" required>
        </div>
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $school->code }}">
        </div>
        <div class="mb-3">
            <label>Contact</label>
            <textarea name="contact" class="form-control">{{ $school->contact }}</textarea>
        </div>
        <div class="mb-3">
            <label>Meta</label>
            <textarea name="meta" class="form-control">{{ $school->meta }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('schools.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
