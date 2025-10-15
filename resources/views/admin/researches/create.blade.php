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

                            <!-- Pendanaan -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-money-bill-wave me-2"></i>
                                                Pendanaan
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
