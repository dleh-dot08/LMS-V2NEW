@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>+ Upload File</h2>

    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>File</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Meta (Optional)</label>
            <textarea name="meta" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Upload</button>
        <a href="{{ route('files.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
