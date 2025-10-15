@extends('layouts.admin')

@section('title', 'Kualifikasi Dosen')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Kualifikasi Dosen</h1>
            <p class="mb-0 text-muted">Kelola data kualifikasi dan riwayat pendidikan dosen</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.qualifications.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Kualifikasi
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search & Filter Section --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Pencarian</label>
                    <input type="text" name="q" id="search" class="form-control" 
                           value="{{ request('q') }}" 
                           placeholder="Cari nama dosen, bidang keilmuan, perguruan tinggi...">
                </div>
                <div class="col-md-2">
                    <label for="jenjang" class="form-label">Jenjang</label>
                    <select name="jenjang" id="jenjang" class="form-select">
                        <option value="">Semua Jenjang</option>
                        @foreach(\App\Models\Qualification::getJenjangPendidikanOptions() as $value => $label)
                            <option value="{{ $value }}" {{ request('jenjang') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional</label>
                    <select name="jabatan_fungsional" id="jabatan_fungsional" class="form-select">
                        <option value="">Semua Jabatan</option>
                        @foreach(\App\Models\Qualification::getJabatanFungsionalOptions() as $value => $label)
                            <option value="{{ $value }}" {{ request('jabatan_fungsional') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status_sertifikasi" class="form-label">Status Sertifikasi</label>
                    <select name="status_sertifikasi" id="status_sertifikasi" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach(\App\Models\Qualification::getStatusSertifikasiOptions() as $value => $label)
                            <option value="{{ $value }}" {{ request('status_sertifikasi') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
            </form>
            
            @if(request()->hasAny(['q', 'jenjang', 'jabatan_fungsional', 'status_sertifikasi']))
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <small class="text-muted">
                        Menampilkan {{ $qualifications->count() }} dari {{ $qualifications->total() }} data kualifikasi
                    </small>
                    <a href="{{ route('admin.qualifications.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Desktop Table View --}}
    <div class="card shadow-sm d-none d-lg-block">
        <div class="card-header bg-light">
            <h6 class="card-title mb-0">
                <i class="fas fa-table me-2"></i>Data Kualifikasi Dosen
            </h6>
        </div>
        
        <div class="card-body p-0">
            @if($qualifications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Dosen</th>
                                <th width="10%">Jenjang</th>
                                <th width="15%">Perguruan Tinggi</th>
                                <th width="15%">Bidang Keilmuan</th>
                                <th width="8%">IPK</th>
                                <th width="12%">Jabatan Fungsional</th>
                                <th width="8%">Sertifikasi</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qualifications as $qualification)
                                <tr>
                                    <td>{{ $qualifications->firstItem() + $loop->index }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>{{ $qualification->dosen->nama_lengkap }}</strong>
                                            <small class="text-muted">{{ $qualification->dosen->nidn_nip }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($qualification->jenjang_pendidikan)
                                            <span class="badge bg-primary">{{ $qualification->jenjang_pendidikan }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>{{ Str::limit($qualification->nama_perguruan_tinggi ?? '-', 30) }}</span>
                                            @if($qualification->akreditasi_pt)
                                                <small class="text-muted">Akreditasi: {{ $qualification->akreditasi_pt }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($qualification->bidang_keilmuan ?? '-', 25) }}</td>
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
                                            <span class="badge bg-info">{{ $qualification->jabatan_fungsional }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($qualification->status_sertifikasi)
                                            <span class="badge bg-{{ $qualification->status_sertifikasi == 'Sudah' ? 'success' : ($qualification->status_sertifikasi == 'Dalam Proses' ? 'warning' : 'secondary') }}">
                                                {{ $qualification->status_sertifikasi }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                                    data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.qualifications.show', $qualification) }}">
                                                        <i class="fas fa-eye me-2"></i>Lihat Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.qualifications.edit', $qualification) }}">
                                                        <i class="fas fa-edit me-2"></i>Edit
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#" 
                                                       onclick="confirmDelete({{ $qualification->id }}, '{{ $qualification->dosen->nama_lengkap }}')">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada data kualifikasi</h5>
                    <p class="text-muted mb-4">Belum ada data kualifikasi dosen yang tersedia</p>
                    <a href="{{ route('admin.qualifications.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Kualifikasi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Mobile Card View --}}
    <div class="d-block d-lg-none">
        @if($qualifications->count() > 0)
            <div class="row g-3">
                @foreach($qualifications as $qualification)
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-1">{{ $qualification->dosen->nama_lengkap }}</h6>
                                        <small class="text-muted">{{ $qualification->dosen->nidn_nip }}</small>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.qualifications.show', $qualification) }}">
                                                    <i class="fas fa-eye me-2"></i>Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.qualifications.edit', $qualification) }}">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" 
                                                   onclick="confirmDelete({{ $qualification->id }}, '{{ $qualification->dosen->nama_lengkap }}')">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Jenjang</small>
                                        @if($qualification->jenjang_pendidikan)
                                            <span class="badge bg-primary">{{ $qualification->jenjang_pendidikan }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">IPK</small>
                                        @if($qualification->ipk)
                                            <span class="badge bg-{{ $qualification->ipk >= 3.5 ? 'success' : ($qualification->ipk >= 3.0 ? 'warning' : 'danger') }}">
                                                {{ number_format($qualification->ipk, 2) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Jabatan Fungsional</small>
                                        @if($qualification->jabatan_fungsional)
                                            <span class="badge bg-info">{{ $qualification->jabatan_fungsional }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Sertifikasi</small>
                                        @if($qualification->status_sertifikasi)
                                            <span class="badge bg-{{ $qualification->status_sertifikasi == 'Sudah' ? 'success' : ($qualification->status_sertifikasi == 'Dalam Proses' ? 'warning' : 'secondary') }}">
                                                {{ $qualification->status_sertifikasi }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <small class="text-muted d-block">Perguruan Tinggi</small>
                                    <span>{{ $qualification->nama_perguruan_tinggi ?? '-' }}</span>
                                </div>
                                
                                <div>
                                    <small class="text-muted d-block">Bidang Keilmuan</small>
                                    <span>{{ $qualification->bidang_keilmuan ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada data kualifikasi</h5>
                    <p class="text-muted mb-4">Belum ada data kualifikasi dosen yang tersedia</p>
                    <a href="{{ route('admin.qualifications.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Kualifikasi
                    </a>
                </div>
            </div>
        @endif
    </div>

    {{-- Pagination --}}
    @if($qualifications->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $qualifications->withQueryString()->links() }}
        </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-1">Apakah Anda yakin ingin menghapus kualifikasi:</p>
                <strong id="itemName" class="text-danger"></strong>
                <p class="mt-2 mb-0 text-muted small">Data yang sudah dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.table td {
    vertical-align: middle;
    padding: 0.75rem 0.5rem;
}

.badge {
    font-size: 0.75em;
}

.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.775rem;
    }
}
</style>

<script>
function confirmDelete(id, name) {
    document.getElementById('itemName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/qualifications/${id}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Auto-submit form on select change for better UX
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('#jenjang, #jabatan_fungsional, #status_sertifikasi');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>
@endsection
