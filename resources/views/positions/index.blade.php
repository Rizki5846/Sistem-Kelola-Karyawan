
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Jabatan</h4>
            <p class="text-muted mb-0">Kelola jabatan dalam perusahaan.</p>
        </div>
        <a href="{{ route('positions.create') }}" class="btn btn-primary">
            Tambah Jabatan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Jabatan</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Karyawan</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $position)
                            <tr>
                                <td>{{ $positions->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold">{{ $position->name }}</td>
                                <td>{{ $position->description ?: '-' }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $position->employees_count }} karyawan
                                    </span>
                                </td>
                                <td>
                                    @if ($position->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('positions.edit', $position) }}"
                                       class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('positions.destroy', $position) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data jabatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $positions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
