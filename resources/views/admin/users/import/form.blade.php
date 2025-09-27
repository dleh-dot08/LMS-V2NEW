@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi bi-upload me-2 text-primary"></i> Import User
        </h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form action="{{ route('admin.users.import.preview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label fw-semibold">Pilih File (CSV/Excel)</label>
                    <input 
                        type="file" 
                        class="form-control @error('file') is-invalid @enderror" 
                        id="file" 
                        name="file" 
                        required
                    >
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Format yang didukung: <strong>.csv, .xls, .xlsx</strong>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-eye me-1"></i> Preview Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
