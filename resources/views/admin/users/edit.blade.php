@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit User</h2>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name',$user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email',$user->email) }}">
        </div>

        <div class="mb-3">
            <label>Password (biarkan kosong jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role_id" class="form-select">
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $r)
                    <option value="{{ $r->id }}" {{ old('role_id',$user->role_id)==$r->id ? 'selected' : '' }}>
                        {{ $r->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone',$user->phone) }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date',$user->birth_date) }}">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="gender" class="form-select">
                <option value="">-- Pilih --</option>
                <option value="male" {{ old('gender',$user->gender)=='male' ? 'selected':'' }}>Laki-laki</option>
                <option value="female" {{ old('gender',$user->gender)=='female' ? 'selected':'' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control">{{ old('address',$user->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Avatar (upload baru untuk ganti)</label>
            <input type="file" name="avatar" class="form-control">
        </div>

        <div class="mb-3">
            <label>KTP / ID Card (upload baru untuk ganti)</label>
            <input type="file" name="idcard" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
