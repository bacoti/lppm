@extends('frontend.layouts.app')

@section('title', $jurnal->judul . ' - LPPM')

@push('styles')
<style>
    .jurnal-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
    }

    .cover-image {
        max-width: 300px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .jurnal-meta-item {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    .jurnal-meta-item h6 {
        color: rgba(255,255,255,0.8);
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .jurnal-meta-item p {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .content-section {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .download-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .download-btn:hover {
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .author-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 25px;
        padding: 8px 15px;
        margin: 3px;
        display: inline-block;
        font-size: 0.9rem;
    }

    .keyword-tag {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 15px;
        padding: 5px 12px;
        margin: 3px;
        display: inline-block;
        font-size: 0.85rem;
        color: #495057;
    }

    .featured-indicator {
        position: absolute;
        top: -10px;
        right: 20px;
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .section-title {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #667eea;
        display: inline-block;
    }

    .external-link {
        color: #667eea;
        text-decoration: none;
    }

    .external-link:hover {
        color: #764ba2;
        text-decoration: none;
    }

    .related-jurnal-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .related-jurnal-card:hover {
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        .jurnal-hero {
            padding: 2rem 0;
        }

        .cover-image {
            max-width: 200px;
            margin-bottom: 2rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="jurnal-hero position-relative">
    @if($jurnal->is_featured)
        <div class="featured-indicator">
            <i class="fas fa-star mr-1"></i>Featured
        </div>
    @endif

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                @if($jurnal->cover_image)
                    <img src="{{ Storage::url($jurnal->cover_image) }}"
                         alt="Cover {{ $jurnal->judul }}"
                         class="cover-image img-fluid">
                @else
                    <div class="cover-image mx-auto d-flex align-items-center justify-content-center bg-white text-primary">
                        <i class="fas fa-book fa-4x"></i>
                    </div>
                @endif
            </div>

            <div class="col-lg-8">
                <h1 class="display-5 font-weight-bold mb-4">{{ $jurnal->judul }}</h1>

                <div class="row">
                    <div class="col-md-6">
                        <div class="jurnal-meta-item">
                            <h6>Nama Jurnal</h6>
                            <p>{{ $jurnal->nama_jurnal }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="jurnal-meta-item">
                            <h6>Penerbit</h6>
                            <p>{{ $jurnal->penerbit ?: 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="jurnal-meta-item">
                            <h6>Tahun</h6>
                            <p>{{ $jurnal->tahun }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="jurnal-meta-item">
                            <h6>Jenis</h6>
                            <p>{{ \App\Models\Jurnal::getJenisJurnalOptions()[$jurnal->jenis_jurnal] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Publication Details -->
            <div class="content-section">
                <h2 class="section-title">Detail Publikasi</h2>

                <div class="row">
                    @if($jurnal->volume)
                        <div class="col-md-3 mb-3">
                            <h6 class="text-muted mb-1">Volume</h6>
                            <p class="font-weight-semibold">{{ $jurnal->volume }}</p>
                        </div>
                    @endif

                    @if($jurnal->nomor)
                        <div class="col-md-3 mb-3">
                            <h6 class="text-muted mb-1">Nomor</h6>
                            <p class="font-weight-semibold">{{ $jurnal->nomor }}</p>
                        </div>
                    @endif

                    @if($jurnal->halaman)
                        <div class="col-md-3 mb-3">
                            <h6 class="text-muted mb-1">Halaman</h6>
                            <p class="font-weight-semibold">{{ $jurnal->halaman }}</p>
                        </div>
                    @endif

                    @if($jurnal->issn)
                        <div class="col-md-3 mb-3">
                            <h6 class="text-muted mb-1">ISSN</h6>
                            <p class="font-weight-semibold">{{ $jurnal->issn }}</p>
                        </div>
                    @endif
                </div>

                @if($jurnal->doi || $jurnal->url_jurnal)
                    <div class="row mt-3">
                        @if($jurnal->doi)
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-1">DOI</h6>
                                <p>
                                    <a href="https://doi.org/{{ $jurnal->doi }}"
                                       target="_blank" class="external-link">
                                        {{ $jurnal->doi }}
                                        <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </p>
                            </div>
                        @endif

                        @if($jurnal->url_jurnal)
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-1">URL</h6>
                                <p>
                                    <a href="{{ $jurnal->url_jurnal }}"
                                       target="_blank" class="external-link">
                                        Lihat Online
                                        <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Authors -->
            @if($jurnal->penulis && count($jurnal->penulis) > 0)
                <div class="content-section">
                    <h2 class="section-title">Penulis</h2>
                    <div class="authors-list">
                        @foreach($jurnal->penulis as $index => $penulis)
                            <span class="author-badge">
                                {{ $index + 1 }}. {{ $penulis }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Abstract -->
            @if($jurnal->abstrak)
                <div class="content-section">
                    <h2 class="section-title">Abstrak</h2>
                    <p class="text-justify lead">{{ $jurnal->abstrak }}</p>
                </div>
            @endif

            <!-- Keywords -->
            @if($jurnal->kata_kunci && count($jurnal->kata_kunci) > 0)
                <div class="content-section">
                    <h2 class="section-title">Kata Kunci</h2>
                    <div class="keywords-list">
                        @foreach($jurnal->kata_kunci as $keyword)
                            <span class="keyword-tag">{{ $keyword }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Download Section -->
            @if($jurnal->file_pdf)
                <div class="content-section text-center">
                    <h4 class="mb-3">Download Jurnal</h4>
                    <a href="{{ route('jurnal.download', $jurnal->slug) }}"
                       class="download-btn">
                        <i class="fas fa-download mr-2"></i>Download PDF
                    </a>
                    <p class="text-muted mt-2 mb-0">
                        <small>
                            <i class="fas fa-file-pdf mr-1"></i>
                            {{ basename($jurnal->file_pdf) }}
                        </small>
                    </p>
                </div>
            @endif

            <!-- Statistics -->
            <div class="stats-card">
                <div class="row">
                    <div class="col-6">
                        <div class="stats-number">{{ number_format($jurnal->views) }}</div>
                        <div>Dilihat</div>
                    </div>
                    <div class="col-6">
                        <div class="stats-number">{{ number_format($jurnal->downloads) }}</div>
                        <div>Download</div>
                    </div>
                </div>
            </div>

            <!-- Metadata -->
            <div class="content-section">
                <h5 class="mb-3">Informasi Tambahan</h5>
                <div class="mb-2">
                    <h6 class="text-muted mb-1">Status</h6>
                    <span class="badge badge-primary">
                        {{ \App\Models\Jurnal::getStatusOptions()[$jurnal->status] }}
                    </span>
                </div>

                @if($jurnal->akreditasi)
                    <div class="mb-2">
                        <h6 class="text-muted mb-1">Akreditasi</h6>
                        <span class="badge badge-success">
                            {{ \App\Models\Jurnal::getAkreditasiOptions()[$jurnal->akreditasi] }}
                        </span>
                    </div>
                @endif

                <div class="mb-2">
                    <h6 class="text-muted mb-1">Dipublikasikan</h6>
                    <p class="mb-0">{{ $jurnal->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Related Journals -->
            @if($relatedJurnals->count() > 0)
                <div class="content-section">
                    <h5 class="mb-3">Jurnal Terkait</h5>
                    @foreach($relatedJurnals as $related)
                        <div class="card related-jurnal-card mb-3">
                            <div class="card-body p-3">
                                <h6 class="card-title mb-2">
                                    <a href="{{ route('jurnal.show', $related->slug) }}"
                                       class="text-decoration-none">
                                        {{ Str::limit($related->judul, 50) }}
                                    </a>
                                </h6>
                                <p class="card-text small text-muted mb-2">
                                    {{ $related->nama_jurnal }} • {{ $related->tahun }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-primary badge-sm">
                                        {{ \App\Models\Jurnal::getJenisJurnalOptions()[$related->jenis_jurnal] }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="fas fa-eye"></i> {{ $related->views }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="{{ route('jurnal.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Jurnal
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Track view
    $.ajax({
        url: '{{ route("jurnal.track-view", $jurnal->slug) }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        }
    });
});
</script>
@endpush
