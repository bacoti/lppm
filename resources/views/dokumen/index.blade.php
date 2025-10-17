@extends('frontend.layouts.app')

@section('title', 'Dokumen')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0"><i class="fas fa-file-alt mr-2"></i>Dokumen</h4>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge badge-light fs-6 px-3 py-2">
                                <i class="fas fa-file mr-1"></i>{{ $dokumens->total() }} dokumen
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($dokumens->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($dokumens as $index => $dokumen)
                            <div class="list-group-item px-4 py-4">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="text-center">
                                            <span class="badge badge-primary badge-pill px-3 py-2 fs-6">
                                                {{ $dokumens->firstItem() + $index }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-file-{{ $dokumen->file_extension == 'pdf' ? 'pdf' : 'alt' }} fa-2x text-primary me-3"></i>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">
                                                    <a href="{{ route('dokumen.show', $dokumen->slug) }}" class="text-decoration-none text-dark">
                                                        {{ $dokumen->judul }}
                                                    </a>
                                                </h5>
                                                <p class="text-muted mb-2 small">{{ $dokumen->file_name }}</p>
                                                @if($dokumen->deskripsi)
                                                <p class="text-muted mb-0">{{ Str::limit($dokumen->deskripsi, 100) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row text-muted small">
                                            <div class="col-md-4">
                                                <i class="fas fa-tag me-1"></i>
                                                <span class="badge bg-light text-dark">{{ strtoupper($dokumen->file_extension) }}</span>
                                                <span class="ms-2">{{ $dokumen->file_size_formatted }}</span>
                                            </div>
                                            <div class="col-md-4">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $dokumen->created_at->format('d M Y') }}
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <a href="{{ route('dokumen.download', $dokumen->slug) }}"
                                                   class="btn btn-primary btn-sm me-2"
                                                   target="_blank">
                                                    <i class="fas fa-download me-1"></i>Download
                                                </a>
                                                <a href="{{ route('dokumen.show', $dokumen->slug) }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-1"></i>Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-center">
                                {{ $dokumens->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted mb-2">Belum ada dokumen</h5>
                            <p class="text-muted">Dokumen akan segera ditambahkan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
.list-group-item {
    border-left: none;
    border-right: none;
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.list-group-item h5 {
    font-size: 1.1rem;
    line-height: 1.4;
}

.list-group-item .fa-file-pdf {
    color: #dc3545 !important;
}

.list-group-item .fa-file-alt {
    color: #6c757d !important;
}

.badge-primary {
    background-color: #007bff;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .list-group-item .row > div {
        margin-bottom: 0.5rem;
    }

    .list-group-item h5 {
        font-size: 1rem;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
}
</style>
@endpush
