@extends('admin.layouts.admin')

@section('title', 'Pengabdian Masyarakat')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1"><i class="fas fa-hands-helping text-primary mr-2"></i>Pengabdian Masyarakat</h3>
                    <p class="text-muted mb-0 small">Kelola data pengabdian kepada masyarakat</p>
                </div>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i>Tambah Pengabdian
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $services->total() }}</h3>
                    <p>Total Pengabdian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Service::where('status', 'ongoing')->count() }}</h3>
                    <p>Sedang Berjalan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-spinner"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Service::whereIn('status', ['completed', 'reported'])->count() }}</h3>
                    <p>Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ \App\Models\Service::whereYear('tanggal_mulai', date('Y'))->count() }}</h3>
                    <p>Tahun Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card">
        <!-- Filter Section -->
        <div class="card-header">
            <h5 class="card-title mb-3"><i class="fas fa-filter mr-2"></i>Filter Data</h5>
            <form method="GET" action="{{ route('admin.services.index') }}" class="row">
                <div class="col-md-3 mb-2">
                    <label for="search" class="small text-muted">Cari Judul</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="search" name="search"
                               value="{{ request('search') }}" placeholder="Cari judul pengabdian...">
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="status" class="small text-muted">Status</label>
                    <select class="form-control form-control-sm" id="status" name="status">
                        <option value="">Semua Status</option>
                        @foreach($statusOptions as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="jenis_pengabdian" class="small text-muted">Jenis</label>
                    <select class="form-control form-control-sm" id="jenis_pengabdian" name="jenis_pengabdian">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisOptions as $key => $label)
                            <option value="{{ $key }}" {{ request('jenis_pengabdian') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="dosen_id" class="small text-muted">Dosen</label>
                    <select class="form-control form-control-sm" id="dosen_id" name="dosen_id">
                        <option value="">Semua Dosen</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}" {{ request('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="year" class="small text-muted">Tahun</label>
                    <select class="form-control form-control-sm" id="year" name="year">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-1 mb-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Services Table -->
        <div class="card-body p-0">
            @if($services->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Judul & Bidang</th>
                                <th style="width: 180px;">Penanggung Jawab</th>
                                <th style="width: 120px;">Jenis</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 150px;">Progress</th>
                                <th style="width: 150px;">Waktu</th>
                                <th style="width: 130px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td class="text-muted">{{ $services->firstItem() + $loop->index }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.services.show', $service) }}" 
                                               class="text-dark font-weight-bold d-block service-title">
                                                {{ Str::limit($service->judul, 60) }}
                                            </a>
                                            @if($service->bidang)
                                                <small class="text-muted">
                                                    <i class="fas fa-bookmark mr-1"></i>{{ $service->bidang }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($service->dosen)
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle mr-2">
                                                    {{ strtoupper(substr($service->dosen->nama_lengkap, 0, 2)) }}
                                                </div>
                                                <span class="text-truncate" style="max-width: 130px;">
                                                    {{ $service->dosen->nama_lengkap }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($service->jenis_pengabdian)
                                            <span class="badge badge-secondary">
                                                {{ Str::limit($jenisOptions[$service->jenis_pengabdian] ?? $service->jenis_pengabdian, 12) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $service->getStatusBadgeClass() }}">
                                            {{ $statusOptions[$service->status] ?? $service->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($service->progress_percentage !== null)
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: {{ $service->progress_percentage }}%"
                                                         aria-valuenow="{{ $service->progress_percentage }}"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small class="text-muted font-weight-bold" style="min-width: 35px;">
                                                    {{ $service->progress_percentage }}%
                                                </small>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">
                                            @if($service->tanggal_mulai)
                                                <div class="text-muted">
                                                    <i class="far fa-calendar-check mr-1"></i>{{ $service->tanggal_mulai->format('d/m/Y') }}
                                                </div>
                                            @endif
                                            @if($service->tanggal_selesai)
                                                <div class="text-muted">
                                                    <i class="far fa-calendar-times mr-1"></i>{{ $service->tanggal_selesai->format('d/m/Y') }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.services.show', $service) }}"
                                               class="btn btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.services.edit', $service) }}"
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.services.destroy', $service) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengabdian ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Menampilkan <strong>{{ $services->firstItem() }}</strong> -
                        <strong>{{ $services->lastItem() }}</strong> dari
                        <strong>{{ $services->total() }}</strong> pengabdian
                    </div>
                    <div class="pagination-container">
                        {{ $services->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-hands-helping fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data pengabdian masyarakat</h5>
                    <p class="text-muted mb-4">Mulai tambahkan data pengabdian masyarakat pertama Anda.</p>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Tambah Pengabdian Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Avatar Circle */
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    flex-shrink: 0;
}

/* Service Title Link */
.service-title {
    transition: color 0.2s;
    text-decoration: none;
}

.service-title:hover {
    color: #007bff !important;
    text-decoration: none;
}

/* Progress Bar */
.progress {
    border-radius: 10px;
    background-color: #e9ecef;
}

.progress-bar {
    border-radius: 10px;
}

/* Table Styling */
.table thead th {
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    font-size: 0.875rem;
    color: #6c757d;
    background-color: #f8f9fa;
}

.table tbody tr {
    transition: background-color 0.2s;
}

.table tbody tr:hover {
    background-color: #f1f3f5;
}

/* Small Box Adjustments */
.small-box {
    border-radius: 8px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.small-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Badge Styling */
.badge {
    padding: 0.4em 0.65em;
    font-weight: 500;
    font-size: 0.8rem;
}

/* Pagination Styling */
.pagination-container .pagination {
    margin: 0;
}

.pagination-container .page-link {
    color: #007bff;
    border-color: #dee2e6;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}

.pagination-container .page-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
    border-color: #adb5bd;
}

.pagination-container .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.pagination-container .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
}

/* Card Footer */
.card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 1rem 1.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .avatar-circle {
        display: none;
    }
    
    .table {
        font-size: 0.875rem;
    }
    
    .pagination-container {
        margin-top: 10px;
        width: 100%;
    }
    
    .card-footer {
        flex-direction: column;
        align-items: stretch !important;
        text-align: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-submit form when filter changes
    $('#status, #jenis_pengabdian, #dosen_id, #year').change(function() {
        $(this).closest('form').submit();
    });
    
    // Add loading state to filter button
    $('form').on('submit', function() {
        var btn = $(this).find('button[type="submit"]');
        btn.html('<i class="fas fa-spinner fa-spin"></i>');
        btn.prop('disabled', true);
    });
});
</script>
@endpush
