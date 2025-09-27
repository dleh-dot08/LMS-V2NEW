@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Preview Import Users</h2>

    <form action="{{ route('admin.users.import.commit') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Error</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $rows = session('import_users', []); @endphp
                @forelse($rows as $i => $row)
                    <tr>
                        <td>{{ $row['data'][0] ?? '' }}</td>
                        <td>{{ $row['data'][1] ?? '' }}</td>
                        <td>{{ $row['data'][2] ?? '' }}</td>
                        <td>
                            @if(!empty($row['errors']))
                                <ul class="text-danger mb-0">
                                    @foreach($row['errors'] as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-success">Valid</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.users.import.remove', $i) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data preview</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(!empty($rows))
            <button type="submit" class="btn btn-success">Commit Import</button>
        @endif
    </form>
</div>
@endsection
