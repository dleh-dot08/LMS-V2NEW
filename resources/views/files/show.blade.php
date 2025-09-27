@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>File Details</h2>

    <table class="table table-bordered">
        <tr><th>Filename</th><td>{{ $file->filename }}</td></tr>
        <tr><th>Storage Path</th><td>{{ $file->storage_path }}</td></tr>
        <tr><th>MIME</th><td>{{ $file->mime }}</td></tr>
        <tr><th>Size</th><td>{{ $file->size }}</td></tr>
        <tr><th>Uploaded By</th><td>{{ $file->uploader ? $file->uploader->name : '-' }}</td></tr>
        <tr><th>Created At</th><td>{{ $file->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $file->updated_at->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('files.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
