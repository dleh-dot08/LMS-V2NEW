@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit File</h2>

    <form action="{{ route('files.update', $file->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Filename</label>
            <input type="text" name="filename" class="form-control" value="{{ $file->filename }}" required>
        </div>
        <div class="mb-3">
            <label>Storage Path</label>
            <input type="text" name="storage_path" class="form-control" value="{{ $file->storage_path }}" required>
        </div>
        <div class="mb-3">
            <label>MIME</label>
            <input type="text" name="mime" class="form-control" value="{{ $file->mime }}">
        </div>
        <div class="mb-3">
            <label>Size (bytes)</label>
            <input type="number" name="size" class="form-control" value="{{ $file->size }}">
        </div>
        <div class="mb-3">
            <label>Meta</label>
            <textarea name="meta" class="form-control">{{ $file->meta }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('files.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
