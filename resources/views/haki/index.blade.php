@extends('frontend.layouts.app')

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
                <form method="GET" action="{{ route('frontend.haki') }}" class="row g-3">
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
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="mb-0"><i class="fas fa-shield-alt mr-2"></i>Daftar HAKI</h4>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge badge-light">{{ $hakiList->total() }} HAKI tersedia</span>
                        @if($hakiList->hasPages())
                        <span class="badge badge-light">Halaman {{ $hakiList->currentPage() }} dari {{ $hakiList->lastPage() }}</span>
                        @endif
                        @if(request('jenis_haki'))
                        <span class="badge badge-info">{{ $jenisHakiOptions[request('jenis_haki')] ?? 'Filter Aktif' }}</span>
                        @endif
                        @if(request('status'))
                        <span class="badge badge-warning">{{ $statusOptions[request('status')] ?? 'Status Filter' }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @forelse($hakiList as $haki)
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="25%">Judul HAKI</th>
                                <th width="15%">Jenis HAKI</th>
                                <th width="20%">Inventor</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tanggal</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $hakiList->firstItem() + $loop->index }}</td>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <strong>
                                                @if($haki->slug)
                                                    <a href="{{ route('frontend.haki.show', $haki->slug) }}" class="text-decoration-none text-dark">
                                                        {{ $haki->judul }}
                                                    </a>
                                                @else
                                                    <span class="text-dark">{{ $haki->judul }}</span>
                                                @endif
                                            </strong>
                                            @if($haki->deskripsi)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($haki->deskripsi, 60) }}</small>
                                            @endif
                                            @if($haki->nomor_pendaftaran)
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-hashtag mr-1"></i>{{ $haki->nomor_pendaftaran }}
                                            </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
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
                                    @if($haki->bidang_teknologi)
                                    <br>
                                    <small class="text-muted">{{ $haki->bidang_teknologi }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($haki->inventor && count($haki->inventor) > 0)
                                        @foreach(array_slice($haki->inventor, 0, 2) as $inventor)
                                            <span class="badge badge-outline-secondary mr-1 mb-1">{{ $inventor }}</span>
                                        @endforeach
                                        @if(count($haki->inventor) > 2)
                                            <br><small class="text-muted">+{{ count($haki->inventor) - 2 }} lainnya</small>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $haki->getStatusBadgeClass() }}">
                                        {{ $haki->getStatusLabel() }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($haki->tanggal_daftar)
                                        {{ $haki->tanggal_daftar->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($haki->slug)
                                        <a href="{{ route('frontend.haki.show', $haki->slug) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fas fa-eye"></i> Tidak tersedia
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Tidak ada data HAKI ditemukan</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['search', 'jenis_haki', 'status']))
                            Coba ubah kriteria pencarian atau filter Anda untuk menemukan data HAKI yang diinginkan.
                        @else
                            Belum ada data HAKI yang dipublikasikan saat ini.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'jenis_haki', 'status']))
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('frontend.haki') }}" class="btn btn-primary">
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
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($hakiList->hasPages())
        <div class="row mt-4">
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

.table th {
    vertical-align: middle;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
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
