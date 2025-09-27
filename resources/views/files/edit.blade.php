@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit File</h2>

    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Replace File (Optional)</label>
            <input type="file" name="file" class="form-control">
            <small>Current: {{ $file->filename }}</small>
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
