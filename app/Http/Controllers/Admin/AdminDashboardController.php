<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Content;
use App\Models\Research;
use App\Models\Haki;
use App\Models\Service;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data
        $totalDosen = Dosen::count();
        $totalContent = Content::count();
        $totalResearch = Research::count();
        $totalHaki = Haki::count();

        // Status statistics (adjusted for available fields)
        $statusStats = [
            'active' => Research::whereIn('status', ['ongoing', 'submitted'])->count() + 
                       Haki::whereIn('status', ['granted', 'dipublikasi'])->count(),
            'draft' => Research::where('status', 'draft')->count() + 
                      Haki::where('status', 'draft')->count(),
            'pending' => Haki::whereIn('status', ['diajukan', 'dalam_proses'])->count() + 
                        Research::where('status', 'submitted')->count(),
        ];

        // Data grafik menggunakan model
        $dosenPerTahun = Dosen::selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('jumlah', 'tahun');

        $contentPerBulan = Content::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan');

        $researchStats = Research::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan');

        $hakiStats = Haki::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan');

        // Recent data
        $recentContent = Content::latest()->limit(5)->get();
        $recentDosen = Dosen::latest()->limit(5)->get();

        // Kirim ke view
        return view('admin.dashboard', [
            'totalDosen' => $totalDosen,
            'totalContent' => $totalContent,
            'totalResearch' => $totalResearch,
            'totalHaki' => $totalHaki,
            'statusStats' => $statusStats,
            'dosenPerTahun' => $dosenPerTahun,
            'contentPerBulan' => $contentPerBulan,
            'researchStats' => $researchStats,
            'hakiStats' => $hakiStats,
            'recentContent' => $recentContent,
            'recentDosen' => $recentDosen,
        ]);
    }

    public function dosen()
    {
        return view('admin.dosen');
    }

    public function penelitian()
    {
        return view('admin.penelitian');
    }

    public function pengabdian()
    {
        return view('admin.pengabdian');
    }
}
