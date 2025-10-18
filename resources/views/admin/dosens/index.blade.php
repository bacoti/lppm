@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Data Dosen</h3>
        <a href="{{ route('admin.dosens.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Dosen
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search Form --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.dosens.index') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}"
                               class="form-control"
                               placeholder="Cari nama dosen, NIDN/NIP, gelar akademik, atau tempat lahir...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        @if(request('q'))
                            <a href="{{ route('admin.dosens.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-users"></i> Daftar Dosen
                @if(request('q'))
                    <small class="text-muted">(Hasil pencarian: "{{ request('q') }}")</small>
                @endif
            </h5>
        </div>
        <div class="card-body">
            @if($dosens->count() > 0)
                {{-- Desktop Table --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">NIDN/NIP</th>
                                <th width="22%">Nama Dosen</th>
                                <th width="10%">Foto</th>
                                <th width="10%">Gelar</th>
                                <th width="10%">Email</th>
                                <th width="10%">Role</th>
                                <th width="15%">Departemen</th>
                                <th width="11%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $loop->iteration + ($dosens->currentPage() - 1) * $dosens->perPage() }}</td>
                                    <td>
                                        <strong>{{ $dosen->nidn_nip ?: '-' }}</strong>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $dosen->nama_lengkap ?: 'Nama belum diisi' }}</strong>
                                        </div>
                                        <div>
                                            <small class="text-muted">{{ $dosen->affiliation ?? '' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($dosen->photo)
                                            <img src="{{ asset('storage/' . $dosen->photo) }}"
                                                 alt="Foto {{ $dosen->nama_lengkap }}"
                                                 class="rounded-circle"
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $dosen->gelar_akademik ?: '-' }}</td>
                                    <td>{{ $dosen->email ?: '-' }}</td>
                                    <td>{{ $dosen->getRoleLabel() }}</td>
                                    <td>{{ $dosen->department ?: '-' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.dosens.show', $dosen) }}"
                                               class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.dosens.edit', $dosen) }}"
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete"
                                                    data-id="{{ $dosen->id }}"
                                                    data-name="{{ $dosen->nama_lengkap }}" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $dosen->id }}"
                                              action="{{ route('admin.dosens.destroy', $dosen->id) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Cards --}}
                <div class="d-lg-none">
                    @foreach ($dosens as $dosen)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        @if($dosen->photo)
                                            <img src="{{ asset('storage/' . $dosen->photo) }}"
                                                 alt="Foto {{ $dosen->nama_lengkap }}"
                                                 class="rounded-circle w-100"
                                                 style="height: 80px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center w-100"
                                                 style="height: 80px;">
                                                <i class="fas fa-user text-white fa-2x"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <h6 class="card-title mb-1">{{ $dosen->nama_lengkap ?: 'Nama belum diisi' }}</h6>
                                            <p class="card-text mb-1">
                                                <small class="text-muted">NIDN/NIP:</small>
                                                <strong>{{ $dosen->nidn_nip ?: '-' }}</strong>
                                            </p>
                                            <p class="card-text mb-1">
                                                <small class="text-muted">Gelar:</small> {{ $dosen->gelar_akademik ?: '-' }}
                                            </p>
                                            <p class="card-text mb-1 text-truncate">
                                                <small class="text-muted">Email:</small> {{ $dosen->email ?: '-' }}
                                            </p>
                                            <p class="card-text mb-2">
                                                <small class="text-muted">Prodi:</small> {{ $dosen->department ?: '-' }}
                                            </p>
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ route('admin.dosens.show', $dosen) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('admin.dosens.edit', $dosen) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete"
                                                    data-id="{{ $dosen->id }}" data-name="{{ $dosen->nama_lengkap }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $dosens->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">
                        @if(request('q'))
                            Tidak ada hasil pencarian untuk "{{ request('q') }}"
                        @else
                            Belum ada data dosen
                        @endif
                    </h5>
                    <p class="text-muted">
                        @if(request('q'))
                            Coba gunakan kata kunci yang berbeda atau
                            <a href="{{ route('admin.dosens.index') }}">lihat semua data</a>
                        @else
                            Klik tombol "Tambah Dosen" untuk menambahkan data dosen pertama
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const dosenId = this.getAttribute('data-id');
                const dosenName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Yakin ingin menghapus data dosen:<br><strong>${dosenName}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + dosenId).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
