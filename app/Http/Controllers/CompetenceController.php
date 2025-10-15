<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Competence::with('dosen');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('dosen', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nidn_nip', 'like', "%{$search}%");
            })->orWhere('keahlian_bidang', 'like', "%{$search}%")
                ->orWhere('metodologi_pengajaran', 'like', "%{$search}%")
                ->orWhere('sertifikat_pendidik', 'like', "%{$search}%")
                ->orWhere('status_sertifikasi', 'like', "%{$search}%");
        }

        // Filter by status sertifikasi
        if ($request->filled('status')) {
            $query->where('status_sertifikasi', $request->status);
        }

        // Filter by certification status
        if ($request->filled('certified')) {
            if ($request->certified === 'active') {
                $query->where('status_sertifikasi', 'aktif');
            } elseif ($request->certified === 'inactive') {
                $query->where('status_sertifikasi', 'tidak_aktif');
            }
        }

        $competences = $query->paginate(10)->withQueryString();

        return view('admin.competences.index', compact('competences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(Competence::validationRules());

        Competence::create($validated);

        return redirect()->route('admin.competences.index')
            ->with('success', 'Kompetensi dosen berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all();
        return view('admin.competences.create', compact('dosens'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        $competence->load('dosen');
        return view('admin.competences.show', compact('competence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        return view('admin.competences.edit', compact('competence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competence $competence)
    {
        $validated = $request->validate(Competence::validationRules());

        // Update the model with validated data
        $competence->update($validated);

        return redirect()
            ->route('admin.competences.index')
            ->with('success', 'Data kompetensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        try {
            $competence->delete();
            return redirect()->route('admin.competences.index')
                ->with('success', 'Data kompetensi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.competences.index')
                ->with('error', 'Gagal menghapus data kompetensi');
        }
    }

    /**
     * Get competence statistics
     */
    public function getStatistics()
    {
        $stats = [
            'total' => Competence::count(),
            'certified' => Competence::where('status_sertifikasi', 'aktif')->count(),
            'pending' => Competence::where('status_sertifikasi', 'proses_perpanjangan')->count(),
            'inactive' => Competence::where('status_sertifikasi', 'tidak_aktif')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Frontend competence listing
     */
    public function kompetensi(Request $request)
    {
        $query = $request->query('q', '');
        $status = $request->query('status', '');

        $competences = Competence::with('dosen')
            ->when($query, function ($q) use ($query) {
                $q->whereHas('dosen', function ($d) use ($query) {
                    $d->where('nama_lengkap', 'like', "%{$query}%")
                        ->orWhere('nidn_nip', 'like', "%{$query}%");
                })
                    ->orWhere('keahlian_bidang', 'like', "%{$query}%")
                    ->orWhere('metodologi_pengajaran', 'like', "%{$query}%")
                    ->orWhere('sertifikat_pendidik', 'like', "%{$query}%");
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status_sertifikasi', $status);
            })
            ->paginate(6)
            ->withQueryString();

        return view('frontend.pangkalan.kompetensi', compact('competences', 'query', 'status'));
    }
}
