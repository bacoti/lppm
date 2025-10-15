<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Akses Form - LPPM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .guide-card { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 15px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="guide-card p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-info-circle text-primary" style="font-size: 3rem;"></i>
                        <h2 class="mt-3">Panduan Akses Form Content</h2>
                        <p class="text-muted">Error 404 terjadi karena Anda belum login sebagai admin</p>
                    </div>

                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle"></i> Masalah yang Terjadi:</h5>
                        <p class="mb-0">Route <code>/admin/contents/create-fixed</code> memerlukan authentication admin. Anda perlu login dulu.</p>
                    </div>

                    <h4><i class="fas fa-key"></i> Cara Login Admin:</h4>
                    <ol class="mb-4">
                        <li><strong>Pergi ke halaman login admin:</strong>
                            <br><a href="/admin/login" class="btn btn-primary btn-sm mt-1">
                                <i class="fas fa-sign-in-alt"></i> Login Admin
                            </a>
                        </li>
                        <li><strong>Gunakan kredensial admin:</strong>
                            <div class="bg-light p-3 rounded mt-2">
                                <strong>Email:</strong> admin@lppm.com<br>
                                <strong>Password:</strong> admin123
                            </div>
                        </li>
                        <li><strong>Setelah login, akses form content</strong></li>
                    </ol>

                    <h4><i class="fas fa-tools"></i> Alternatif untuk Testing (Tanpa Login):</h4>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6>Form Fixed (Debug)</h6>
                                    <a href="/admin/debug/create-fixed" class="btn btn-success">
                                        <i class="fas fa-wrench"></i> Test Fixed Form
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6>Simple Form (Debug)</h6>
                                    <a href="/admin/debug/create-simple" class="btn btn-info">
                                        <i class="fas fa-bug"></i> Test Simple Form
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h6><i class="fas fa-lightbulb"></i> Rekomendasi:</h6>
                        <ol class="mb-0">
                            <li><strong>Login sebagai admin</strong> untuk akses penuh</li>
                            <li><strong>Gunakan debug forms</strong> untuk testing cepat</li>
                            <li><strong>Setelah testing berhasil</strong>, gunakan form asli di admin panel</li>
                        </ol>
                    </div>

                    <div class="text-center">
                        <a href="/" class="btn btn-secondary me-2">
                            <i class="fas fa-home"></i> Kembali ke Home
                        </a>
                        <a href="/admin/login" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Login Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>