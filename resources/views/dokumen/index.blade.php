@extends('frontend.layouts.app')

@section('title', 'Dokumen')

@section('content')
<!-- Hero Section -->
{{-- <section class="hero-section bg-gradient-primary py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="text-white mb-3">Dokumen</h1>
                <h2 class="text-white h3 mb-4">Koleksi Dokumen Akademik</h2>
                <p class="text-white-50 lead mb-4">
                    Kumpulan dokumen akademik yang mencakup berbagai jenis file seperti PDF, dokumen, dan materi pembelajaran
                    yang dapat diunduh dan diakses oleh civitas akademika.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-file-pdf mr-1"></i>PDF
                    </div>
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-file-word mr-1"></i>DOC/DOCX
                    </div>
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-file-excel mr-1"></i>XLS/XLSX
                    </div>
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-file-powerpoint mr-1"></i>PPT/PPTX
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="hero-icon">
                    <i class="fas fa-folder-open text-white" style="font-size: 8rem; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Statistics Section -->
<section class="py-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-primary mb-3">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                        <h3 class="h4 text-primary mb-1">{{ $dokumens->total() }}</h3>
                        <p class="text-muted mb-0">Total Dokumen</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-success mb-3">
                            <i class="fas fa-file-pdf fa-2x"></i>
                        </div>
                        <h3 class="h4 text-success mb-1">{{ $dokumens->where('file_extension', 'pdf')->count() }}</h3>
                        <p class="text-muted mb-0">File PDF</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-warning mb-3">
                            <i class="fas fa-file-word fa-2x"></i>
                        </div>
                        <h3 class="h4 text-warning mb-1">{{ $dokumens->whereIn('file_extension', ['doc', 'docx'])->count() }}</h3>
                        <p class="text-muted mb-0">Dokumen Word</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-info mb-3">
                            <i class="fas fa-file-excel fa-2x"></i>
                        </div>
                        <h3 class="h4 text-info mb-1">{{ $dokumens->whereIn('file_extension', ['xls', 'xlsx'])->count() }}</h3>
                        <p class="text-muted mb-0">Spreadsheet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="mb-5">
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('dokumen.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label">Pencarian</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" id="search" class="form-control"
                                   placeholder="Cari judul dokumen..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="extension" class="form-label">Tipe File</label>
                        <select name="extension" id="extension" class="form-control">
                            <option value="">Semua Tipe</option>
                            <option value="pdf" {{ request('extension') == 'pdf' ? 'selected' : '' }}>PDF</option>
                            <option value="doc" {{ request('extension') == 'doc' ? 'selected' : '' }}>DOC</option>
                            <option value="docx" {{ request('extension') == 'docx' ? 'selected' : '' }}>DOCX</option>
                            <option value="xls" {{ request('extension') == 'xls' ? 'selected' : '' }}>XLS</option>
                            <option value="xlsx" {{ request('extension') == 'xlsx' ? 'selected' : '' }}>XLSX</option>
                            <option value="ppt" {{ request('extension') == 'ppt' ? 'selected' : '' }}>PPT</option>
                            <option value="pptx" {{ request('extension') == 'pptx' ? 'selected' : '' }}>PPTX</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter mr-1"></i>Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Documents List Section -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="mb-0"><i class="fas fa-folder-open mr-2"></i>Daftar Dokumen</h4>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge badge-light">{{ $dokumens->total() }} dokumen tersedia</span>
                        @if($dokumens->hasPages())
                        <span class="badge badge-light">Halaman {{ $dokumens->currentPage() }} dari {{ $dokumens->lastPage() }}</span>
                        @endif
                        @if(request('extension'))
                        <span class="badge badge-info">{{ strtoupper(request('extension')) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if($dokumens->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="35%">Dokumen</th>
                                <th width="15%">Tipe File</th>
                                <th width="15%">Ukuran</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokumens as $index => $dokumen)
                            <tr>
                                <td class="text-center">{{ $dokumens->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            @switch($dokumen->file_extension)
                                                @case('pdf')
                                                    <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                    @break
                                                @case('doc')
                                                @case('docx')
                                                    <i class="fas fa-file-word fa-2x text-primary"></i>
                                                    @break
                                                @case('xls')
                                                @case('xlsx')
                                                    <i class="fas fa-file-excel fa-2x text-success"></i>
                                                    @break
                                                @case('ppt')
                                                @case('pptx')
                                                    <i class="fas fa-file-powerpoint fa-2x text-warning"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-file fa-2x text-muted"></i>
                                            @endswitch
                                        </div>
                                        <div class="flex-grow-1">
                                            <strong>
                                                <a href="{{ route('dokumen.show', $dokumen->slug) }}" class="text-decoration-none text-dark">
                                                    {{ $dokumen->judul }}
                                                </a>
                                            </strong>
                                            <br>
                                            <small class="text-muted">{{ $dokumen->file_name }}</small>
                                            @if($dokumen->deskripsi)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($dokumen->deskripsi, 80) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">
                                        {{ strtoupper($dokumen->file_extension) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-outline-secondary">
                                        {{ $dokumen->file_size_formatted }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $dokumen->created_at->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('dokumen.download', $dokumen->slug) }}"
                                           class="btn btn-success btn-sm"
                                           target="_blank"
                                           title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="{{ route('dokumen.show', $dokumen->slug) }}"
                                           class="btn btn-primary btn-sm"
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-folder-open fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Tidak ada dokumen ditemukan</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['search', 'extension']))
                            Coba ubah kriteria pencarian atau filter Anda untuk menemukan dokumen yang diinginkan.
                        @else
                            Belum ada dokumen yang dipublikasikan saat ini.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'extension']))
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('dokumen.index') }}" class="btn btn-primary">
                            <i class="fas fa-refresh mr-1"></i>Reset Filter
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="fas fa-home mr-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                    @else
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home mr-1"></i>Kembali ke Beranda
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- Pagination -->
        @if($dokumens->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Dokumen pagination">
                {{ $dokumens->withQueryString()->links('pagination::bootstrap-5') }}
            </nav>
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="10" cy="50" r="1" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="1" fill="white" opacity="0.1"/><circle cx="30" cy="90" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

.badge-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background: transparent;
}

.table th {
    vertical-align: middle;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

@media (max-width: 768px) {
    .hero-section {
        text-align: center;
    }

    .table-responsive {
        font-size: 0.875rem;
    }

    .table th, .table td {
        padding: 0.5rem;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .btn-group .btn {
        margin-right: 0;
        border-radius: 0.25rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto submit form when filter changes
    const filterSelects = document.querySelectorAll('#extension');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>
@endpush
