@extends('frontend.layouts.app')

@section('content')
    {{-- Hero Section dengan Carousel --}}
    @if($images->count())
    <section class="hero-section mb-5">
        <div id="contentCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($images as $index => $image)
                    <button type="button" data-bs-target="#contentCarousel" data-bs-slide-to="{{ $index }}" 
                            class="{{ $index == 0 ? 'active' : '' }}" 
                            aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner rounded-3 shadow">
                @foreach ($images as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ $image->image_url }}" class="d-block w-100" 
                             alt="Gambar {{ $index + 1 }}" 
                             style="height: 400px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="bg-dark bg-opacity-50 rounded p-3">
                                <h5 class="fw-bold">LPPM IDE LPKIA</h5>
                                <p>Lembaga Penelitian dan Pengabdian Kepada Masyarakat</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#contentCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#contentCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        </div>
    </section>
    @endif

    {{-- Main Content --}}
    <div class="container">
        {{-- Welcome Content Section --}}
        <section class="welcome-section mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-4">
                        <h2 class="display-6 fw-bold text-primary mb-3">
                            <i class="fas fa-university me-2"></i>
                            Selamat Datang di LPPM IDE LPKIA
                        </h2>
                        <div class="border-bottom border-primary w-25 mx-auto mb-4"></div>
                    </div>
                    
                    <div class="bg-light rounded-3 p-4 shadow-sm">
                        <div class="content-body">
                            {!! $content->body ?? '<p class="lead text-center text-muted">Konten belum tersedia.</p>' !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Leadership Section --}}
        <section class="leadership-section">
            <div class="text-center mb-5">
                <h3 class="display-7 fw-bold text-secondary mb-3">
                    <i class="fas fa-users me-2"></i>
                    Pimpinan LPPM
                </h3>
                <div class="border-bottom border-secondary w-25 mx-auto mb-4"></div>
                <p class="lead text-muted">Tim kepemimpinan yang berpengalaman dan berdedikasi</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                {{-- Ketua LPPM --}}
                <div class="col-lg-5 col-md-6">
                    <div class="card border-0 shadow-lg h-100 hover-card">
                        <div class="position-relative">
                            <img src="{{ asset('images/muhtarudin.jpg') }}" 
                                 class="card-img-top" 
                                 alt="Drs. Muhtarudin, M.M."
                                 style="height: 300px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary fs-6">Ketua</span>
                            </div>
                        </div>
                        <div class="card-body text-center p-4">
                            <h5 class="card-title fw-bold text-primary mb-2">Drs. Muhtarudin, M.M.</h5>
                            <p class="card-text text-secondary mb-2 fw-semibold">Ketua LPPM IDE LPKIA Bandung</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="badge bg-light text-dark px-3 py-2">
                                    <i class="fas fa-id-card me-1"></i>
                                    NIDN: 0413
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sekretaris LPPM --}}
                <div class="col-lg-5 col-md-6">
                    <div class="card border-0 shadow-lg h-100 hover-card">
                        <div class="position-relative">
                            <img src="{{ asset('images/nengsusi.jpg') }}" 
                                 class="card-img-top" 
                                 alt="Dr. Neng Susi"
                                 style="height: 300px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-success fs-6">Sekretaris</span>
                            </div>
                        </div>
                        <div class="card-body text-center p-4">
                            <h5 class="card-title fw-bold text-primary mb-2">Dr. Neng Susi S.S., S.Kom., M.M.</h5>
                            <p class="card-text text-secondary mb-2 fw-semibold">Sekretaris LPPM IDE LPKIA Bandung</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="badge bg-light text-dark px-3 py-2">
                                    <i class="fas fa-id-card me-1"></i>
                                    NIDN: 0405028803
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- HAKI Section --}}
    @if($hakis->count() > 0)
    <section class="haki-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-primary mb-3">
                    <i class="fas fa-copyright me-2"></i>
                    Hak Kekayaan Intelektual (HAKI)
                </h2>
                <p class="lead text-secondary">
                    Inovasi dan kreativitas yang telah terlindungi hak kekayaan intelektualnya
                </p>
            </div>

            {{-- HAKI Statistics --}}
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body">
                            <div class="text-primary mb-2">
                                <i class="fas fa-lightbulb fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-primary">{{ \App\Models\Haki::count() }}</h4>
                            <p class="text-muted mb-0">Total HAKI</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body">
                            <div class="text-success mb-2">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-success">{{ \App\Models\Haki::where('status', 'granted')->count() }}</h4>
                            <p class="text-muted mb-0">Granted</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body">
                            <div class="text-info mb-2">
                                <i class="fas fa-file-alt fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-info">{{ \App\Models\Haki::where('jenis_haki', 'paten')->count() }}</h4>
                            <p class="text-muted mb-0">Paten</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body">
                            <div class="text-warning mb-2">
                                <i class="fas fa-certificate fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-warning">{{ \App\Models\Haki::where('jenis_haki', 'hak_cipta')->count() }}</h4>
                            <p class="text-muted mb-0">Hak Cipta</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HAKI Cards --}}
            <div class="row g-4">
                @foreach($hakis as $haki)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-header bg-gradient-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-light text-primary">
                                    {{ \App\Models\Haki::getJenisHakiOptions()[$haki->jenis_haki] }}
                                </span>
                                <span class="badge bg-{{ $haki->getStatusBadgeClass() === 'bg-success' ? 'success' : ($haki->getStatusBadgeClass() === 'bg-warning' ? 'warning' : 'info') }}">
                                    {{ \App\Models\Haki::getStatusOptions()[$haki->status] }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary mb-3">
                                {{ Str::limit($haki->judul, 60) }}
                            </h5>
                            
                            @if($haki->deskripsi)
                            <p class="card-text text-secondary mb-3">
                                {{ Str::limit($haki->deskripsi, 100) }}
                            </p>
                            @endif

                            <div class="mb-3">
                                <small class="text-muted d-block">
                                    <i class="fas fa-users me-1"></i>
                                    <strong>Inventor:</strong> 
                                    {{ is_array($haki->inventor) ? implode(', ', array_slice($haki->inventor, 0, 2)) : $haki->inventor }}
                                    @if(is_array($haki->inventor) && count($haki->inventor) > 2)
                                        <span class="text-primary">+{{ count($haki->inventor) - 2 }} lainnya</span>
                                    @endif
                                </small>
                            </div>

                            @if($haki->nomor_pendaftaran)
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-file-contract me-1"></i>
                                    <strong>No. Pendaftaran:</strong> {{ $haki->nomor_pendaftaran }}
                                </small>
                            </div>
                            @endif

                            @if($haki->tanggal_daftar)
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <strong>Tgl. Daftar:</strong> {{ $haki->tanggal_daftar->format('d M Y') }}
                                </small>
                            </div>
                            @endif

                            @if($haki->bidang_teknologi)
                            <div class="mt-3">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-cog me-1"></i>{{ $haki->bidang_teknologi }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- View More Button --}}
            <div class="text-center mt-5">
                <a href="{{ route('frontend.haki') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-eye me-2"></i>Lihat Semua HAKI
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Custom Styles --}}
    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .hero-section {
            margin-top: -1.5rem;
        }
        .content-body {
            line-height: 1.8;
        }
        .display-7 {
            font-size: 2rem;
        }
        @media (max-width: 768px) {
            .display-6 {
                font-size: 1.8rem;
            }
            .display-7 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
