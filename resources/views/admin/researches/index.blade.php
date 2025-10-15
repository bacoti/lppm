@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-microscope me-2"></i>
                            Data Penelitian
                        </h4>
                        <a href="{{ route('admin.researches.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Penelitian
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Advanced Filters -->
                    <div class="card-body border-bottom">
                        <form action="{{ route('admin.researches.index') }}" method="GET" class="row g-3">
                            <!-- Search -->
                            <div class="col-md-6">
                                <label for="q" class="form-label">Pencarian</label>
                                <input type="text" name="q" id="q" value="{{ request('q') }}"
                                       class="form-control" placeholder="Cari judul, bidang, dosen, keywords...">
                            </div>

                            <!-- Status Filter -->
                            <div class="col-md-2">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="all">Semua Status</option>
                                    @foreach($statusOptions as $value => $label)
                                        <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year Filter -->
                            <div class="col-md-2">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="all">Semua Tahun</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-2">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-select">
                                    <option value="all">Semua Kategori</option>
                                    @foreach($kategoriOptions as $value => $label)
                                        <option value="{{ $value }}" {{ request('kategori') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('admin.researches.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Research List -->
                    <div class="card-body">
                        @forelse ($researches as $research)
                            <div class="card mb-3 border-left-primary">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h6 class="card-title mb-2">
                                                <a href="{{ route('admin.researches.show', $research) }}" class="text-decoration-none">
                                                    {{ $research->judul }}
                                                </a>
                                            </h6>
                                            <div class="row g-2 text-muted small">
                                                <div class="col-auto">
                                                    <i class="fas fa-user me-1"></i>
                                                    {{ $research->dosen?->nama_lengkap ?? 'Tidak ada ketua' }}
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ $research->tahun ?? '-' }}
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-flask me-1"></i>
                                                    {{ $research->bidang ?? '-' }}
                                                </div>
                                                <div class="col-auto">
                                                    <span class="badge bg-{{ $research->getStatusBadgeClass() }}">
                                                        {{ $research->getStatusBadgeClass() === 'secondary' ? 'Draft' :
                                                           ($research->getStatusBadgeClass() === 'info' ? 'Diajukan' :
                                                           ($research->getStatusBadgeClass() === 'primary' ? 'Berjalan' :
                                                           ($research->getStatusBadgeClass() === 'success' ? 'Selesai' : 'Dibatalkan'))) }}
                                                    </span>
                                                </div>
                                            </div>
                                            @if($research->abstrak)
                                                <p class="card-text mt-2 text-muted small">
                                                    {{ Str::limit($research->abstrak, 150) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <div class="d-flex gap-1 justify-content-end flex-wrap">
                                                <a href="{{ route('admin.researches.show', $research) }}"
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.researches.edit', $research) }}"
                                                   class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $research->id }}"
                                                      action="{{ route('admin.researches.destroy', $research) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-danger btn-delete"
                                                            data-id="{{ $research->id }}"
                                                            data-title="{{ $research->judul }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @if($research->progress_percentage > 0)
                                                <div class="mt-2">
                                                    <small class="text-muted">Progress: {{ $research->progress_percentage }}%</small>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-{{ $research->getStatusBadgeClass() }}"
                                                             style="width: {{ $research->progress_percentage }}%"></div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-microscope fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data penelitian</h5>
                                <p class="text-muted">Mulai tambahkan data penelitian pertama Anda.</p>
                                <a href="{{ route('admin.researches.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Tambah Penelitian
                                </a>
                            </div>
                        @endforelse

                        <!-- Pagination -->
                        @if($researches->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $researches->withQueryString()->links('pagination::bootstrap-5') }}
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
    .border-left-primary {
        border-left: 4px solid #007bff !important;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    }

    .badge {
        font-size: 0.75em;
    }

    .progress {
        background-color: #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const researchId = this.getAttribute('data-id');
                const researchTitle = this.getAttribute('data-title');

                Swal.fire({
                    title: 'Hapus Penelitian?',
                    text: `Apakah Anda yakin ingin menghapus "${researchTitle}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + researchId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
