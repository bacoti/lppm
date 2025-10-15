@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Tambah Konten Baru (Simple Version)</h3>
        <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Terjadi kesalahan:</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data" id="simpleForm">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" required 
                           placeholder="Masukkan judul konten">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                           value="{{ old('slug') }}" required 
                           placeholder="url-friendly-text">
                    <small class="form-text text-muted">URL friendly (contoh: tentang-kami, beranda)</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Isi Konten <span class="text-danger">*</span></label>
                    <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" 
                              rows="8" required 
                              placeholder="Tulis konten di sini...">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Konten
                    </button>
                    <button type="button" class="btn btn-info" id="debugBtn">
                        <i class="fas fa-bug"></i> Debug Info
                    </button>
                    <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Simple form loaded');
        
        // Auto generate slug from title
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            });
        }

        // Debug button handler
        const debugBtn = document.getElementById('debugBtn');
        if (debugBtn) {
            debugBtn.addEventListener('click', function() {
                console.log('=== SIMPLE FORM DEBUG ===');
                
                const form = document.getElementById('simpleForm');
                const formData = new FormData(form);
                
                console.log('Form action:', form.action);
                console.log('Form method:', form.method);
                console.log('CSRF token exists:', !!document.querySelector('input[name="_token"]'));
                console.log('Current URL:', window.location.href);
                console.log('Auth status check...');
                
                // Check auth status
                fetch('{{ route("admin.dashboard") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Auth check response status:', response.status);
                    if (response.status === 401 || response.status === 403) {
                        console.log('❌ User not authenticated');
                    } else if (response.status === 200) {
                        console.log('✅ User authenticated');
                    }
                })
                .catch(error => {
                    console.log('Auth check error:', error);
                });
                
                // Show all form data
                for (let [key, value] of formData.entries()) {
                    console.log(key + ':', value);
                }
                
                alert('Debug info logged to console. Check browser console.');
            });
        }

        // Form submit handler
        const form = document.getElementById('simpleForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                console.log('Simple form submitting...');
                
                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                
                // Basic validation
                const title = document.getElementById('title').value.trim();
                const slug = document.getElementById('slug').value.trim();
                const body = document.getElementById('body').value.trim();
                
                console.log('Form values:', { title, slug, body });
                
                if (!title || !slug || !body) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi!');
                    
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Konten';
                    return false;
                }
                
                console.log('Simple form validation passed, submitting...');
                // Form will submit normally
            });
        }
    });
</script>
@endsection