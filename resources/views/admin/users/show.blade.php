@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail User</h2>
            <a href="{{ route('admin.users.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white shadow rounded-lg p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Kiri --}}
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Telepon</p>
                        <p class="font-medium text-gray-900">{{ $user->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p class="font-medium text-gray-900">
                            {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-medium text-gray-900">{{ $user->gender ?? '-' }}</p>
                    </div>
                </div>

                {{-- Kanan --}}
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-medium text-gray-900">{{ $user->address ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="font-medium text-gray-900">{{ $user->role->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        @if($user->is_active)
                            <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded">Aktif</span>
                        @else
                            <span class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded">Nonaktif</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Terakhir Login</p>
                        <p class="font-medium text-gray-900">
                            {{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : '-' }}
                            <br>
                            <span class="text-xs text-gray-500">{{ $user->last_login_ip ?? '' }}</span>
                        </p>
                    </div>
                </div>

            </div>

            {{-- Avatar & KTP --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Foto Profil</p>
                    @if($user->avatar_file_id)
                        <img src="{{ asset('storage/avatars/'.$user->avatar_file_id) }}" 
                             alt="Avatar" class="w-32 h-32 object-cover rounded-lg shadow">
                    @else
                        <span class="text-gray-400 italic">Belum ada foto</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-2">Foto KTP</p>
                    @if($user->idcard_file_id)
                        <img src="{{ asset('storage/idcards/'.$user->idcard_file_id) }}" 
                             alt="ID Card" class="w-32 h-32 object-cover rounded-lg shadow">
                    @else
                        <span class="text-gray-400 italic">Belum ada KTP</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
