<?php

namespace App\Http\Controllers;

use App\Models\Haki;
use Illuminate\Http\Request;

class HakiController extends Controller
{
    /**
     * Display a listing of HAKI for public
     */
    public function index(Request $request)
    {
        $query = Haki::query();

        // Search functionality
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('bidang_teknologi', 'like', "%{$search}%")
                  ->orWhere('nomor_permohonan', 'like', "%{$search}%")
                  ->orWhere('tahun_permohonan', 'like', "%{$search}%")
                  ->orWhere('pemegang_paten', 'like', "%{$search}%")
                  ->orWhereJsonContains('inventor', $search);
            });
        }

        // Filter by jenis HAKI
        if ($request->filled('jenis')) {
            $query->where('jenis_haki', $request->jenis);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get HAKI list with pagination
        $hakis = $query->latest()->paginate(12);

        // Calculate statistics
        $statistics = [
            'paten' => Haki::where('jenis_haki', 'paten')->count(),
            'hak_cipta' => Haki::where('jenis_haki', 'hak_cipta')->count(),
            'merek' => Haki::where('jenis_haki', 'merek')->count(),
            'desain_industri' => Haki::where('jenis_haki', 'desain_industri')->count(),
        ];

        // Get options for filters
        $jenisOptions = Haki::getJenisHakiOptions();
        $statusOptions = Haki::getStatusOptions();

        return view('frontend.haki.index', compact('hakis', 'statistics', 'jenisOptions', 'statusOptions'));
    }

    /**
     * Display the specified HAKI
     */
    public function show(Haki $haki)
    {
        // Get related HAKI (same jenis_haki or bidang_teknologi)
        $relatedHakis = Haki::where('id', '!=', $haki->id)
            ->where(function($query) use ($haki) {
                $query->where('jenis_haki', $haki->jenis_haki)
                      ->orWhere('bidang_teknologi', $haki->bidang_teknologi);
            })
            ->latest()
            ->limit(5)
            ->get();

        // Get next HAKI for navigation
        $nextHaki = Haki::where('id', '>', $haki->id)->first();

        return view('frontend.haki.show', compact('haki', 'relatedHakis', 'nextHaki'));
    }
}
