@extends('layouts.app')

@section('title', 'HAKI (Hak Kekayaan Intelektual)')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-gradient-primary py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="text-white mb-3">HAKI</h1>
                <h2 class="text-white h3 mb-4">Hak Kekayaan Intelektual</h2>
                <p class="text-white-50 lead mb-4">
                    Kumpulan karya intelektual yang telah didaftarkan dan dilindungi hak kekayaan intelektualnya, 
                    meliputi paten, merek dagang, hak cipta, dan desain industri.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-lightbulb mr-1"></i>Paten
                    </div>
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-copyright mr-1"></i>Hak Cipta
                    </div>
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-trademark mr-1"></i>Merek
                    </div>
                    <div class="badge badge-light badge-pill px-3 py-2 mr-2 mb-2">
                        <i class="fas fa-drafting-compass mr-1"></i>Desain Industri
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="hero-icon">
                    <i class="fas fa-shield-alt text-white" style="font-size: 8rem; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-primary mb-3">
                            <i class="fas fa-lightbulb fa-2x"></i>
                        </div>
                        <h3 class="h4 text-primary mb-1">{{ $statistics['paten'] }}</h3>
                        <p class="text-muted mb-0">Paten</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-success mb-3">
                            <i class="fas fa-copyright fa-2x"></i>
                        </div>
                        <h3 class="h4 text-success mb-1">{{ $statistics['hak_cipta'] }}</h3>
                        <p class="text-muted mb-0">Hak Cipta</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-warning mb-3">
                            <i class="fas fa-trademark fa-2x"></i>
                        </div>
                        <h3 class="h4 text-warning mb-1">{{ $statistics['merek'] }}</h3>
                        <p class="text-muted mb-0">Merek</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-info mb-3">
                            <i class="fas fa-drafting-compass fa-2x"></i>
                        </div>
                        <h3 class="h4 text-info mb-1">{{ $statistics['desain_industri'] }}</h3>
                        <p class="text-muted mb-0">Desain Industri</p>
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
                <form method="GET" action="{{ route('haki.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Pencarian</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" id="search" class="form-control" 
                                   placeholder="Cari judul, inventor, atau deskripsi..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="jenis_haki" class="form-label">Jenis HAKI</label>
                        <select name="jenis_haki" id="jenis_haki" class="form-control">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisHakiOptions as $key => $label)
                                <option value="{{ $key }}" {{ request('jenis_haki') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
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

<!-- HAKI List Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($hakiList as $haki)
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100 haki-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="haki-type">
                                <span class="badge badge-primary badge-pill">
                                    @switch($haki->jenis_haki)
                                        @case('paten')
                                            <i class="fas fa-lightbulb mr-1"></i>
                                            @break
                                        @case('hak_cipta')
                                            <i class="fas fa-copyright mr-1"></i>
                                            @break
                                        @case('merek')
                                            <i class="fas fa-trademark mr-1"></i>
                                            @break
                                        @case('desain_industri')
                                            <i class="fas fa-drafting-compass mr-1"></i>
                                            @break
                                        @default
                                            <i class="fas fa-file mr-1"></i>
                                    @endswitch
                                    {{ $haki->getJenisHakiLabel() }}
                                </span>
                            </div>
                            <span class="badge {{ $haki->getStatusBadgeClass() }}">
                                {{ $haki->getStatusLabel() }}
                            </span>
                        </div>

                        <h5 class="card-title mb-3">
                            <a href="{{ route('haki.show', $haki->slug) }}" class="text-dark text-decoration-none">
                                {{ $haki->judul }}
                            </a>
                        </h5>

                        @if($haki->deskripsi)
                        <p class="card-text text-muted mb-3">
                            {{ Str::limit($haki->deskripsi, 120) }}
                        </p>
                        @endif

                        <!-- Inventor Section -->
                        @if($haki->inventor && count($haki->inventor) > 0)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">
                                <i class="fas fa-users mr-1"></i>Inventor:
                            </small>
                            <div class="inventor-list">
                                @foreach(array_slice($haki->inventor, 0, 2) as $inventor)
                                    <span class="badge badge-outline-secondary mr-1">{{ $inventor }}</span>
                                @endforeach
                                @if(count($haki->inventor) > 2)
                                    <span class="badge badge-light">+{{ count($haki->inventor) - 2 }} lainnya</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Info Details -->
                        <div class="row text-muted small mb-3">
                            @if($haki->nomor_pendaftaran)
                            <div class="col-6">
                                <i class="fas fa-hashtag mr-1"></i>
                                {{ $haki->nomor_pendaftaran }}
                            </div>
                            @endif
                            @if($haki->tanggal_daftar)
                            <div class="col-6">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $haki->tanggal_daftar->format('M Y') }}
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('haki.show', $haki->slug) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye mr-1"></i>Lihat Detail
                            </a>
                            @if($haki->bidang_teknologi)
                            <small class="text-muted">
                                <i class="fas fa-tag mr-1"></i>{{ $haki->bidang_teknologi }}
                            </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Tidak ada data HAKI ditemukan</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['search', 'jenis_haki', 'status']))
                            Coba ubah kriteria pencarian atau filter Anda.
                        @else
                            Belum ada data HAKI yang tersedia saat ini.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'jenis_haki', 'status']))
                    <a href="{{ route('haki.index') }}" class="btn btn-primary">
                        <i class="fas fa-refresh mr-1"></i>Reset Filter
                    </a>
                    @endif
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($hakiList->hasPages())
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $hakiList->appends(request()->query())->links() }}
                </div>
            </div>
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

.haki-card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.haki-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.badge-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background: transparent;
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

.inventor-list .badge {
    font-size: 0.75rem;
    margin-bottom: 0.25rem;
}

@media (max-width: 768px) {
    .hero-section {
        text-align: center;
    }
    
    .haki-card {
        margin-bottom: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto submit form when filter changes
    const filterSelects = document.querySelectorAll('#jenis_haki, #status');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>
@endpush