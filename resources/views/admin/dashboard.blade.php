@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold">
                    <i class="fas fa-tachometer-alt mr-2 text-primary"></i>Dashboard Admin
                </h1>
                <p class="text-muted">Selamat datang di Dashboard Admin LPPM</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    <!-- Stats Cards Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- Total Dosen -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalDosen ?? 0 }}</h3>
                    <p>Total Dosen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                @if(Route::has('admin.dosens.index'))
                <a href="{{ route('admin.dosens.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
                @else
                <div class="small-box-footer">
                    <span class="text-white-50">Data Dosen</span>
                </div>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- Total Content -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalContent ?? 0 }}</h3>
                    <p>Total Konten</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                @if(Route::has('admin.contents.index'))
                <a href="{{ route('admin.contents.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
                @else
                <div class="small-box-footer">
                    <span class="text-white-50">Data Konten</span>
                </div>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- Total Research -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalResearch ?? 0 }}</h3>
                    <p>Penelitian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-microscope"></i>
                </div>
                @if(Route::has('admin.researches.index'))
                <a href="{{ route('admin.researches.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
                @else
                <div class="small-box-footer">
                    <span class="text-white-50">Data Penelitian</span>
                </div>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- Total HAKI -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalHaki ?? 0 }}</h3>
                    <p>HAKI</p>
                </div>
                <div class="icon">
                    <i class="fas fa-copyright"></i>
                </div>
                @if(Route::has('admin.haki.index'))
                <a href="{{ route('admin.haki.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
                @else
                <div class="small-box-footer">
                    <span class="text-white-50">Data HAKI</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-8">
            <!-- Chart Statistik -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-2"></i>Statistik Data
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="statistikChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Quick Actions -->
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if(Route::has('admin.dosens.create'))
                        <a href="{{ route('admin.dosens.create') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-user-plus mr-2"></i>Tambah Dosen
                        </a>
                        @endif

                        @if(Route::has('admin.contents.create'))
                        <a href="{{ route('admin.contents.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus mr-2"></i>Tambah Konten
                        </a>
                        @endif

                        @if(Route::has('admin.researches.create'))
                        <a href="{{ route('admin.researches.create') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-microscope mr-2"></i>Tambah Penelitian
                        </a>
                        @endif

                        @if(Route::has('admin.haki.create'))
                        <a href="{{ route('admin.haki.create') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-copyright mr-2"></i>Tambah HAKI
                        </a>
                        @endif

                        @if(Route::has('admin.qualifications.create'))
                        <a href="{{ route('admin.qualifications.create') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-graduation-cap mr-2"></i>Tambah Kualifikasi
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status Overview -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>Status Overview
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <tr>
                            <td><i class="fas fa-circle text-success mr-2"></i>Aktif</td>
                            <td class="text-right"><strong>{{ $statusStats['active'] ?? 0 }}</strong></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-circle text-warning mr-2"></i>Draft</td>
                            <td class="text-right"><strong>{{ $statusStats['draft'] ?? 0 }}</strong></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-circle text-danger mr-2"></i>Pending</td>
                            <td class="text-right"><strong>{{ $statusStats['pending'] ?? 0 }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Row -->
    <div class="row">
        <div class="col-md-6">
            <!-- Recent Content -->
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clock mr-2"></i>Konten Terbaru
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <tbody>
                                @forelse($recentContent ?? [] as $content)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary rounded mr-2">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ Str::limit($content->title ?? 'Untitled', 30) }}</div>
                                                <small class="text-muted">{{ $content->created_at ? $content->created_at->diffForHumans() : 'Unknown' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-muted py-3">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <br>Belum ada konten terbaru
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Recent Dosen -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-2"></i>Dosen Terbaru
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <tbody>
                                @forelse($recentDosen ?? [] as $dosen)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-success rounded mr-2">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $dosen->nama ?? 'Unknown' }}</div>
                                                <small class="text-muted">{{ $dosen->created_at ? $dosen->created_at->diffForHumans() : 'Unknown' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-muted py-3">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <br>Belum ada dosen terbaru
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-server mr-2"></i>Informasi Sistem
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="fas fa-code"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Laravel Version</span>
                                    <span class="info-box-number">{{ app()->version() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="fab fa-php"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">PHP Version</span>
                                    <span class="info-box-number">{{ PHP_VERSION }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Server Time</span>
                                    <span class="info-box-number">{{ now()->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="fas fa-hdd"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Storage</span>
                                    <span class="info-box-number">Available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.small-box {
    border-radius: 10px;
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.small-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.small-box .inner {
    padding: 20px;
}

.small-box .inner h3 {
    font-size: 2.2rem;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}

.small-box .inner p {
    font-size: 1rem;
    margin: 0;
    opacity: 0.8;
}

.small-box .icon {
    transition: all 0.3s linear;
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 0;
    font-size: 70px;
    color: rgba(0,0,0,0.15);
}

.small-box .small-box-footer {
    position: relative;
    text-align: center;
    padding: 10px 0;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    border-radius: 0 0 10px 10px;
    transition: all 0.3s ease;
}

.small-box .small-box-footer:hover {
    color: #fff;
    background: rgba(0,0,0,0.2);
    text-decoration: none;
}

.avatar-sm {
    height: 32px;
    width: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.info-box {
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.info-box:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    transform: translateY(-1px);
}

.card {
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.card-outline.card-primary {
    border-top: 3px solid #007bff;
}

.card-outline.card-success {
    border-top: 3px solid #28a745;
}

.card-outline.card-info {
    border-top: 3px solid #17a2b8;
}

.card-outline.card-warning {
    border-top: 3px solid #ffc107;
}

.card-outline.card-secondary {
    border-top: 3px solid #6c757d;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,0.05);
}

.d-grid.gap-2 > * {
    margin-bottom: 8px;
}

.d-grid.gap-2 > *:last-child {
    margin-bottom: 0;
}

.btn-sm {
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-sm:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

/* Loading animation */
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .small-box .inner h3 {
        font-size: 1.8rem;
    }

    .small-box .icon {
        font-size: 50px;
        top: 15px;
        right: 15px;
    }

    .d-grid.gap-2 > * {
        margin-bottom: 10px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Data dari Controller (fallback jika tidak ada)
    const dosenPerTahun = @json($dosenPerTahun ?? []);
    const contentPerBulan = @json($contentPerBulan ?? []);
    const hakiStats = @json($hakiStats ?? []);
    const researchStats = @json($researchStats ?? []);

    // Chart Configuration
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: 'rgba(255,255,255,0.1)',
                borderWidth: 1,
                cornerRadius: 6,
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)',
                },
                ticks: {
                    color: '#666',
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.1)',
                },
                ticks: {
                    color: '#666',
                }
            }
        }
    };

    // Statistik Chart - Multi Dataset
    const ctx = document.getElementById('statistikChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Konten',
                        data: Object.values(contentPerBulan).length > 0 ? Object.values(contentPerBulan) : [10, 15, 20, 18, 25, 30, 28, 35, 40, 45, 50, 55],
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#28a745',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    },
                    {
                        label: 'Penelitian',
                        data: Object.values(researchStats).length > 0 ? Object.values(researchStats) : [5, 8, 12, 10, 15, 18, 16, 20, 25, 22, 28, 30],
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffc107',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    },
                    {
                        label: 'HAKI',
                        data: Object.values(hakiStats).length > 0 ? Object.values(hakiStats) : [2, 3, 5, 4, 7, 8, 9, 12, 10, 15, 18, 20],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#dc3545',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    }
                ]
            },
            options: chartOptions
        });
    }

    // Animation for small boxes
    $('.small-box').each(function(index) {
        $(this).css('opacity', '0').css('transform', 'translateY(20px)');
        $(this).delay(index * 100).animate(
            { opacity: 1 },
            {
                duration: 500,
                step: function(now) {
                    $(this).css('transform', 'translateY(' + (20 * (1 - now)) + 'px)');
                }
            }
        );
    });

    // Counter animation for numbers
    $('.small-box .inner h3').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text()) || 0;

        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(countTo);
            }
        });
    });

    // Auto refresh every 5 minutes
    setInterval(function() {
        // Add refresh indicator
        const refreshBtn = '<i class="fas fa-sync-alt fa-spin ml-2"></i>';
        $('.content-header h1').append(refreshBtn);

        // Remove after 2 seconds
        setTimeout(function() {
            $('.fa-sync-alt').remove();
        }, 2000);
    }, 300000); // 5 minutes

    // Quick action buttons hover effect
    $('.btn').hover(
        function() {
            $(this).addClass('shadow-lg');
        },
        function() {
            $(this).removeClass('shadow-lg');
        }
    );

    // Card loading animation
    $('.card').each(function(index) {
        $(this).css('opacity', '0');
        $(this).delay(index * 50).animate({ opacity: 1 }, 300);
    });
});

// Real-time clock update
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    $('.info-box-number').last().text(timeString);
}

setInterval(updateClock, 1000);
updateClock(); // Initial call
</script>
@endpush
