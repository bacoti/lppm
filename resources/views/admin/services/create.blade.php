@extends('admin.layouts.admin')

@section('title', 'Tambah Pengabdian Masyarakat')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Pengabdian Masyarakat</h4>
                </div>

                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Informasi Dasar -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-8">
                                <label for="judul" class="form-label">Judul Pengabdian <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                       id="judul" name="judul" value="{{ old('judul') }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="dosen_id" class="form-label">Dosen Penanggung Jawab</label>
                                <select class="form-select @error('dosen_id') is-invalid @enderror" id="dosen_id" name="dosen_id">
                                    <option value="">Pilih Dosen</option>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dosen_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="bidang" class="form-label">Bidang Pengabdian</label>
                                <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                                       id="bidang" name="bidang" value="{{ old('bidang') }}"
                                       placeholder="Contoh: Teknologi Informasi, Pendidikan, dll">
                                @error('bidang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jenis_pengabdian" class="form-label">Jenis Pengabdian</label>
                                <select class="form-select @error('jenis_pengabdian') is-invalid @enderror"
                                        id="jenis_pengabdian" name="jenis_pengabdian">
                                    <option value="">Pilih Jenis Pengabdian</option>
                                    @foreach($jenisOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('jenis_pengabdian') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_pengabdian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi Pengabdian</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          id="deskripsi" name="deskripsi" rows="4"
                                          placeholder="Jelaskan secara detail tentang pengabdian masyarakat yang akan dilakukan...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Leader Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-user-tie me-2"></i>Informasi Ketua
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nidn_leader" class="form-label">NIDN Ketua</label>
                                <input type="text" class="form-control @error('nidn_leader') is-invalid @enderror"
                                       id="nidn_leader" name="nidn_leader" value="{{ old('nidn_leader') }}"
                                       placeholder="Nomor NIDN ketua peneliti">
                                @error('nidn_leader')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="leader_name" class="form-label">Nama Ketua</label>
                                <input type="text" class="form-control @error('leader_name') is-invalid @enderror"
                                       id="leader_name" name="leader_name" value="{{ old('leader_name') }}"
                                       placeholder="Nama lengkap ketua peneliti">
                                @error('leader_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pddikti_code_pt" class="form-label">Kode PDDIKTI PT</label>
                                <input type="text" class="form-control @error('pddikti_code_pt') is-invalid @enderror"
                                       id="pddikti_code_pt" name="pddikti_code_pt" value="{{ old('pddikti_code_pt') }}"
                                       placeholder="Kode PDDIKTI perguruan tinggi">
                                @error('pddikti_code_pt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="institution" class="form-label">Institusi</label>
                                <input type="text" class="form-control @error('institution') is-invalid @enderror"
                                       id="institution" name="institution" value="{{ old('institution') }}"
                                       placeholder="Nama institusi perguruan tinggi">
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Skema Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-project-diagram me-2"></i>Informasi Skema
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="skema_abbreviation" class="form-label">Singkatan Skema</label>
                                <input type="text" class="form-control @error('skema_abbreviation') is-invalid @enderror"
                                       id="skema_abbreviation" name="skema_abbreviation" value="{{ old('skema_abbreviation') }}"
                                       placeholder="Contoh: PPM, PKM, dll">
                                @error('skema_abbreviation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="skema_name" class="form-label">Nama Skema</label>
                                <input type="text" class="form-control @error('skema_name') is-invalid @enderror"
                                       id="skema_name" name="skema_name" value="{{ old('skema_name') }}"
                                       placeholder="Nama lengkap skema pengabdian">
                                @error('skema_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Timeline Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-clock me-2"></i>Informasi Timeline
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="first_year_proposal" class="form-label">Tahun Pertama Proposal</label>
                                <input type="number" class="form-control @error('first_year_proposal') is-invalid @enderror"
                                       id="first_year_proposal" name="first_year_proposal" value="{{ old('first_year_proposal') }}"
                                       min="2000" max="{{ date('Y') + 10 }}" placeholder="Tahun">
                                @error('first_year_proposal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="proposed_year_activities" class="form-label">Tahun Kegiatan Diusulkan</label>
                                <input type="number" class="form-control @error('proposed_year_activities') is-invalid @enderror"
                                       id="proposed_year_activities" name="proposed_year_activities" value="{{ old('proposed_year_activities') }}"
                                       min="2000" max="{{ date('Y') + 10 }}" placeholder="Tahun">
                                @error('proposed_year_activities')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="activity_year" class="form-label">Tahun Kegiatan</label>
                                <input type="number" class="form-control @error('activity_year') is-invalid @enderror"
                                       id="activity_year" name="activity_year" value="{{ old('activity_year') }}"
                                       min="2000" max="{{ date('Y') + 10 }}" placeholder="Tahun">
                                @error('activity_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status dan Progress -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-tasks me-2"></i>Status dan Progress
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status Pengabdian <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    @foreach($statusOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', 'draft') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="proposal_status" class="form-label">Status Proposal</label>
                                <select class="form-select @error('proposal_status') is-invalid @enderror" id="proposal_status" name="proposal_status">
                                    <option value="">Pilih Status Proposal</option>
                                    @foreach($proposalStatusOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('proposal_status') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('proposal_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="progress_percentage" class="form-label">Progress (%)</label>
                                <input type="number" class="form-control @error('progress_percentage') is-invalid @enderror"
                                       id="progress_percentage" name="progress_percentage"
                                       value="{{ old('progress_percentage') }}" min="0" max="100"
                                       placeholder="0-100">
                                @error('progress_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tim Pelaksana -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-users me-2"></i>Tim Pelaksana
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="ketua_pengabdian" class="form-label">Ketua Pengabdian</label>
                                <input type="text" class="form-control @error('ketua_pengabdian') is-invalid @enderror"
                                       id="ketua_pengabdian" name="ketua_pengabdian" value="{{ old('ketua_pengabdian') }}"
                                       placeholder="Nama ketua pengabdian">
                                @error('ketua_pengabdian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tim_pelaksana" class="form-label">Tim Pelaksana</label>
                                <select class="form-select @error('tim_pelaksana') is-invalid @enderror"
                                        id="tim_pelaksana" name="tim_pelaksana[]" multiple>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}"
                                                {{ in_array($dosen->id, old('tim_pelaksana', [])) ? 'selected' : '' }}>
                                            {{ $dosen->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Tekan Ctrl untuk memilih multiple dosen</small>
                                @error('tim_pelaksana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="anggota_eksternal" class="form-label">Anggota Eksternal</label>
                                <textarea class="form-control @error('anggota_eksternal') is-invalid @enderror"
                                          id="anggota_eksternal" name="anggota_eksternal" rows="2"
                                          placeholder="Nama anggota dari luar kampus (jika ada), pisahkan dengan koma">{{ old('anggota_eksternal') }}</textarea>
                                @error('anggota_eksternal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="mitra_kerjasama" class="form-label">Mitra Kerjasama</label>
                                <input type="text" class="form-control @error('mitra_kerjasama') is-invalid @enderror"
                                       id="mitra_kerjasama" name="mitra_kerjasama" value="{{ old('mitra_kerjasama') }}"
                                       placeholder="Instansi atau organisasi yang terlibat">
                                @error('mitra_kerjasama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Waktu Pelaksanaan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-calendar-alt me-2"></i>Waktu Pelaksanaan
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                       id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                       id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="tanggal_target_selesai" class="form-label">Target Selesai</label>
                                <input type="date" class="form-control @error('tanggal_target_selesai') is-invalid @enderror"
                                       id="tanggal_target_selesai" name="tanggal_target_selesai" value="{{ old('tanggal_target_selesai') }}">
                                @error('tanggal_target_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="durasi_hari" class="form-label">Durasi (Hari)</label>
                                <input type="number" class="form-control @error('durasi_hari') is-invalid @enderror"
                                       id="durasi_hari" name="durasi_hari" value="{{ old('durasi_hari') }}" min="1">
                                @error('durasi_hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Lokasi dan Sasaran -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi dan Sasaran
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                       id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                                       placeholder="Kota/Kabupaten lokasi pengabdian">
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                                <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                       id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" min="1">
                                @error('jumlah_peserta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                          id="alamat_lengkap" name="alamat_lengkap" rows="2"
                                          placeholder="Alamat detail lokasi pengabdian">{{ old('alamat_lengkap') }}</textarea>
                                @error('alamat_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kelompok_sasaran" class="form-label">Kelompok Sasaran</label>
                                <input type="text" class="form-control @error('kelompok_sasaran') is-invalid @enderror"
                                       id="kelompok_sasaran" name="kelompok_sasaran" value="{{ old('kelompok_sasaran') }}"
                                       placeholder="Contoh: Masyarakat, Pelajar, dll">
                                @error('kelompok_sasaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kriteria_peserta" class="form-label">Kriteria Peserta</label>
                                <input type="text" class="form-control @error('kriteria_peserta') is-invalid @enderror"
                                       id="kriteria_peserta" name="kriteria_peserta" value="{{ old('kriteria_peserta') }}"
                                       placeholder="Kriteria khusus untuk peserta">
                                @error('kriteria_peserta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pendanaan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-money-bill-wave me-2"></i>Pendanaan
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="sumber_dana" class="form-label">Sumber Dana</label>
                                <input type="text" class="form-control @error('sumber_dana') is-invalid @enderror"
                                       id="sumber_dana" name="sumber_dana" value="{{ old('sumber_dana') }}"
                                       placeholder="Contoh: Mandiri, Hibah, dll">
                                @error('sumber_dana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="fund_source" class="form-label">Sumber Dana</label>
                                <input type="text" class="form-control @error('fund_source') is-invalid @enderror"
                                       id="fund_source" name="fund_source" value="{{ old('fund_source') }}"
                                       placeholder="Detail sumber dana">
                                @error('fund_source')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jumlah_dana" class="form-label">Jumlah Dana (Rp)</label>
                                <input type="number" class="form-control @error('jumlah_dana') is-invalid @enderror"
                                       id="jumlah_dana" name="jumlah_dana" value="{{ old('jumlah_dana') }}" min="0">
                                @error('jumlah_dana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="fund_approved" class="form-label">Dana yang Disetujui (Rp)</label>
                                <input type="number" class="form-control @error('fund_approved') is-invalid @enderror"
                                       id="fund_approved" name="fund_approved" value="{{ old('fund_approved') }}" min="0">
                                @error('fund_approved')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="funds_institution" class="form-label">Institusi Pemberi Dana</label>
                                <input type="text" class="form-control @error('funds_institution') is-invalid @enderror"
                                       id="funds_institution" name="funds_institution" value="{{ old('funds_institution') }}"
                                       placeholder="Institusi yang memberikan dana">
                                @error('funds_institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="fund_source_category" class="form-label">Kategori Sumber Dana</label>
                                <input type="text" class="form-control @error('fund_source_category') is-invalid @enderror"
                                       id="fund_source_category" name="fund_source_category" value="{{ old('fund_source_category') }}"
                                       placeholder="Kategori sumber dana">
                                @error('fund_source_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="country_fund_source" class="form-label">Negara Sumber Dana</label>
                                <input type="text" class="form-control @error('country_fund_source') is-invalid @enderror"
                                       id="country_fund_source" name="country_fund_source" value="{{ old('country_fund_source') }}"
                                       placeholder="Negara asal dana">
                                @error('country_fund_source')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="hibah_program" class="form-label">Program Hibah</label>
                                <input type="text" class="form-control @error('hibah_program') is-invalid @enderror"
                                       id="hibah_program" name="hibah_program" value="{{ old('hibah_program') }}"
                                       placeholder="Nama program hibah">
                                @error('hibah_program')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hibah Kompetitif</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input @error('hibah_kompetitif') is-invalid @enderror"
                                           type="checkbox" id="hibah_kompetitif" name="hibah_kompetitif" value="1"
                                           {{ old('hibah_kompetitif') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hibah_kompetitif">
                                        Ya, ini hibah kompetitif
                                    </label>
                                </div>
                                @error('hibah_kompetitif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Tambahan
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="sinta_affiliation_id" class="form-label">ID Afiliasi SINTA</label>
                                <input type="text" class="form-control @error('sinta_affiliation_id') is-invalid @enderror"
                                       id="sinta_affiliation_id" name="sinta_affiliation_id" value="{{ old('sinta_affiliation_id') }}"
                                       placeholder="ID afiliasi SINTA">
                                @error('sinta_affiliation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="target_tkt" class="form-label">Target TKT</label>
                                <input type="number" class="form-control @error('target_tkt') is-invalid @enderror"
                                       id="target_tkt" name="target_tkt" value="{{ old('target_tkt') }}"
                                       min="1" max="9" placeholder="1-9">
                                @error('target_tkt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="focus_area" class="form-label">Area Fokus</label>
                                <textarea class="form-control @error('focus_area') is-invalid @enderror"
                                          id="focus_area" name="focus_area" rows="2"
                                          placeholder="Area fokus pengabdian masyarakat">{{ old('focus_area') }}</textarea>
                                @error('focus_area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Output dan Dampak -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-chart-line me-2"></i>Output dan Dampak
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="tujuan" class="form-label">Tujuan Pengabdian</label>
                                <textarea class="form-control @error('tujuan') is-invalid @enderror"
                                          id="tujuan" name="tujuan" rows="3"
                                          placeholder="Tujuan yang ingin dicapai dari pengabdian ini">{{ old('tujuan') }}</textarea>
                                @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="luaran" class="form-label">Luaran yang Diharapkan</label>
                                <textarea class="form-control @error('luaran') is-invalid @enderror"
                                          id="luaran" name="luaran" rows="3"
                                          placeholder="Hasil/output yang akan dihasilkan">{{ old('luaran') }}</textarea>
                                @error('luaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="dampak_manfaat" class="form-label">Dampak dan Manfaat</label>
                                <textarea class="form-control @error('dampak_manfaat') is-invalid @enderror"
                                          id="dampak_manfaat" name="dampak_manfaat" rows="3"
                                          placeholder="Manfaat yang akan diperoleh masyarakat">{{ old('dampak_manfaat') }}</textarea>
                                @error('dampak_manfaat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="indikator_keberhasilan" class="form-label">Indikator Keberhasilan</label>
                                <textarea class="form-control @error('indikator_keberhasilan') is-invalid @enderror"
                                          id="indikator_keberhasilan" name="indikator_keberhasilan" rows="2"
                                          placeholder="Cara mengukur keberhasilan pengabdian">{{ old('indikator_keberhasilan') }}</textarea>
                                @error('indikator_keberhasilan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kendala_hambatan" class="form-label">Kendala dan Hambatan</label>
                                <textarea class="form-control @error('kendala_hambatan') is-invalid @enderror"
                                          id="kendala_hambatan" name="kendala_hambatan" rows="2"
                                          placeholder="Kendala yang mungkin dihadapi">{{ old('kendala_hambatan') }}</textarea>
                                @error('kendala_hambatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Dokumentasi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-file-alt me-2"></i>Dokumentasi
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="file_proposal" class="form-label">File Proposal</label>
                                <input type="file" class="form-control @error('file_proposal') is-invalid @enderror"
                                       id="file_proposal" name="file_proposal" accept=".pdf,.doc,.docx">
                                <small class="form-text text-muted">Format: PDF, DOC, DOCX. Maksimal 10MB</small>
                                @error('file_proposal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="file_laporan" class="form-label">File Laporan</label>
                                <input type="file" class="form-control @error('file_laporan') is-invalid @enderror"
                                       id="file_laporan" name="file_laporan" accept=".pdf,.doc,.docx">
                                <small class="form-text text-muted">Format: PDF, DOC, DOCX. Maksimal 10MB</small>
                                @error('file_laporan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="file_dokumentasi" class="form-label">File Dokumentasi</label>
                                <input type="file" class="form-control @error('file_dokumentasi') is-invalid @enderror"
                                       id="file_dokumentasi" name="file_dokumentasi"
                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">
                                <small class="form-text text-muted">Format: PDF, DOC, DOCX, JPG, PNG, ZIP. Maksimal 20MB</small>
                                @error('file_dokumentasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="file_sertifikat" class="form-label">File Sertifikat</label>
                                <input type="file" class="form-control @error('file_sertifikat') is-invalid @enderror"
                                       id="file_sertifikat" name="file_sertifikat" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">Format: PDF, DOC, DOCX, JPG, PNG. Maksimal 5MB</small>
                                @error('file_sertifikat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="link_dokumentasi" class="form-label">Link Dokumentasi</label>
                                <input type="url" class="form-control @error('link_dokumentasi') is-invalid @enderror"
                                       id="link_dokumentasi" name="link_dokumentasi" value="{{ old('link_dokumentasi') }}"
                                       placeholder="https://drive.google.com/... atau link lainnya">
                                @error('link_dokumentasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- SK dan Administrasi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-file-signature me-2"></i>SK dan Administrasi
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="nomor_sk" class="form-label">Nomor SK</label>
                                <input type="text" class="form-control @error('nomor_sk') is-invalid @enderror"
                                       id="nomor_sk" name="nomor_sk" value="{{ old('nomor_sk') }}"
                                       placeholder="Nomor surat keputusan">
                                @error('nomor_sk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="tanggal_sk" class="form-label">Tanggal SK</label>
                                <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror"
                                       id="tanggal_sk" name="tanggal_sk" value="{{ old('tanggal_sk') }}">
                                @error('tanggal_sk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="file_sk" class="form-label">File SK</label>
                                <input type="file" class="form-control @error('file_sk') is-invalid @enderror"
                                       id="file_sk" name="file_sk" accept=".pdf,.doc,.docx">
                                <small class="form-text text-muted">Format: PDF, DOC, DOCX. Maksimal 5MB</small>
                                @error('file_sk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Evaluasi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-star me-2"></i>Evaluasi
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="tingkat_kepuasan" class="form-label">Tingkat Kepuasan</label>
                                <select class="form-select @error('tingkat_kepuasan') is-invalid @enderror"
                                        id="tingkat_kepuasan" name="tingkat_kepuasan">
                                    <option value="">Pilih Tingkat Kepuasan</option>
                                    @foreach($kepuasanOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('tingkat_kepuasan') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tingkat_kepuasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <!-- Spacer for alignment -->
                            </div>

                            <div class="col-12">
                                <label for="evaluasi_kegiatan" class="form-label">Evaluasi Kegiatan</label>
                                <textarea class="form-control @error('evaluasi_kegiatan') is-invalid @enderror"
                                          id="evaluasi_kegiatan" name="evaluasi_kegiatan" rows="3"
                                          placeholder="Evaluasi keseluruhan kegiatan pengabdian">{{ old('evaluasi_kegiatan') }}</textarea>
                                @error('evaluasi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="rekomendasi" class="form-label">Rekomendasi</label>
                                <textarea class="form-control @error('rekomendasi') is-invalid @enderror"
                                          id="rekomendasi" name="rekomendasi" rows="3"
                                          placeholder="Rekomendasi untuk pengabdian selanjutnya">{{ old('rekomendasi') }}</textarea>
                                @error('rekomendasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Pengabdian
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.card-header {
    border-bottom: none;
    padding: 1.5rem;
}

.card-body {
    padding: 2rem;
}

.card-footer {
    border-top: 1px solid #dee2e6;
    padding: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #495057;
}

h5 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.border-bottom {
    border-bottom: 2px solid #e9ecef !important;
}

.text-primary {
    color: #0d6efd !important;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize select2 for multiple select
    $('#tim_pelaksana').select2({
        placeholder: 'Pilih tim pelaksana',
        allowClear: true,
        width: '100%'
    });

    // Auto calculate duration when dates change
    $('#tanggal_mulai, #tanggal_selesai').change(function() {
        const startDate = new Date($('#tanggal_mulai').val());
        const endDate = new Date($('#tanggal_selesai').val());

        if (startDate && endDate && endDate >= startDate) {
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            $('#durasi_hari').val(diffDays);
        }
    });

    // Format number input for jumlah_dana
    $('#jumlah_dana').on('input', function() {
        let value = $(this).val().replace(/[^\d]/g, '');
        $(this).val(value);
    });
});
</script>
@endpush
@endsection
