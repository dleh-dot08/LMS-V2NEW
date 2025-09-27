@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>+ Add School</h2>

    <form action="{{ route('schools.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control">
        </div>
        <div class="mb-3">
            <label>Contact</label>
            <textarea name="contact" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Meta</label>
            <textarea name="meta" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('schools.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
