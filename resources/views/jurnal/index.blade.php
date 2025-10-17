@extends('frontend.layouts.app')

@section('title', 'Jurnal Lain - LPPM')

@push('styles')
<style>
    .jurnal-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .jurnal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .jurnal-cover {
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .jurnal-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .jurnal-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        line-height: 1.4;
    }

    .jurnal-meta {
        font-size: 0.85rem;
        color: #718096;
    }

    .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .filter-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .search-box {
        border-radius: 25px;
        border: none;
        padding: 12px 20px;
        font-size: 1rem;
    }

    .btn-search {
        border-radius: 25px;
        padding: 12px 25px;
        font-weight: 600;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .pagination {
        justify-content: center;
    }

    .page-link {
        color: #667eea;
        border: 1px solid #e2e8f0;
        margin: 0 2px;
        border-radius: 8px;
    }

    .page-link:hover {
        color: #764ba2;
        background-color: #f7fafc;
    }

    .page-item.active .page-link {
        background-color: #667eea;
        border-color: #667eea;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 font-weight-bold mb-3">Jurnal Lain</h1>
                <p class="lead mb-4">Koleksi publikasi ilmiah dan artikel jurnal terkini dari berbagai bidang penelitian</p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="stats-card">
                    <div class="stats-number">{{ $totalJurnals }}</div>
                    <div>Total Jurnal</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('jurnal.index') }}">
            <div class="row align-items-end">
                <div class="col-lg-4 mb-3">
                    <label for="search" class="form-label font-weight-semibold">Cari Jurnal</label>
                    <input type="text" name="search" id="search" class="form-control search-box"
                           placeholder="Judul, penulis, jurnal..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-lg-2 mb-3">
                    <label for="jenis_jurnal" class="form-label font-weight-semibold">Jenis</label>
                    <select name="jenis_jurnal" id="jenis_jurnal" class="form-control search-box">
                        <option value="">Semua Jenis</option>
                        @foreach(\App\Models\Jurnal::getJenisJurnalOptions() as $key => $label)
                            <option value="{{ $key }}" {{ request('jenis_jurnal') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <label for="akreditasi" class="form-label font-weight-semibold">Akreditasi</label>
                    <select name="akreditasi" id="akreditasi" class="form-control search-box">
                        <option value="">Semua Akreditasi</option>
                        @foreach(\App\Models\Jurnal::getAkreditasiOptions() as $key => $label)
                            <option value="{{ $key }}" {{ request('akreditasi') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <label for="tahun" class="form-label font-weight-semibold">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control search-box">
                        <option value="">Semua Tahun</option>
                        @for($year = date('Y'); $year >= 2000; $year--)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-light btn-search mr-2">
                            <i class="fas fa-search mr-1"></i>Cari
                        </button>
                        <a href="{{ route('jurnal.index') }}" class="btn btn-outline-light btn-search">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Info -->
    @if(request()->hasAny(['search', 'jenis_jurnal', 'akreditasi', 'tahun']))
        <div class="alert alert-info">
            <i class="fas fa-info-circle mr-2"></i>
            Menampilkan {{ $jurnals->total() }} hasil untuk
            @if(request('search'))
                pencarian "<strong>{{ request('search') }}</strong>"
            @endif
            @if(request('jenis_jurnal'))
                jenis "<strong>{{ \App\Models\Jurnal::getJenisJurnalOptions()[request('jenis_jurnal')] }}</strong>"
            @endif
            @if(request('akreditasi'))
                akreditasi "<strong>{{ \App\Models\Jurnal::getAkreditasiOptions()[request('akreditasi')] }}</strong>"
            @endif
            @if(request('tahun'))
                tahun "<strong>{{ request('tahun') }}</strong>"
            @endif
        </div>
    @endif

    <!-- Featured Journals -->
    @if($featuredJurnals->count() > 0 && !request()->hasAny(['search', 'jenis_jurnal', 'akreditasi', 'tahun']))
        <div class="section mb-5">
            <h2 class="section-title mb-4">
                <i class="fas fa-star text-warning mr-2"></i>Jurnal Unggulan
            </h2>
            <div class="row">
                @foreach($featuredJurnals as $jurnal)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card jurnal-card border-0 shadow-sm position-relative">
                            <div class="featured-badge">
                                <i class="fas fa-star mr-1"></i>Featured
                            </div>

                            <div class="jurnal-cover">
                                @if($jurnal->cover_image)
                                    <img src="{{ Storage::url($jurnal->cover_image) }}" alt="Cover {{ $jurnal->judul }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-white">
                                        <i class="fas fa-book fa-3x"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="jurnal-title mb-2">{{ Str::limit($jurnal->judul, 80) }}</h5>

                                <div class="jurnal-meta mb-3">
                                    <div class="mb-1">
                                        <i class="fas fa-book-open mr-1"></i>{{ $jurnal->nama_jurnal }}
                                    </div>
                                    @if($jurnal->penulis && count($jurnal->penulis) > 0)
                                        <div class="mb-1">
                                            <i class="fas fa-user mr-1"></i>{{ implode(', ', array_slice($jurnal->penulis, 0, 2)) }}{{ count($jurnal->penulis) > 2 ? ', et al.' : '' }}
                                        </div>
                                    @endif
                                    <div class="mb-1">
                                        <i class="fas fa-calendar mr-1"></i>{{ $jurnal->tahun }}
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-primary badge-pill">{{ \App\Models\Jurnal::getJenisJurnalOptions()[$jurnal->jenis_jurnal] }}</span>
                                        @if($jurnal->akreditasi)
                                            <span class="badge badge-success badge-pill">{{ \App\Models\Jurnal::getAkreditasiOptions()[$jurnal->akreditasi] }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('jurnal.show', $jurnal->slug) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- All Journals -->
    <div class="section">
        <h2 class="section-title mb-4">
            <i class="fas fa-list mr-2"></i>Semua Jurnal
        </h2>

        @if($jurnals->count() > 0)
            <div class="row">
                @foreach($jurnals as $jurnal)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card jurnal-card border-0 shadow-sm position-relative">
                            @if($jurnal->is_featured)
                                <div class="featured-badge">
                                    <i class="fas fa-star mr-1"></i>Featured
                                </div>
                            @endif

                            <div class="jurnal-cover">
                                @if($jurnal->cover_image)
                                    <img src="{{ Storage::url($jurnal->cover_image) }}" alt="Cover {{ $jurnal->judul }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-white">
                                        <i class="fas fa-book fa-3x"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="jurnal-title mb-2">{{ Str::limit($jurnal->judul, 80) }}</h5>

                                <div class="jurnal-meta mb-3">
                                    <div class="mb-1">
                                        <i class="fas fa-book-open mr-1"></i>{{ $jurnal->nama_jurnal }}
                                    </div>
                                    @if($jurnal->penulis && count($jurnal->penulis) > 0)
                                        <div class="mb-1">
                                            <i class="fas fa-user mr-1"></i>{{ implode(', ', array_slice($jurnal->penulis, 0, 2)) }}{{ count($jurnal->penulis) > 2 ? ', et al.' : '' }}
                                        </div>
                                    @endif
                                    <div class="mb-1">
                                        <i class="fas fa-calendar mr-1"></i>{{ $jurnal->tahun }}
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-primary badge-pill">{{ \App\Models\Jurnal::getJenisJurnalOptions()[$jurnal->jenis_jurnal] }}</span>
                                        @if($jurnal->akreditasi)
                                            <span class="badge badge-success badge-pill">{{ \App\Models\Jurnal::getAkreditasiOptions()[$jurnal->akreditasi] }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('jurnal.show', $jurnal->slug) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($jurnals->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $jurnals->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Tidak ada jurnal ditemukan</h4>
                <p class="text-muted">Coba ubah kriteria pencarian Anda</p>
                <a href="{{ route('jurnal.index') }}" class="btn btn-primary">
                    <i class="fas fa-redo mr-1"></i>Reset Pencarian
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto submit on filter change
    $('#jenis_jurnal, #akreditasi, #tahun').change(function() {
        $(this).closest('form').submit();
    });

    // Search on enter
    $('#search').keypress(function(e) {
        if (e.which == 13) {
            $(this).closest('form').submit();
        }
    });
});
</script>
@endpush
