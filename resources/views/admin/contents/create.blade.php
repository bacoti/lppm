@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Tambah Konten Baru</h3>
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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data" id="contentForm">
                @csrf
                
                <!-- Debug Info Panel -->
                <div class="alert alert-info" id="debugInfo" style="display: none;">
                    <h6>Debug Information:</h6>
                    <div id="debugContent"></div>
                </div>
                
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
                    <label class="form-label">Upload Gambar (Opsional)</label>
                    <div id="image-upload-wrapper">
                        <input type="file" name="images[]" class="form-control mb-2" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-image-button">
                        <i class="fas fa-plus"></i> Tambah Gambar
                    </button>
                    <small class="form-text text-muted">Format: JPG, PNG, GIF, WebP. Maksimal 2MB per file.</small>
                    @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Isi Konten <span class="text-danger">*</span></label>
                    <div id="editor-status" class="alert alert-warning" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i> Loading editor...
                    </div>
                    <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror" rows="10" required>{{ old('body') }}</textarea>
                    <small class="form-text text-muted">
                        <span id="editor-type">Editor: Basic Textarea</span>
                    </small>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Konten
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
        console.log('DOM loaded, initializing form...');
        
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

        // Add more image upload fields
        const addImageBtn = document.getElementById('add-image-button');
        const wrapper = document.getElementById('image-upload-wrapper');
        
        if (addImageBtn && wrapper) {
            addImageBtn.addEventListener('click', function () {
                const inputGroup = document.createElement('div');
                inputGroup.classList.add('d-flex', 'mb-2');
                
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'images[]';
                newInput.accept = 'image/jpeg,image/png,jpg,gif,webp';
                newInput.classList.add('form-control', 'me-2');
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
                removeBtn.innerHTML = '<i class="fas fa-minus"></i>';
                removeBtn.addEventListener('click', function() {
                    inputGroup.remove();
                });
                
                inputGroup.appendChild(newInput);
                inputGroup.appendChild(removeBtn);
                wrapper.appendChild(inputGroup);
            });
        }

        // Initialize TinyMCE first
        initializeTinyMCE();

        // Debug button handler
        const debugBtn = document.getElementById('debugBtn');
        if (debugBtn) {
            debugBtn.addEventListener('click', function() {
                console.log('=== FORM DEBUG INFO ===');
                
                const form = document.getElementById('contentForm');
                const formData = new FormData(form);
                
                console.log('Form action:', form.action);
                console.log('Form method:', form.method);
                console.log('CSRF token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));
                
                // Show all form data
                for (let [key, value] of formData.entries()) {
                    console.log(key + ':', value);
                }
                
                // Test AJAX submission
                fetch('{{ route("admin.contents.test-store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Test response:', data);
                    alert('Test berhasil! Cek console untuk detail.');
                })
                .catch(error => {
                    console.error('Test error:', error);
                    alert('Test gagal! Cek console untuk detail.');
                });
            });
        }

        // Form submit handler
        setTimeout(function() {
            const form = document.getElementById('contentForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    console.log('Form submitting...');
                    
                    // Sync TinyMCE content
                    if (tinymce.get('body')) {
                        tinymce.get('body').save();
                    }
                    
                    // Disable submit button to prevent double submission
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                    
                    // Basic validation
                    const title = document.getElementById('title').value.trim();
                    const slug = document.getElementById('slug').value.trim();
                    const body = document.getElementById('body').value.trim();
                    
                    console.log('Form data:', {
                        title: title,
                        slug: slug,
                        body: body.substring(0, 100) + '...'
                    });
                    
                    if (!title || !slug || !body) {
                        e.preventDefault();
                        alert('Mohon lengkapi semua field yang wajib diisi!');
                        
                        // Re-enable submit button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Konten';
                        return false;
                    }
                    
                    console.log('Form validation passed, submitting...');
                    // Form will submit normally
                });
            }
        }, 1000); // Delay to ensure TinyMCE is loaded
    });

    function initializeTinyMCE() {
        // Load TinyMCE script dynamically to avoid conflicts
        if (typeof tinymce === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.tiny.cloud/1/5ol1nixbiz4naji2ylsaf32fuq8hikrlrs3as07q7pr6bq1k/tinymce/6/tinymce.min.js';
            script.referrerPolicy = 'origin';
            script.onload = function() {
                setupTinyMCE();
            };
            document.head.appendChild(script);
        } else {
            setupTinyMCE();
        }
    }

    function setupTinyMCE() {
        tinymce.init({
            selector: '#body',
            height: 400,
            plugins: 'image link media table lists code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | link image | bullist numlist | table | code',
            menubar: false,
            branding: false,
            automatic_uploads: true,
            file_picker_types: 'image',
            images_upload_handler: function (blobInfo, success, failure, progress) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route("admin.contents.upload") }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.upload.addEventListener('progress', function (e) {
                    progress(e.loaded / e.total * 100);
                });

                xhr.onload = function () {
                    if (xhr.status === 403) {
                        failure('HTTP Error: ' + xhr.status, { remove: true });
                        return;
                    }

                    if (xhr.status < 200 || xhr.status >= 300) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    let json;
                    try {
                        json = JSON.parse(xhr.responseText);
                    } catch (e) {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    if (!json || typeof json.location !== 'string') {
                        failure('Upload gagal: respons tidak sesuai.');
                        return;
                    }

                    success(json.location);
                };

                xhr.onerror = function () {
                    failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
            setup: function (editor) {
                editor.on('init', function () {
                    console.log('TinyMCE initialized successfully');
                });
                
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    }
</script>
@endsection