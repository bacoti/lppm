@extends('admin.layouts.admin')

@section('title', 'Manajemen HAKI')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manajemen HAKI</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">HAKI</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
            <!-- Search and Filter Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter mr-2"></i>Filter & Pencarian
                    </h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.haki.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="search">Kata Kunci</label>
                                    <input type="text" name="search" id="search" class="form-control"
                                           placeholder="Cari judul, nomor pendaftaran..."
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis">Jenis HAKI</label>
                                    <select name="jenis" id="jenis" class="form-control">
                                        <option value="">Semua Jenis</option>
                                        @foreach(\App\Models\Haki::getJenisHakiOptions() as $key => $label)
                                            <option value="{{ $key }}" {{ request('jenis') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        @foreach(\App\Models\Haki::getStatusOptions() as $key => $label)
                                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary mr-2">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                        <a href="{{ route('admin.haki.index') }}" class="btn btn-secondary">
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
                        <i class="fas fa-copyright mr-2"></i>Data HAKI
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.haki.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus mr-1"></i>Tambah HAKI
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Jenis HAKI</th>
                                <th>Inventor</th>
                                <th>No. Pendaftaran</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hakis as $index => $haki)
                                <tr>
                                    <td>{{ ($hakis->currentPage() - 1) * $hakis->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ Str::limit($haki->judul, 50) }}</strong>
                                        @if($haki->bidang_teknologi)
                                            <br><small class="text-muted">{{ $haki->bidang_teknologi }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ \App\Models\Haki::getJenisHakiOptions()[$haki->jenis_haki] }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(is_array($haki->inventor))
                                            {{ implode(', ', array_slice($haki->inventor, 0, 2)) }}
                                            @if(count($haki->inventor) > 2)
                                                <br><small class="text-muted">+{{ count($haki->inventor) - 2 }} lainnya</small>
                                            @endif
                                        @else
                                            {{ $haki->inventor }}
                                        @endif
                                    </td>
                                    <td>{{ $haki->nomor_pendaftaran ?: '-' }}</td>
                                    <td>
                                        <span class="badge {{ $haki->getStatusBadgeClass() }}">
                                            {{ \App\Models\Haki::getStatusOptions()[$haki->status] }}
                                        </span>
                                    </td>
                                    <td>{{ $haki->tanggal_daftar ? $haki->tanggal_daftar->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.haki.show', $haki) }}"
                                               class="btn btn-info btn-sm" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.haki.edit', $haki) }}"
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.haki.destroy', $haki) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                            <i class="fas fa-copyright fa-3x mb-3"></i>
                                            <p>Belum ada data HAKI</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($hakis->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $hakis->firstItem() }} - {{ $hakis->lastItem() }}
                            dari {{ $hakis->total() }} data
                        </small>
                        {{ $hakis->withQueryString()->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto submit form when select changes
    $('#jenis, #status').change(function() {
        $(this).closest('form').submit();
    });
});
</script>
@endpush
