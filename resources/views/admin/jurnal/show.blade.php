@extends('admin.layouts.admin')

@section('title', 'Detail Jurnal')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold">
                    <i class="fas fa-eye mr-2 text-info"></i>Detail Jurnal
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jurnal.index') }}">Jurnal</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="float-right">
                <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
                <a href="{{ route('admin.jurnal.edit', $jurnal) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                <form action="{{ route('admin.jurnal.destroy', $jurnal) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Information -->
        <div class="col-md-8">
            <!-- Basic Information Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                        @if($jurnal->is_featured)
                            <span class="badge badge-warning ml-2">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        @endif
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-primary mb-3">{{ $jurnal->judul }}</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <strong>Nama Jurnal:</strong>
                                <p class="mb-1">{{ $jurnal->nama_jurnal }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <strong>Penerbit:</strong>
                                <p class="mb-1">{{ $jurnal->penerbit ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Jenis:</strong>
                                <p class="mb-1">
                                    <span class="badge {{ $jurnal->getJenisJurnalBadgeClass() }}">
                                        {{ \App\Models\Jurnal::getJenisJurnalOptions()[$jurnal->jenis_jurnal] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Status:</strong>
                                <p class="mb-1">
                                    <span class="badge {{ $jurnal->getStatusBadgeClass() }}">
                                        {{ \App\Models\Jurnal::getStatusOptions()[$jurnal->status] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Tahun:</strong>
                                <p class="mb-1">{{ $jurnal->tahun ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Akreditasi:</strong>
                                <p class="mb-1">
                                    @if($jurnal->akreditasi)
                                        <span class="badge {{ $jurnal->getAkreditasiBadgeClass() }}">
                                            {{ \App\Models\Jurnal::getAkreditasiOptions()[$jurnal->akreditasi] }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Authors Card -->
            @if($jurnal->penulis && count($jurnal->penulis) > 0)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-2"></i>Penulis
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($jurnal->penulis as $index => $penulis)
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-primary mr-2">{{ $index + 1 }}</span>
                                    <span>{{ $penulis }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Publication Details Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-book mr-2"></i>Detail Publikasi
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Volume:</strong>
                                <p class="mb-1">{{ $jurnal->volume ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Nomor:</strong>
                                <p class="mb-1">{{ $jurnal->nomor ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>Halaman:</strong>
                                <p class="mb-1">{{ $jurnal->halaman ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item mb-3">
                                <strong>ISSN:</strong>
                                <p class="mb-1">{{ $jurnal->issn ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <strong>DOI:</strong>
                                <p class="mb-1">
                                    @if($jurnal->doi)
                                        <a href="https://doi.org/{{ $jurnal->doi }}" target="_blank" class="text-primary">
                                            {{ $jurnal->doi }}
                                            <i class="fas fa-external-link-alt ml-1"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <strong>URL:</strong>
                                <p class="mb-1">
                                    @if($jurnal->url_jurnal)
                                        <a href="{{ $jurnal->url_jurnal }}" target="_blank" class="text-primary">
                                            {{ Str::limit($jurnal->url_jurnal, 50) }}
                                            <i class="fas fa-external-link-alt ml-1"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Abstract Card -->
            @if($jurnal->abstrak)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt mr-2"></i>Abstrak
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-justify">{{ $jurnal->abstrak }}</p>
                </div>
            </div>
            @endif

            <!-- Keywords Card -->
            @if($jurnal->kata_kunci && count($jurnal->kata_kunci) > 0)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tags mr-2"></i>Kata Kunci
                    </h3>
                </div>
                <div class="card-body">
                    @foreach($jurnal->kata_kunci as $keyword)
                        <span class="badge badge-secondary mr-1 mb-1">{{ $keyword }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Cover Image Card -->
            @if($jurnal->cover_image)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-image mr-2"></i>Cover Jurnal
                    </h3>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($jurnal->cover_image) }}"
                         alt="Cover {{ $jurnal->judul }}"
                         class="img-fluid rounded shadow-sm">
                </div>
            </div>
            @endif

            <!-- Files Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-download mr-2"></i>File & Download
                    </h3>
                </div>
                <div class="card-body">
                    @if($jurnal->file_pdf)
                        <div class="d-grid gap-2">
                            <a href="{{ Storage::url($jurnal->file_pdf) }}"
                               target="_blank" class="btn btn-primary btn-block">
                                <i class="fas fa-file-pdf mr-2"></i>Download PDF
                            </a>
                        </div>
                        <small class="text-muted d-block mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            File: {{ basename($jurnal->file_pdf) }}
                        </small>
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-file-times fa-2x mb-2"></i>
                            <p>Tidak ada file yang tersedia</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>Statistik
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-right">
                                <h4 class="text-primary">{{ $jurnal->view_count }}</h4>
                                <small class="text-muted">Dilihat</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">{{ $jurnal->download_count }}</h4>
                            <small class="text-muted">Download</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info mr-2"></i>Metadata
                    </h3>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <div class="mb-2">
                            <strong>Slug:</strong> {{ $jurnal->slug }}
                        </div>
                        <div class="mb-2">
                            <strong>Dibuat:</strong> {{ $jurnal->created_at->format('d M Y H:i') }}
                        </div>
                        <div class="mb-2">
                            <strong>Diperbarui:</strong> {{ $jurnal->updated_at->format('d M Y H:i') }}
                        </div>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.info-item strong {
    color: #495057;
    font-size: 0.9rem;
}

.info-item p {
    font-size: 1rem;
    color: #212529;
}

.border-right {
    border-right: 1px solid #dee2e6 !important;
}

@media (max-width: 768px) {
    .border-right {
        border-right: none !important;
        border-bottom: 1px solid #dee2e6 !important;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
}
</style>
@endpush
