<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    /**
     * Display a listing of journals
     */
    public function index(Request $request)
    {
        $query = Jurnal::published();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('nama_jurnal', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }

        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis_jurnal', $request->jenis);
        }

        // Filter by tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Filter by akreditasi
        if ($request->filled('akreditasi')) {
            $query->where('akreditasi', $request->akreditasi);
        }

        $jurnals = $query->latest('tanggal_publikasi')->paginate(12);

        // Get filter options
        $tahunOptions = Jurnal::published()
            ->whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $jenisOptions = Jurnal::getJenisJurnalOptions();
        $akreditasiOptions = Jurnal::getAkreditasiOptions();

        // Get featured journals
        $featuredJurnals = Jurnal::published()
            ->featured()
            ->latest('tanggal_publikasi')
            ->limit(3)
            ->get();

        // Statistics
        $totalJurnals = Jurnal::published()->count();

        return view('jurnal.index', compact(
            'jurnals',
            'featuredJurnals',
            'totalJurnals'
        ));
    }

    /**
     * Display the specified journal
     */
    public function show(Jurnal $jurnal)
    {
        // Only show published journals
        if ($jurnal->status !== 'published') {
            abort(404);
        }

        // Increment view count
        $jurnal->incrementViews();

        // Get related journals
        $relatedJurnals = Jurnal::published()
            ->where('id', '!=', $jurnal->id)
            ->where(function ($query) use ($jurnal) {
                $query->where('jenis_jurnal', $jurnal->jenis_jurnal)
                      ->orWhere('nama_jurnal', $jurnal->nama_jurnal);
            })
            ->latest('tanggal_publikasi')
            ->limit(4)
            ->get();

        return view('jurnal.show', compact('jurnal', 'relatedJurnals'));
    }

    /**
     * Download PDF file
     */
    public function download(Jurnal $jurnal)
    {
        // Only allow download for published journals
        if ($jurnal->status !== 'published' || !$jurnal->file_pdf) {
            abort(404);
        }

        // Increment download count
        $jurnal->incrementDownloads();

        $filePath = storage_path('app/public/' . $jurnal->file_pdf);

        if (!file_exists($filePath)) {
            abort(404);
        }

        $fileName = $jurnal->slug . '.pdf';

        return Response::download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
