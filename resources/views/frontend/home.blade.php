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
