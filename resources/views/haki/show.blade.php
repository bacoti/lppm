@extends('frontend.layouts.app')

@section('title', $haki->judul . ' - HAKI')

@section('content')
<!-- Breadcrumb -->
<section class="py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.haki') }}">HAKI</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($haki->judul, 30) }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Header -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="haki-type">
                                <span class="badge badge-primary badge-lg">
                                    @switch($haki->jenis_haki)
                                        @case('paten')
                                            <i class="fas fa-lightbulb mr-2"></i>
                                            @break
                                        @case('hak_cipta')
                                            <i class="fas fa-copyright mr-2"></i>
                                            @break
                                        @case('merek')
                                            <i class="fas fa-trademark mr-2"></i>
                                            @break
                                        @case('desain_industri')
                                            <i class="fas fa-drafting-compass mr-2"></i>
                                            @break
                                        @default
                                            <i class="fas fa-file mr-2"></i>
                                    @endswitch
                                    {{ $haki->getJenisHakiLabel() }}
                                </span>
                            </div>
                            <span class="badge badge-lg {{ $haki->getStatusBadgeClass() }}">
                                <i class="fas fa-circle mr-1"></i>{{ $haki->getStatusLabel() }}
                            </span>
                        </div>

                        <h1 class="h2 mb-3 text-primary">{{ $haki->judul }}</h1>

                        @if($haki->deskripsi)
                        <div class="description-section">
                            <h5 class="mb-3">Deskripsi</h5>
                            <p class="text-muted">{{ $haki->deskripsi }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Inventor/Pencipta -->
                @if($haki->inventor && count($haki->inventor) > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-users text-success mr-2"></i>Inventor/Pencipta
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($haki->inventor as $index => $inventor)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="inventor-number mr-3">
                                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white font-weight-bold"
                                             style="width: 40px; height: 40px;">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $inventor }}</h6>
                                        @if($index == 0)
                                            <small class="text-muted">Inventor Utama</small>
                                        @else
                                            <small class="text-muted">Inventor</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Informasi Detail -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-primary mr-2"></i>Informasi Detail
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($haki->bidang_teknologi)
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-muted small">BIDANG TEKNOLOGI</label>
                                <p class="mb-0">{{ $haki->bidang_teknologi }}</p>
                            </div>
                            @endif

                            @if($haki->klasifikasi)
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-muted small">KLASIFIKASI (IPC)</label>
                                <p class="mb-0">
                                    <span class="badge badge-secondary">{{ $haki->klasifikasi }}</span>
                                </p>
                            </div>
                            @endif

                            @if($haki->kantor_kekayaan_intelektual)
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-muted small">KANTOR KEKAYAAN INTELEKTUAL</label>
                                <p class="mb-0">{{ $haki->kantor_kekayaan_intelektual }}</p>
                            </div>
                            @endif

                            @if($haki->tanggal_daftar)
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-muted small">TANGGAL PENDAFTARAN</label>
                                <p class="mb-0">
                                    <i class="fas fa-calendar mr-1 text-muted"></i>
                                    {{ $haki->tanggal_daftar->format('d F Y') }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- File Dokumen -->
                @if($haki->file_dokumen || $haki->file_sertifikat)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-file-download text-danger mr-2"></i>Dokumen
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($haki->file_dokumen)
                            <div class="col-md-6 mb-3">
                                <div class="document-card border rounded p-3 text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                    </div>
                                    <h6 class="mb-2">File Dokumen</h6>
                                    <a href="{{ Storage::url($haki->file_dokumen) }}"
                                       class="btn btn-outline-danger btn-sm" target="_blank">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($haki->file_sertifikat)
                            <div class="col-md-6 mb-3">
                                <div class="document-card border rounded p-3 text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-certificate fa-3x text-success"></i>
                                    </div>
                                    <h6 class="mb-2">File Sertifikat</h6>
                                    <a href="{{ Storage::url($haki->file_sertifikat) }}"
                                       class="btn btn-outline-success btn-sm" target="_blank">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Catatan -->
                @if($haki->catatan)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-sticky-note text-warning mr-2"></i>Catatan
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 text-muted">{{ $haki->catatan }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Info Cards -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info mr-2"></i>Informasi Pendaftaran
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($haki->nomor_pendaftaran)
                        <div class="info-item mb-3">
                            <label class="font-weight-bold text-muted small d-block">NOMOR PENDAFTARAN</label>
                            <span class="font-weight-bold">{{ $haki->nomor_pendaftaran }}</span>
                        </div>
                        @endif

                        @if($haki->nomor_publikasi)
                        <div class="info-item mb-3">
                            <label class="font-weight-bold text-muted small d-block">NOMOR PUBLIKASI</label>
                            <span class="font-weight-bold">{{ $haki->nomor_publikasi }}</span>
                        </div>
                        @endif

                        @if($haki->nomor_sertifikat)
                        <div class="info-item mb-3">
                            <label class="font-weight-bold text-muted small d-block">NOMOR SERTIFIKAT</label>
                            <span class="font-weight-bold">{{ $haki->nomor_sertifikat }}</span>
                        </div>
                        @endif

                        @if($haki->tanggal_publikasi)
                        <div class="info-item mb-3">
                            <label class="font-weight-bold text-muted small d-block">TANGGAL PUBLIKASI</label>
                            <span>{{ $haki->tanggal_publikasi->format('d F Y') }}</span>
                        </div>
                        @endif

                        @if($haki->tanggal_granted)
                        <div class="info-item mb-3">
                            <label class="font-weight-bold text-muted small d-block">TANGGAL GRANTED</label>
                            <span>{{ $haki->tanggal_granted->format('d F Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Masa Berlaku -->
                @if($haki->tanggal_berlaku_mulai || $haki->tanggal_berlaku_selesai)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-check mr-2"></i>Masa Berlaku
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($haki->tanggal_berlaku_mulai)
                        <div class="info-item mb-2">
                            <label class="font-weight-bold text-muted small d-block">BERLAKU MULAI</label>
                            <span>{{ $haki->tanggal_berlaku_mulai->format('d F Y') }}</span>
                        </div>
                        @endif

                        @if($haki->tanggal_berlaku_selesai)
                        <div class="info-item mb-2">
                            <label class="font-weight-bold text-muted small d-block">BERLAKU HINGGA</label>
                            <span>{{ $haki->tanggal_berlaku_selesai->format('d F Y') }}</span>
                        </div>
                        @endif

                        @if($haki->diperpanjang)
                        <div class="info-item">
                            <span class="badge badge-success">
                                <i class="fas fa-check mr-1"></i>Diperpanjang
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Share Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-share-alt mr-2"></i>Bagikan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($haki->judul) }}"
                               target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                    onclick="copyToClipboard('{{ request()->fullUrl() }}')"
                                    title="Salin link">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Related HAKI -->
                @if($relatedHaki && $relatedHaki->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-list mr-2"></i>HAKI Terkait
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedHaki as $related)
                        <div class="related-item mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <h6 class="mb-1">
                                @if($related->slug)
                                    <a href="{{ route('frontend.haki.show', $related->slug) }}" class="text-dark text-decoration-none">
                                        {{ Str::limit($related->judul, 50) }}
                                    </a>
                                @else
                                    {{ Str::limit($related->judul, 50) }}
                                @endif
                            </h6>
                            <small class="text-muted d-block mb-1">
                                <span class="badge badge-sm badge-outline-primary">{{ $related->getJenisHakiLabel() }}</span>
                            </small>
                            @if($related->tanggal_daftar)
                            <small class="text-muted">
                                <i class="fas fa-calendar mr-1"></i>{{ $related->tanggal_daftar->format('M Y') }}
                            </small>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('frontend.haki') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke Daftar HAKI
                    </a>
                    @if($nextHaki && $nextHaki->slug)
                        <a href="{{ route('frontend.haki.show', $nextHaki->slug) }}" class="btn btn-outline-primary">
                            HAKI Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.badge-lg {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.document-card {
    transition: all 0.3s ease;
}

.document-card:hover {
    background-color: #f8f9fa;
    border-color: #dee2e6 !important;
}

.info-item {
    border-left: 3px solid #007bff;
    padding-left: 1rem;
}

.related-item:hover h6 a {
    color: #007bff !important;
}

.badge-outline-primary {
    color: #007bff;
    border: 1px solid #007bff;
    background: transparent;
}

.badge-sm {
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
}

@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-wrap: wrap;
    }

    .d-flex.gap-2 > * {
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.classList.remove('btn-outline-secondary');
        btn.classList.add('btn-success');

        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-secondary');
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    });
}
</script>
@endpush
