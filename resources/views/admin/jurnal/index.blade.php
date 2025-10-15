@extends('admin.layouts.admin')

@section('title', 'Manajemen Jurnal')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold">
                    <i class="fas fa-book-open mr-2 text-primary"></i>Manajemen Jurnal
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jurnal</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    <!-- Search and Filter Card -->
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter mr-2"></i>Filter & Pencarian
            </h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.jurnal.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="search">Kata Kunci</label>
                            <input type="text" name="search" id="search" class="form-control" 
                                   placeholder="Cari judul, jurnal, penerbit..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jenis_jurnal">Jenis</label>
                            <select name="jenis_jurnal" id="jenis_jurnal" class="form-control">
                                <option value="">Semua Jenis</option>
                                @foreach(\App\Models\Jurnal::getJenisJurnalOptions() as $key => $label)
                                    <option value="{{ $key }}" {{ request('jenis_jurnal') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Semua Status</option>
                                @foreach(\App\Models\Jurnal::getStatusOptions() as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">Semua Tahun</option>
                                @for($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list mr-2"></i>Data Jurnal
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.jurnal.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus mr-1"></i>Tambah Jurnal
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="min-width: 200px;">Judul</th>
                            <th style="min-width: 150px;">Jurnal</th>
                            <th style="min-width: 100px;">Jenis</th>
                            <th style="min-width: 100px;">Status</th>
                            <th style="min-width: 80px;">Tahun</th>
                            <th style="min-width: 100px;">Akreditasi</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jurnals as $index => $jurnal)
                            <tr>
                                <td>{{ ($jurnals->currentPage() - 1) * $jurnals->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($jurnal->is_featured)
                                            <i class="fas fa-star text-warning mr-1" title="Featured"></i>
                                        @endif
                                        <div>
                                            <strong>{{ Str::limit($jurnal->judul, 60) }}</strong>
                                            @if($jurnal->penulis && count($jurnal->penulis) > 0)
                                                <br><small class="text-muted">{{ Str::limit(implode(', ', array_slice($jurnal->penulis, 0, 2)), 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ Str::limit($jurnal->nama_jurnal, 40) }}</strong>
                                    @if($jurnal->penerbit)
                                        <br><small class="text-muted">{{ Str::limit($jurnal->penerbit, 30) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $jurnal->getJenisJurnalBadgeClass() }}">
                                        {{ \App\Models\Jurnal::getJenisJurnalOptions()[$jurnal->jenis_jurnal] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $jurnal->getStatusBadgeClass() }}">
                                        {{ \App\Models\Jurnal::getStatusOptions()[$jurnal->status] }}
                                    </span>
                                </td>
                                <td>{{ $jurnal->tahun ?: '-' }}</td>
                                <td>
                                    @if($jurnal->akreditasi)
                                        <span class="badge {{ $jurnal->getAkreditasiBadgeClass() }}">
                                            {{ \App\Models\Jurnal::getAkreditasiOptions()[$jurnal->akreditasi] }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.jurnal.show', $jurnal) }}" 
                                           class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.jurnal.edit', $jurnal) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.jurnal.destroy', $jurnal) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-book-open fa-3x mb-3"></i>
                                        <p>Belum ada data jurnal</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($jurnals->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $jurnals->firstItem() }} - {{ $jurnals->lastItem() }} 
                    dari {{ $jurnals->total() }} data
                </small>
                {{ $jurnals->withQueryString()->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto submit form when select changes
    $('#jenis_jurnal, #status, #tahun').change(function() {
        $(this).closest('form').submit();
    });
});
</script>
@endpush