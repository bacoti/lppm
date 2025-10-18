<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Haki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HakiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Haki::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by jenis HAKI
        if ($request->filled('jenis')) {
            $query->byJenis($request->jenis);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        $hakis = $query->latest()->paginate(15)->withQueryString();

        return view('admin.haki.index', compact('hakis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisHakiOptions = Haki::getJenisHakiOptions();
        $statusOptions = Haki::getStatusOptions();

        return view('admin.haki.create', compact('jenisHakiOptions', 'statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_haki' => ['required', Rule::in(array_keys(Haki::getJenisHakiOptions()))],
            'nomor_permohonan' => 'nullable|string|max:255',
            'tahun_permohonan' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'nomor_pendaftaran' => 'nullable|string|max:255',
            'nomor_publikasi' => 'nullable|string|max:255',
            'tanggal_daftar' => 'nullable|date',
            'tanggal_publikasi' => 'nullable|date',
            'tanggal_penerimaan' => 'nullable|date',
            'tanggal_granted' => 'nullable|date',
            'status' => ['required', Rule::in(array_keys(Haki::getStatusOptions()))],
            'deskripsi' => 'nullable|string',
            'pemegang_paten' => 'nullable|string|max:255',
            'inventor' => 'required|array|min:1',
            'inventor.*' => 'required|string|max:255',
            'klasifikasi' => 'nullable|string|max:255',
            'bidang_teknologi' => 'nullable|string|max:255',
            'kantor_kekayaan_intelektual' => 'nullable|string|max:255',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'tanggal_berlaku_mulai' => 'nullable|date',
            'tanggal_berlaku_selesai' => 'nullable|date|after:tanggal_berlaku_mulai',
            'diperpanjang' => 'boolean',
            'catatan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Handle file uploads
        if ($request->hasFile('file_dokumen')) {
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('haki/dokumen', 'public');
        }

        if ($request->hasFile('file_sertifikat')) {
            $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('haki/sertifikat', 'public');
        }

        // Remove empty values from inventor array
        $validated['inventor'] = array_filter($validated['inventor']);

        Haki::create($validated);

        return redirect()->route('admin.haki.index')
            ->with('success', 'Data HAKI berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Haki $haki)
    {
        return view('admin.haki.show', compact('haki'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Haki $haki)
    {
        $jenisHakiOptions = Haki::getJenisHakiOptions();
        $statusOptions = Haki::getStatusOptions();

        return view('admin.haki.edit', compact('haki', 'jenisHakiOptions', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Haki $haki)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_haki' => ['required', Rule::in(array_keys(Haki::getJenisHakiOptions()))],
            'nomor_permohonan' => 'nullable|string|max:255',
            'tahun_permohonan' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'nomor_pendaftaran' => 'nullable|string|max:255',
            'nomor_publikasi' => 'nullable|string|max:255',
            'tanggal_daftar' => 'nullable|date',
            'tanggal_publikasi' => 'nullable|date',
            'tanggal_penerimaan' => 'nullable|date',
            'tanggal_granted' => 'nullable|date',
            'status' => ['required', Rule::in(array_keys(Haki::getStatusOptions()))],
            'deskripsi' => 'nullable|string',
            'pemegang_paten' => 'nullable|string|max:255',
            'inventor' => 'required|array|min:1',
            'inventor.*' => 'required|string|max:255',
            'klasifikasi' => 'nullable|string|max:255',
            'bidang_teknologi' => 'nullable|string|max:255',
            'kantor_kekayaan_intelektual' => 'nullable|string|max:255',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'tanggal_berlaku_mulai' => 'nullable|date',
            'tanggal_berlaku_selesai' => 'nullable|date|after:tanggal_berlaku_mulai',
            'diperpanjang' => 'boolean',
            'catatan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Handle file uploads
        if ($request->hasFile('file_dokumen')) {
            // Delete old file if exists
            if ($haki->file_dokumen) {
                Storage::disk('public')->delete($haki->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('haki/dokumen', 'public');
        }

        if ($request->hasFile('file_sertifikat')) {
            // Delete old file if exists
            if ($haki->file_sertifikat) {
                Storage::disk('public')->delete($haki->file_sertifikat);
            }
            $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('haki/sertifikat', 'public');
        }

        // Remove empty values from inventor array
        $validated['inventor'] = array_filter($validated['inventor']);

        $haki->update($validated);

        return redirect()->route('admin.haki.index')
            ->with('success', 'Data HAKI berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Haki $haki)
    {
        // Delete associated files
        if ($haki->file_dokumen) {
            Storage::disk('public')->delete($haki->file_dokumen);
        }

        if ($haki->file_sertifikat) {
            Storage::disk('public')->delete($haki->file_sertifikat);
        }

        $haki->delete();

        return redirect()->route('admin.haki.index')
            ->with('success', 'Data HAKI berhasil dihapus.');
    }
}
