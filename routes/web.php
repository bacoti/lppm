<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\HakiController as AdminHakiController;
use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Auth\DosenAuthController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\HakiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HakiController as FrontendHakiController;
use App\Models\Content;
use App\Models\ImageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==========================
// FRONTEND ROUTES
// ==========================

Route::get('/', function () {
    $content = Content::where('slug', 'home')->first();

    // Ambil gambar terkait konten (relasi dengan content_id)
    $images = ImageContent::where('content_id', $content->id ?? 0)->get();

    // Ambil data HAKI terbaru untuk ditampilkan di homepage
    $hakis = \App\Models\Haki::latest()
        ->where('status', '!=', 'draft')
        ->limit(6)
        ->get();

    return view('frontend.home', compact('content', 'images', 'hakis'));
})->name('home');

Route::get('/tentang', function () {
    $content = Content::where('slug', 'tentang')->first();

    return view('frontend.tentang', compact('content'));
})->name('tentang');

Route::view('/faq', 'frontend.faq')->name('faq');

// Guide page untuk troubleshooting
Route::view('/admin-guide', 'guide')->name('admin.guide');

Route::prefix('tridarma')->group(function () {
    Route::get('/penelitian', [ResearchController::class, 'penelitian'])->name('tridarma.penelitian');
    Route::get('/penelitian/{id}', [ResearchController::class, 'detail'])
        ->name('frontend.researches.show');
    Route::get('/pengabdian', [ServiceController::class, 'pengabdian'])->name('tridarma.pengabdian');
    Route::get('/pengabdian/{id}', [ServiceController::class, 'detail'])
        ->name('frontend.services.show');
});

// HAKI Routes
Route::get('/haki', [HakiController::class, 'index'])->name('frontend.haki');
Route::get('/haki/{haki}', [HakiController::class, 'show'])->name('frontend.haki.show');

// Jurnal Routes - Disabled
// Route::get('/jurnal', [App\Http\Controllers\JurnalController::class, 'index'])->name('jurnal.index');
// Route::get('/jurnal/{jurnal}', [App\Http\Controllers\JurnalController::class, 'show'])->name('jurnal.show');
// Route::get('/jurnal/{jurnal}/download', [App\Http\Controllers\JurnalController::class, 'download'])->name('jurnal.download');
// Route::post('/jurnal/{jurnal}/track-view', [App\Http\Controllers\JurnalController::class, 'trackView'])->name('jurnal.track-view');

// Dokumen Routes
Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
Route::get('/dokumen/{slug}', [DokumenController::class, 'show'])->name('dokumen.show');
Route::get('/dokumen/{slug}/download', [DokumenController::class, 'download'])->name('dokumen.download');

Route::prefix('pangkalan')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('pangkalan.profil');
    Route::get('/kualifikasi', [QualificationController::class, 'kualifikasi'])->name('pangkalan.kualifikasi');
    Route::get('/kompetensi', [CompetenceController::class, 'kompetensi'])->name('pangkalan.kompetensi');
});

// Login dosen di frontend
Route::get('/login', [DosenAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [DosenAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [DosenAuthController::class, 'logout'])->name('logout');

// ==========================
// ADMIN ROUTES
// ==========================
Route::redirect('/admin', '/admin/login');

Route::prefix('admin')->name('admin.')->group(function () {
    // Login dan Logout Admin
    Route::get('/login', [AdminAuth::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');

    // Dashboard & CRUD hanya untuk admin yang sudah login
    Route::middleware('auth:admin')->group(function () {
        // ✅ Dashboard sekarang pakai Controller
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Konten
        Route::resource('contents', ContentController::class);
        Route::post('contents/upload', [ContentController::class, 'upload'])->name('contents.upload');
        Route::delete('contents/images/{id}', [ContentController::class, 'deleteImage'])->name('contents.deleteImage');

        // CRUD Data Dosen dan Penelitian
        Route::resource('dosens', DosenController::class);
        Route::resource('qualifications', QualificationController::class);
        Route::resource('competences', CompetenceController::class);
        Route::resource('researches', ResearchController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('haki', AdminHakiController::class);
        // Route::resource('jurnal', App\Http\Controllers\Admin\JurnalController::class); // Disabled - Fitur jurnal dinonaktifkan
        Route::resource('dokumen', AdminDokumenController::class);
        Route::get('services-export', [ServiceController::class, 'export'])->name('services.export');
        Route::get('pengabdian', [AdminDashboardController::class, 'pengabdian'])->name('pengabdian');
    });
});
