@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>+ Add File</h2>

    <form action="{{ route('files.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Filename</label>
            <input type="text" name="filename" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Storage Path</label>
            <input type="text" name="storage_path" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>MIME</label>
            <input type="text" name="mime" class="form-control">
        </div>
        <div class="mb-3">
            <label>Size (bytes)</label>
            <input type="number" name="size" class="form-control">
        </div>
        <div class="mb-3">
            <label>Meta</label>
            <textarea name="meta" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('files.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
