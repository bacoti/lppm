@extends('layouts.admin')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Konten</h2>
        <a href="{{ route('admin.contents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Konten
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Halaman</th>
                            <th width="25%">Judul</th>
                            <th width="15%">Gambar</th>
                            <th width="15%">Tanggal</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contents as $index => $content)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ ucfirst($content->slug) }}</span>
                                </td>
                                <td>
                                    <strong>{{ $content->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit(strip_tags($content->body), 50) }}</small>
                                </td>
                                <td class="text-center">
                                    @if($content->imageContents->count() > 0)
                                        <span class="badge bg-success">
                                            <i class="fas fa-images"></i> {{ $content->imageContents->count() }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-image"></i> 0
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small>
                                        <i class="fas fa-calendar-alt"></i> {{ $content->created_at->format('d/m/Y') }}<br>
                                        <i class="fas fa-clock"></i> {{ $content->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contents.show', $content->id) }}" 
                                           class="btn btn-sm btn-info" title="Preview">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.contents.edit', $content->id) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $content->id }}" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Modal for each content -->
                            <div class="modal fade" id="deleteModal{{ $content->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus konten:</p>
                                            <p><strong>"{{ $content->title }}"</strong></p>
                                            <p class="text-danger">
                                                <i class="fas fa-exclamation-triangle"></i> 
                                                Tindakan ini akan menghapus semua gambar terkait dan tidak dapat dibatalkan!
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-file-alt fa-3x mb-3"></i>
                                        <p>Belum ada konten. <a href="{{ route('admin.contents.create') }}">Tambah konten pertama</a></p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 5000);
        });
    });
</script>
@endsection
