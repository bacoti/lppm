@extends('admin.layouts.admin')

@section('title', 'Tambah Data Penelitian')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Data Penelitian
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.researches.store') }}" method="POST" enctype="multipart/form-data" id="researchForm">
                            @csrf

                            <!-- Informasi Dasar -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Informasi Dasar Penelitian
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="judul" class="form-label">Judul Penelitian <span class="text-danger">*</span></label>
                                                    <input type="text" name="judul" id="judul"
                                                           class="form-control @error('judul') is-invalid @enderror"
                                                           value="{{ old('judul') }}" required>
                                                    @error('judul')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="dosen_id" class="form-label">Ketua Peneliti</label>
                                                    <select name="dosen_id" id="dosen_id" class="form-select @error('dosen_id') is-invalid @enderror">
                                                        <option value="">-- Pilih Dosen --</option>
                                                        @foreach($dosens as $dosen)
                                                            <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                                                {{ $dosen->nama_lengkap }} ({{ $dosen->nidn_nip }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosen_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="bidang" class="form-label">Bidang Keilmuan</label>
                                                    <input type="text" name="bidang" id="bidang"
                                                           class="form-control @error('bidang') is-invalid @enderror"
                                                           value="{{ old('bidang') }}" placeholder="Contoh: Informatika, Biologi, dll">
                                                    @error('bidang')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="tahun" class="form-label">Tahun Penelitian</label>
                                                    <input type="number" name="tahun" id="tahun"
                                                           class="form-control @error('tahun') is-invalid @enderror"
                                                           value="{{ old('tahun', date('Y')) }}" min="2000" max="{{ date('Y') + 1 }}">
                                                    @error('tahun')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Leader dan Institusi -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-warning">
                                        <div class="card-header bg-warning text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-user-tie me-2"></i>
                                                Informasi Leader dan Institusi
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="nidn_leader" class="form-label">NIDN Leader</label>
                                                    <input type="text" name="nidn_leader" id="nidn_leader"
                                                           class="form-control @error('nidn_leader') is-invalid @enderror"
                                                           value="{{ old('nidn_leader') }}" placeholder="Masukkan NIDN leader">
                                                    @error('nidn_leader')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="leader_name" class="form-label">Nama Leader</label>
                                                    <input type="text" name="leader_name" id="leader_name"
                                                           class="form-control @error('leader_name') is-invalid @enderror"
                                                           value="{{ old('leader_name') }}" placeholder="Masukkan nama leader">
                                                    @error('leader_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="pddikti_code_pt" class="form-label">Kode PT PDDIKTI</label>
                                                    <input type="text" name="pddikti_code_pt" id="pddikti_code_pt"
                                                           class="form-control @error('pddikti_code_pt') is-invalid @enderror"
                                                           value="{{ old('pddikti_code_pt') }}" placeholder="Masukkan kode PT PDDIKTI">
                                                    @error('pddikti_code_pt')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="institution" class="form-label">Institusi</label>
                                                    <input type="text" name="institution" id="institution"
                                                           class="form-control @error('institution') is-invalid @enderror"
                                                           value="{{ old('institution') }}" placeholder="Masukkan nama institusi">
                                                    @error('institution')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Skema -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-project-diagram me-2"></i>
                                                Informasi Skema
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="skema_abbreviation" class="form-label">Singkatan Skema</label>
                                                    <input type="text" name="skema_abbreviation" id="skema_abbreviation"
                                                           class="form-control @error('skema_abbreviation') is-invalid @enderror"
                                                           value="{{ old('skema_abbreviation') }}" placeholder="Contoh: PDUPT, PD, dll">
                                                    @error('skema_abbreviation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="skema_name" class="form-label">Nama Skema</label>
                                                    <input type="text" name="skema_name" id="skema_name"
                                                           class="form-control @error('skema_name') is-invalid @enderror"
                                                           value="{{ old('skema_name') }}" placeholder="Nama lengkap skema">
                                                    @error('skema_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="first_proposal_year" class="form-label">Tahun Pertama Proposal</label>
                                                    <input type="number" name="first_proposal_year" id="first_proposal_year"
                                                           class="form-control @error('first_proposal_year') is-invalid @enderror"
                                                           value="{{ old('first_proposal_year') }}" min="2000" max="{{ date('Y') + 10 }}">
                                                    @error('first_proposal_year')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="proposed_year_of_activities" class="form-label">Tahun Kegiatan yang Diusulkan</label>
                                                    <input type="number" name="proposed_year_of_activities" id="proposed_year_of_activities"
                                                           class="form-control @error('proposed_year_of_activities') is-invalid @enderror"
                                                           value="{{ old('proposed_year_of_activities') }}" min="2000" max="{{ date('Y') + 10 }}">
                                                    @error('proposed_year_of_activities')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="year_of_activity" class="form-label">Tahun Kegiatan</label>
                                                    <input type="number" name="year_of_activity" id="year_of_activity"
                                                           class="form-control @error('year_of_activity') is-invalid @enderror"
                                                           value="{{ old('year_of_activity') }}" min="2000" max="{{ date('Y') + 10 }}">
                                                    @error('year_of_activity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status dan Kategori -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-tags me-2"></i>
                                                Status dan Kategori
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="status" class="form-label">Status Penelitian <span class="text-danger">*</span></label>
                                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                                        <option value="">-- Pilih Status --</option>
                                                        @foreach(\App\Models\Research::getStatusOptions() as $value => $label)
                                                            <option value="{{ $value }}" {{ old('status', 'draft') == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="kategori" class="form-label">Kategori Penelitian</label>
                                                    <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach(\App\Models\Research::getKategoriOptions() as $value => $label)
                                                            <option value="{{ $value }}" {{ old('kategori') == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="tingkat" class="form-label">Tingkat</label>
                                                    <select name="tingkat" id="tingkat" class="form-select @error('tingkat') is-invalid @enderror">
                                                        <option value="">-- Pilih Tingkat --</option>
                                                        @foreach(\App\Models\Research::getTingkatOptions() as $value => $label)
                                                            <option value="{{ $value }}" {{ old('tingkat') == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tingkat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="progress_percentage" class="form-label">Progress (%)</label>
                                                    <input type="number" name="progress_percentage" id="progress_percentage"
                                                           class="form-control @error('progress_percentage') is-invalid @enderror"
                                                           value="{{ old('progress_percentage', 0) }}" min="0" max="100">
                                                    @error('progress_percentage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="hibah_kompetitif" id="hibah_kompetitif"
                                                               class="form-check-input @error('hibah_kompetitif') is-invalid @enderror"
                                                               value="1" {{ old('hibah_kompetitif') ? 'checked' : '' }}>
                                                        <label for="hibah_kompetitif" class="form-check-label">
                                                            Hibah Kompetitif
                                                        </label>
                                                    </div>
                                                    @error('hibah_kompetitif')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Proposal -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-dark">
                                        <div class="card-header bg-dark text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-file-contract me-2"></i>
                                                Informasi Proposal
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="proposal_status" class="form-label">Status Proposal</label>
                                                    <select name="proposal_status" id="proposal_status" class="form-select @error('proposal_status') is-invalid @enderror">
                                                        <option value="">-- Pilih Status Proposal --</option>
                                                        @foreach(\App\Models\Research::getProposalStatusOptions() as $value => $label)
                                                            <option value="{{ $value }}" {{ old('proposal_status', 'draft') == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('proposal_status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="duration_of_activity" class="form-label">Durasi Kegiatan (tahun)</label>
                                                    <input type="number" name="duration_of_activity" id="duration_of_activity"
                                                           class="form-control @error('duration_of_activity') is-invalid @enderror"
                                                           value="{{ old('duration_of_activity') }}" min="1" max="10">
                                                    @error('duration_of_activity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="target_tkt_level" class="form-label">Target TKT Level</label>
                                                    <input type="number" name="target_tkt_level" id="target_tkt_level"
                                                           class="form-control @error('target_tkt_level') is-invalid @enderror"
                                                           value="{{ old('target_tkt_level') }}" min="1" max="9">
                                                    @error('target_tkt_level')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="hibah_program" class="form-label">Program Hibah</label>
                                                    <input type="text" name="hibah_program" id="hibah_program"
                                                           class="form-control @error('hibah_program') is-invalid @enderror"
                                                           value="{{ old('hibah_program') }}" placeholder="Contoh: PDUPT, PD, dll">
                                                    @error('hibah_program')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="focus_area" class="form-label">Area Fokus</label>
                                                    <input type="text" name="focus_area" id="focus_area"
                                                           class="form-control @error('focus_area') is-invalid @enderror"
                                                           value="{{ old('focus_area') }}" placeholder="Area fokus penelitian">
                                                    @error('focus_area')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pendanaan Tambahan -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-money-bill-wave me-2"></i>
                                                Pendanaan dan Sumber Dana
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="sumber_dana" class="form-label">Sumber Dana</label>
                                                    <input type="text" name="sumber_dana" id="sumber_dana"
                                                           class="form-control @error('sumber_dana') is-invalid @enderror"
                                                           value="{{ old('sumber_dana') }}" placeholder="Contoh: DIKTI, Mandiri, dll">
                                                    @error('sumber_dana')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="jumlah_dana" class="form-label">Jumlah Dana (Rp)</label>
                                                    <input type="number" name="jumlah_dana" id="jumlah_dana"
                                                           class="form-control @error('jumlah_dana') is-invalid @enderror"
                                                           value="{{ old('jumlah_dana') }}" min="0" step="1000"
                                                           placeholder="Masukkan jumlah dana dalam Rupiah">
                                                    @error('jumlah_dana')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="funds_approved" class="form-label">Dana yang Disetujui (Rp)</label>
                                                    <input type="number" name="funds_approved" id="funds_approved"
                                                           class="form-control @error('funds_approved') is-invalid @enderror"
                                                           value="{{ old('funds_approved') }}" min="0" step="1000"
                                                           placeholder="Dana yang disetujui">
                                                    @error('funds_approved')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="funds_institution" class="form-label">Institusi Pemberi Dana</label>
                                                    <input type="text" name="funds_institution" id="funds_institution"
                                                           class="form-control @error('funds_institution') is-invalid @enderror"
                                                           value="{{ old('funds_institution') }}" placeholder="Institusi pemberi dana">
                                                    @error('funds_institution')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="sinta_affiliation_id" class="form-label">SINTA Afiliasi ID</label>
                                                    <input type="text" name="sinta_affiliation_id" id="sinta_affiliation_id"
                                                           class="form-control @error('sinta_affiliation_id') is-invalid @enderror"
                                                           value="{{ old('sinta_affiliation_id') }}" placeholder="ID afiliasi SINTA">
                                                    @error('sinta_affiliation_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="fund_source_category" class="form-label">Kategori Sumber Dana</label>
                                                    <input type="text" name="fund_source_category" id="fund_source_category"
                                                           class="form-control @error('fund_source_category') is-invalid @enderror"
                                                           value="{{ old('fund_source_category') }}" placeholder="Kategori sumber dana">
                                                    @error('fund_source_category')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="fund_source" class="form-label">Sumber Dana</label>
                                                    <input type="text" name="fund_source" id="fund_source"
                                                           class="form-control @error('fund_source') is-invalid @enderror"
                                                           value="{{ old('fund_source') }}" placeholder="Sumber dana spesifik">
                                                    @error('fund_source')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="country_fund_source" class="form-label">Negara Sumber Dana</label>
                                                    <input type="text" name="country_fund_source" id="country_fund_source"
                                                           class="form-control @error('country_fund_source') is-invalid @enderror"
                                                           value="{{ old('country_fund_source', 'Indonesia') }}" placeholder="Negara sumber dana">
                                                    @error('country_fund_source')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Abstrak -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-secondary">
                                        <div class="card-header bg-secondary text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-file-alt me-2"></i>
                                                Abstrak
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <textarea name="abstrak" id="abstrak" rows="5"
                                                              class="form-control @error('abstrak') is-invalid @enderror"
                                                              placeholder="Jelaskan abstrak penelitian secara singkat dan jelas...">{{ old('abstrak') }}</textarea>
                                                    @error('abstrak')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Penelitian
                                        </button>
                                        <a href="{{ route('admin.researches.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .text-danger {
        font-weight: 700;
    }

    .card-header h6 {
        font-weight: 600;
    }

    .card-header small {
        font-style: italic;
    }

    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation enhancement
        const form = document.getElementById('researchForm');

        form.addEventListener('submit', function(e) {
            const judulInput = document.getElementById('judul');
            const statusSelect = document.getElementById('status');

            if (!judulInput.value.trim()) {
                e.preventDefault();
                judulInput.focus();
                alert('Judul penelitian harus diisi.');
                return false;
            }

            if (!statusSelect.value) {
                e.preventDefault();
                statusSelect.focus();
                alert('Status penelitian harus dipilih.');
                return false;
            }
        });

        // Auto-resize textarea
        const textarea = document.getElementById('abstrak');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }

        // Format number input for jumlah_dana
        const jumlahDanaInput = document.getElementById('jumlah_dana');
        if (jumlahDanaInput) {
            jumlahDanaInput.addEventListener('input', function() {
                // Remove non-numeric characters except decimal point
                this.value = this.value.replace(/[^\d.]/g, '');
            });
        }
    });
</script>
@endpush
