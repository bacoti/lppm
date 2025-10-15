@extends('layouts.admin')

@section('title', 'Kualifikasi Dosen')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Kualifikasi Dosen</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kualifikasi Dosen</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.qualifications.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Kualifikasi
        </a>
    </div>

    {{-- Search & Filter Card --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" 
                               name="q" 
                               class="form-control" 
                               placeholder="Cari nama dosen, NIDN/NIP, perguruan tinggi, atau bidang keilmuan..." 
                               value="{{ request('q') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.qualifications.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Total Kualifikasi</h6>
                            <h4 class="mb-0">{{ $qualifications->total() }}</h4>
                        </div>
                        <i class="bi bi-mortarboard fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">S3/Doktor</h6>
                            <h4 class="mb-0">{{ $qualifications->where('jenjang_pendidikan', 'S3')->count() }}</h4>
                        </div>
                        <i class="bi bi-award fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">S2/Magister</h6>
                            <h4 class="mb-0">{{ $qualifications->where('jenjang_pendidikan', 'S2')->count() }}</h4>
                        </div>
                        <i class="bi bi-bookmark fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Tersertifikasi</h6>
                            <h4 class="mb-0">{{ $qualifications->whereNotNull('nomor_sertifikat_pendidik')->count() }}</h4>
                        </div>
                        <i class="bi bi-patch-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Card --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-table me-2"></i>
                    Data Kualifikasi Dosen
                </h5>
                <span class="badge bg-primary">{{ $qualifications->count() }} dari {{ $qualifications->total() }} data</span>
            </div>
        </div>

        <div class="card-body p-0">
            @if($qualifications->count() > 0)
                {{-- Desktop Table View --}}
                <div class="d-none d-lg-block">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Dosen</th>
                                    <th width="10%">Jenjang</th>
                                    <th width="15%">Perguruan Tinggi</th>
                                    <th width="15%">Bidang Keilmuan</th>
                                    <th width="8%">Tahun</th>
                                    <th width="8%">IPK</th>
                                    <th width="12%">Jabatan Fungsional</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qualifications as $qualification)
                                    <tr>
                                        <td>{{ ($qualifications->currentPage() - 1) * $qualifications->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <div>
                                                <strong>{{ $qualification->dosen->nama_lengkap ?? '-' }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $qualification->dosen->nidn_nip ?? '-' }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($qualification->jenjang_pendidikan)
                                                <span class="badge bg-{{ $qualification->jenjang_pendidikan == 'S3' ? 'success' : ($qualification->jenjang_pendidikan == 'S2' ? 'warning' : 'info') }}">
                                                    {{ $qualification->jenjang_pendidikan }}
                                                </span>
                                                @if($qualification->gelar_diperoleh)
                                                    <br><small class="text-muted">{{ $qualification->gelar_diperoleh }}</small>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                {{ Str::limit($qualification->nama_perguruan_tinggi ?? '-', 30) }}
                                                @if($qualification->akreditasi_pt)
                                                    <br><small class="badge bg-secondary">{{ $qualification->akreditasi_pt }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($qualification->bidang_keilmuan ?? '-', 25) }}</td>
                                        <td>
                                            {{ $qualification->tahun_lulus ?? '-' }}
                                            @if($qualification->status_kelulusan == 'Dalam Proses')
                                                <br><small class="badge bg-warning text-dark">Dalam Proses</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($qualification->ipk)
                                                <span class="badge bg-{{ $qualification->ipk >= 3.5 ? 'success' : ($qualification->ipk >= 3.0 ? 'warning' : 'danger') }}">
                                                    {{ number_format($qualification->ipk, 2) }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($qualification->jabatan_fungsional)
                                                <span class="badge bg-primary">{{ $qualification->jabatan_fungsional }}</span>
                                                @if($qualification->nomor_sertifikat_pendidik)
                                                    <br><small class="text-success"><i class="bi bi-patch-check"></i> Tersertifikasi</small>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.qualifications.show', $qualification) }}" 
                                                   class="btn btn-outline-info" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.qualifications.edit', $qualification) }}" 
                                                   class="btn btn-outline-warning"
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-outline-danger" 
                                                        onclick="confirmDelete('{{ $qualification->id }}', '{{ $qualification->dosen->nama_lengkap }}')"
                                                        data-bs-toggle="tooltip" 
                                                        title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Mobile Card View --}}
                <div class="d-lg-none">
                    @foreach ($qualifications as $qualification)
                        <div class="card m-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title mb-0">{{ $qualification->dosen->nama_lengkap ?? '-' }}</h6>
                                    <span class="badge bg-{{ $qualification->jenjang_pendidikan == 'S3' ? 'success' : ($qualification->jenjang_pendidikan == 'S2' ? 'warning' : 'info') }}">
                                        {{ $qualification->jenjang_pendidikan ?? '-' }}
                                    </span>
                                </div>
                                
                                <div class="row g-2 text-sm">
                                    <div class="col-6">
                                        <strong>NIDN/NIP:</strong><br>
                                        <span class="text-muted">{{ $qualification->dosen->nidn_nip ?? '-' }}</span>
                                    </div>
                                    <div class="col-6">
                                        <strong>Tahun Lulus:</strong><br>
                                        <span class="text-muted">{{ $qualification->tahun_lulus ?? '-' }}</span>
                                    </div>
                                    <div class="col-12">
                                        <strong>Perguruan Tinggi:</strong><br>
                                        <span class="text-muted">{{ $qualification->nama_perguruan_tinggi ?? '-' }}</span>
                                    </div>
                                    <div class="col-12">
                                        <strong>Bidang Keilmuan:</strong><br>
                                        <span class="text-muted">{{ $qualification->bidang_keilmuan ?? '-' }}</span>
                                    </div>
                                    @if($qualification->jabatan_fungsional)
                                        <div class="col-12">
                                            <strong>Jabatan Fungsional:</strong><br>
                                            <span class="badge bg-primary">{{ $qualification->jabatan_fungsional }}</span>
                                            @if($qualification->nomor_sertifikat_pendidik)
                                                <span class="badge bg-success ms-1">Tersertifikasi</span>
                                            @endif
                                        </div>
                                    @endif
                                    @if($qualification->ipk)
                                        <div class="col-6">
                                            <strong>IPK:</strong><br>
                                            <span class="badge bg-{{ $qualification->ipk >= 3.5 ? 'success' : ($qualification->ipk >= 3.0 ? 'warning' : 'danger') }}">
                                                {{ number_format($qualification->ipk, 2) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.qualifications.show', $qualification) }}" class="btn btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.qualifications.edit', $qualification) }}" class="btn btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                                onclick="confirmDelete('{{ $qualification->id }}', '{{ $qualification->dosen->nama_lengkap }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="text-muted mt-3">Tidak ada data kualifikasi</h4>
                    <p class="text-muted">
                        @if(request('q'))
                            Tidak ditemukan data yang sesuai dengan pencarian "{{ request('q') }}"
                        @else
                            Belum ada data kualifikasi dosen yang ditambahkan
                        @endif
                    </p>
                    <div class="mt-3">
                        @if(request('q'))
                            <a href="{{ route('admin.qualifications.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Reset Pencarian
                            </a>
                        @endif
                        <a href="{{ route('admin.qualifications.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            Tambah Kualifikasi Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        @if($qualifications->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Menampilkan {{ $qualifications->firstItem() }} sampai {{ $qualifications->lastItem() }} 
                        dari {{ $qualifications->total() }} data
                    </div>
                    {{ $qualifications->withQueryString()->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kualifikasi untuk dosen <strong id="dosenName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Tindakan ini tidak dapat dibatalkan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

function confirmDelete(id, dosenName) {
    document.getElementById('dosenName').textContent = dosenName;
    document.getElementById('deleteForm').action = `{{ route('admin.qualifications.index') }}/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection