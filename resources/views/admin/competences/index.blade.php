@extends('admin.layouts.admin')

@section('title', 'Data Kompetensi Dosen')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-certificate me-2"></i>
                                Data Kompetensi Dosen
                            </h4>
                            <a href="{{ route('admin.competences.create') }}" class="btn btn-light">
                                <i class="fas fa-plus me-2"></i>Tambah Kompetensi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Search and Filter Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.competences.index') }}" method="GET" class="row g-3">
                            <div class="col-md-6">
                                <label for="search" class="form-label">Pencarian</label>
                                <input type="text" name="q" id="search" value="{{ request('q') }}"
                                       class="form-control" 
                                       placeholder="Cari nama dosen, NIDN/NIP, keahlian bidang, atau sertifikat...">
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Status Sertifikasi</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">-- Semua Status --</option>
                                    @foreach(\App\Models\Competence::getStatusSertifikasiOptions() as $value => $label)
                                        <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-2"></i>Cari
                                    </button>
                                    <a href="{{ route('admin.competences.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-refresh me-2"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Dosen</th>
                                        <th width="15%">Keahlian Bidang</th>
                                        <th width="15%">Metodologi Pengajaran</th>
                                        <th width="12%">Sertifikat Pendidik</th>
                                        <th width="10%">Status Sertifikasi</th>
                                        <th width="8%">Tanggal Sertifikat</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($competences as $competence)
                                        <tr>
                                            <td>{{ ($competences->currentPage() - 1) * $competences->perPage() + $loop->iteration }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $competence->dosen->nama_lengkap ?? '-' }}</div>
                                                <small class="text-muted">{{ $competence->dosen->nidn_nip ?? '-' }}</small>
                                            </td>
                                            <td>
                                                <span class="text-truncate" style="max-width: 150px; display: inline-block;" 
                                                      title="{{ $competence->keahlian_bidang }}">
                                                    {{ $competence->keahlian_bidang ? Str::limit($competence->keahlian_bidang, 50) : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-truncate" style="max-width: 150px; display: inline-block;" 
                                                      title="{{ $competence->metodologi_pengajaran }}">
                                                    {{ $competence->metodologi_pengajaran ? Str::limit($competence->metodologi_pengajaran, 50) : '-' }}
                                                </span>
                                            </td>
                                            <td>{{ $competence->sertifikat_pendidik ?? '-' }}</td>
                                            <td>
                                                @if($competence->status_sertifikasi)
                                                    @php
                                                        $statusClass = match($competence->status_sertifikasi) {
                                                            'aktif' => 'bg-success',
                                                            'tidak_aktif' => 'bg-danger',
                                                            'proses_perpanjangan' => 'bg-warning text-dark',
                                                            default => 'bg-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $statusClass }}">
                                                        {{ \App\Models\Competence::getStatusSertifikasiOptions()[$competence->status_sertifikasi] ?? $competence->status_sertifikasi }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $competence->tanggal_sertifikat ? $competence->tanggal_sertifikat->format('d/m/Y') : '-' }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.competences.show', $competence) }}"
                                                       class="btn btn-sm btn-info" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.competences.edit', $competence) }}"
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.competences.destroy', $competence) }}" 
                                                          method="POST" class="d-inline" 
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kompetensi ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                                    <p class="mb-0">Tidak ada data kompetensi ditemukan</p>
                                                    @if(request('q') || request('status'))
                                                        <small>Coba ubah kata kunci pencarian atau filter</small>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($competences->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Menampilkan {{ $competences->firstItem() }} - {{ $competences->lastItem() }} 
                                    dari {{ $competences->total() }} data
                                </div>
                                <div>
                                    {{ $competences->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .table th {
        font-weight: 600;
        border-top: none;
    }
    
    .table-responsive {
        border-radius: 0.5rem;
    }
    
    .btn-group .btn {
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .alert {
        border-radius: 0.5rem;
    }
    
    .badge {
        font-size: 0.75em;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                if (alert && alert.querySelector('.btn-close')) {
                    alert.querySelector('.btn-close').click();
                }
            }, 5000);
        });
        
        // Search form enhancement
        const searchForm = document.querySelector('form');
        const searchInput = document.getElementById('search');
        
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchForm.submit();
                }
            });
        }
    });
</script>
@endpush
