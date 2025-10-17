@extends('admin.layouts.admin')

@section('title', 'Manajemen Dokumen')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Dokumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dokumen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Filter Section -->
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.dokumen.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Pencarian</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" id="search" class="form-control"
                                       placeholder="Cari judul, deskripsi, atau nama file..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <a href="{{ route('admin.dokumen.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus mr-1"></i>Tambah Dokumen
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Dokumen List -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Dokumen</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Ukuran</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokumens as $dokumen)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($dokumen->judul, 50) }}</strong>
                                    @if($dokumen->deskripsi)
                                        <br><small class="text-muted">{{ Str::limit($dokumen->deskripsi, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-file-{{ $dokumen->file_extension == 'pdf' ? 'pdf' : 'alt' }} mr-1"></i>
                                    {{ Str::limit($dokumen->file_name, 30) }}
                                </td>
                                <td>{{ $dokumen->file_size_formatted }}</td>
                                <td>
                                    <span class="badge {{ $dokumen->status == 'published' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ ucfirst($dokumen->status) }}
                                    </span>
                                </td>
                                <td>{{ $dokumen->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ $dokumen->file_url }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="{{ route('admin.dokumen.show', $dokumen) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.dokumen.edit', $dokumen) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.dokumen.destroy', $dokumen) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="mb-3">
                                        <i class="fas fa-file-alt fa-3x text-muted"></i>
                                    </div>
                                    <h5 class="text-muted">Belum ada dokumen</h5>
                                    <p class="text-muted mb-3">
                                        @if(request()->hasAny(['search', 'status']))
                                            Tidak ada dokumen yang sesuai dengan filter Anda.
                                        @else
                                            Mulai dengan menambahkan dokumen pertama.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'status']))
                                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-primary">
                                        <i class="fas fa-refresh mr-1"></i>Reset Filter
                                    </a>
                                    @else
                                    <a href="{{ route('admin.dokumen.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus mr-1"></i>Tambah Dokumen
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($dokumens->hasPages())
                <div class="card-footer">
                    {{ $dokumens->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
