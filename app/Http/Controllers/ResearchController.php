<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Research::with('dosen')->latest();

        // Search functionality
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('bidang', 'like', "%{$search}%")
                    ->orWhere('sumber_dana', 'like', "%{$search}%")
                    ->orWhere('luaran', 'like', "%{$search}%")
                    ->orWhere('keywords', 'like', "%{$search}%")
                    ->orWhere('ketua_peneliti', 'like', "%{$search}%")
                    ->orWhere('jurnal_conference', 'like', "%{$search}%")
                    ->orWhereHas('dosen', function ($dosenQuery) use ($search) {
                        $dosenQuery->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('nidn_nip', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by year
        if ($request->filled('tahun') && $request->tahun !== 'all') {
            $query->where('tahun', $request->tahun);
        }

        // Filter by kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Filter by proposal status
        if ($request->filled('proposal_status') && $request->proposal_status !== 'all') {
            $query->where('proposal_status', $request->proposal_status);
        }

        // Filter by tingkat
        if ($request->filled('tingkat') && $request->tingkat !== 'all') {
            $query->where('tingkat', $request->tingkat);
        }

        // Filter by hibah kompetitif
        if ($request->filled('hibah_kompetitif')) {
            $query->where('hibah_kompetitif', $request->boolean('hibah_kompetitif'));
        }

        $researches = $query->paginate(10)->withQueryString();

        // Get filter options
        $statusOptions = Research::getStatusOptions();
        $kategoriOptions = Research::getKategoriOptions();
        $tingkatOptions = Research::getTingkatOptions();
        $years = Research::select('tahun')
            ->distinct()
            ->whereNotNull('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.researches.index', compact(
            'researches',
            'statusOptions',
            'kategoriOptions',
            'tingkatOptions',
            'years'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dosens = Dosen::all();
        return view('admin.researches.create', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(Research::validationRules());

        // Handle file uploads
        $files = $this->handleFileUploads($request);

        $validated = array_merge($validated, $files);

        // Set default status if not provided
        if (!isset($validated['status'])) {
            $validated['status'] = 'draft';
        }

        Research::create($validated);

        return redirect()
            ->route('admin.researches.index')
            ->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Research $research)
    {
        return view('admin.researches.show', compact('research'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Research $research)
    {
        $dosens = Dosen::all();
        return view('admin.researches.edit', compact('research', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Research $research)
    {
        $validated = $request->validate(Research::validationRules(true));

        // Handle file uploads
        $files = $this->handleFileUploads($request, $research);

        $validated = array_merge($validated, $files);

        $research->update($validated);

        return redirect()
            ->route('admin.researches.index')
            ->with('success', 'Data penelitian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Research $research)
    {
        // Delete all associated files
        $this->deleteResearchFiles($research);

        // Delete the record
        $research->delete();

        return redirect()
            ->route('admin.researches.index')
            ->with('success', 'Data penelitian berhasil dihapus.');
    }

    /**
     * Handle file uploads for research
     */
    private function handleFileUploads(Request $request, Research $research = null): array
    {
        $files = [];
        $fileFields = [
            'file_laporan',
            'file_sk',
            'file_proposal',
            'file_progress_report',
            'file_final_report'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($research && $research->$field && Storage::disk('public')->exists($research->$field)) {
                    Storage::disk('public')->delete($research->$field);
                }

                // Store new file
                $files[$field] = $request->file($field)->store('penelitian', 'public');
            }
        }

        return $files;
    }

    /**
     * Delete all files associated with a research
     */
    private function deleteResearchFiles(Research $research): void
    {
        $fileFields = [
            'file_laporan',
            'file_sk',
            'file_proposal',
            'file_progress_report',
            'file_final_report'
        ];

        foreach ($fileFields as $field) {
            if ($research->$field && Storage::disk('public')->exists($research->$field)) {
                Storage::disk('public')->delete($research->$field);
            }
        }
    }

    public function penelitian(Request $request)
    {
        $search = $request->query('q');
        $tahun  = $request->query('tahun');
        $proposal_status = $request->query('proposal_status');

        $query = Research::with('dosen')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('ketua_peneliti', 'like', "%{$search}%")
                    ->orWhere('nidn_leader', 'like', "%{$search}%")
                    ->orWhere('leader_name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%")
                    ->orWhere('skema', 'like', "%{$search}%")
                    ->orWhere('bidang', 'like', "%{$search}%")
                    ->orWhere('sumber_dana', 'like', "%{$search}%")
                    ->orWhere('luaran', 'like', "%{$search}%")
                    ->orWhere('keywords', 'like', "%{$search}%")
                    ->orWhere('jurnal_conference', 'like', "%{$search}%")
                    ->orWhereHas('dosen', function ($q2) use ($search) {
                        $q2->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('nidn_nip', 'like', "%{$search}%");
                    });
            });
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        if ($proposal_status) {
            $query->where('proposal_status', $proposal_status);
        }

        $researches = $query->paginate(9)->withQueryString();
        $years = Research::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('frontend.tridarma.penelitian', compact('researches', 'years'));

    }

    public function detail(string $id)
    {
        // Eager load dosen agar tidak N+1
        $research = Research::with('dosen')->findOrFail($id);

        return view('frontend.tridarma.detail-penelitian', compact('research'));
    }

}
