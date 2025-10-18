@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Detail Dosen</h1>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- NIDN / NIP --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">NIDN / NIP</span>
                            <span class="fs-6 text-muted">{{ $dosen->nidn_nip }}</span>
                        </div>
                    </div>

                    {{-- Nama Dosen --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Nama Lengkap</span>
                            <span class="fs-6 text-muted">{{ $dosen->nama_lengkap }}</span>
                        </div>
                    </div>

                    {{-- Foto Dosen --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Photo</span>
                            @if($dosen->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $dosen->photo) }}"
                                         alt="Foto {{ $dosen->nama_lengkap }}"
                                         class="img-thumbnail"
                                         width="150">
                                </div>
                            @else
                                <div class="mt-2 text-muted">Belum ada foto</div>
                            @endif
                        </div>
                    </div>

                    {{-- Gelar Akademik --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Gelar Akademik</span>
                            <span class="fs-6 text-muted">{{ $dosen->gelar_akademik }}</span>
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Tanggal Lahir</span>
                            <span class="fs-6 text-muted">{{ $dosen->tanggal_lahir }}</span>
                        </div>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Tempat Lahir</span>
                            <span class="fs-6 text-muted">{{ $dosen->tempat_lahir }}</span>
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Jenis Kelamin</span>
                            <span class="fs-6 text-muted">
                                {{ $dosen->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Alamat</span>
                            <span class="fs-6 text-muted">{{ $dosen->alamat }}</span>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Email</span>
                            <span class="fs-6 text-muted">{{ $dosen->email ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- No.Hp --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">No.Hp</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Riwayat Pendidikan --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Riwayat Pendidikan</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Jenjang Pendidikan Terakhir --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Jenjang Pendidikan Terakhir</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Bidang Keilmuan --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Bidang Keilmuan</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Tahun Lulus --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Tahun Lulus</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Jabatan / Status --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Jabatan / Status</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Jabatan Fungsional --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Jabatan Fungsional</span>
                            <span class="fs-6 text-muted">{{ $dosen->academic_grade ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Pangkat / Golongan --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Pangkat / Golongan</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Status Kepegawaian --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Status Kepegawaian</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Prodi Homebase --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Prodi Homebase</span>
                            <span class="fs-6 text-muted">{{ $dosen->department ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Aktivitas Akademik --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Aktivitas Akademik</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Mata Kuliah Yang Diampu --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Mata Kuliah Yang Diampu</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Bidang Penelitian --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Bidang Penelitian</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Bidang Pengabdian --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Bidang Pengabdian</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>

                    {{-- Nomor KTP / KK --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Nomor KTP / KK</span>
                            <span class="fs-6 text-muted">{{ $dosen->id_card ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Nomor Rekening --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold text-bg small">Nomor Rekening</span>
                            <span class="fs-6 text-muted">Not implemented yet</span>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admin.dosens.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
