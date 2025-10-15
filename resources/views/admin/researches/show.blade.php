@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Detail Penelitian</h1>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Judul Penelitian --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Judul Penelitian</span>
                            <span class="fs-6 text-muted">{{ $research->judul ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Bidang --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Bidang</span>
                            <span class="fs-6 text-muted">{{ $research->bidang ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Tahun --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Tahun</span>
                            <span class="fs-6 text-muted">{{ $research->tahun ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Sumber Dana --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Sumber Dana</span>
                            <span class="fs-6 text-muted">{{ $research->sumber_dana ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Jumlah Dana --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Jumlah Dana</span>
                            <span class="fs-6 text-muted">
                                {{ $research->jumlah_dana ? 'Rp ' . number_format($research->jumlah_dana, 0, ',', '.') : '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Abstrak --}}
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Abstrak</span>
                            <span class="fs-6 text-muted">{{ $research->abstrak ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Luaran --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Luaran</span>
                            <span class="fs-6 text-muted">{{ $research->luaran ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- File Laporan --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">File Laporan</span>
                            @if($research->file_laporan)
                                <a href="{{ asset('storage/' . $research->file_laporan) }}"
                                   target="_blank" class="mt-2 btn btn-sm btn-outline-primary">
                                    Lihat Laporan
                                </a>
                            @else
                                <span class="fs-6 text-muted mt-2">Belum ada file laporan</span>
                            @endif
                        </div>
                    </div>

                    {{-- Dosen Peneliti --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold small text-secondary">Dosen Peneliti</span>
                            <span class="fs-6 text-muted">{{ $research->dosen->nama_lengkap ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admin.researches.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
