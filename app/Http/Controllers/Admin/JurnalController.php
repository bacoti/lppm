<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jurnal::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('nama_jurnal', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%")
                  ->orWhere('issn', 'like', "%{$search}%");
            });
        }

        // Filter by jenis
        if ($request->filled('jenis_jurnal')) {
            $query->where('jenis_jurnal', $request->jenis_jurnal);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $jurnals = $query->latest()->paginate(15);

        return view('admin.jurnal.index', compact('jurnals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurnal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:500',
            'deskripsi' => 'nullable|string|max:2000',
            'nama_jurnal' => 'required|string|max:255',
            'issn' => 'nullable|string|max:20',
            'e_issn' => 'nullable|string|max:20',
            'penerbit' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:50',
            'nomor' => 'nullable|string|max:50',
            'halaman' => 'nullable|string|max:50',
            'tanggal_publikasi' => 'nullable|date',
            'tahun' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'doi' => 'nullable|string|max:255',
            'url_jurnal' => 'nullable|url|max:500',
            'jenis_jurnal' => 'required|in:nasional,internasional',
            'status' => 'required|in:published,in_press,accepted,submitted,draft',
            'penulis' => 'required|array|min:1',
            'penulis.*' => 'required|string|max:255',
            'kata_kunci' => 'nullable|array',
            'kata_kunci.*' => 'string|max:100',
            'bahasa' => 'required|in:id,en',
            'abstrak' => 'nullable|string|max:5000',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240', // 10MB
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB
            'is_featured' => 'nullable|boolean',
            'akreditasi' => 'nullable|in:sinta_1,sinta_2,sinta_3,sinta_4,sinta_5,sinta_6,scopus,wos,non_sinta',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        // Handle file uploads
        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('jurnal/pdf', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('jurnal/covers', 'public');
        }

        // Set is_featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Create jurnal
        Jurnal::create($validated);

        return redirect()->route('admin.jurnal.index')
            ->with('success', 'Jurnal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurnal $jurnal)
    {
        return view('admin.jurnal.show', compact('jurnal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurnal $jurnal)
    {
        return view('admin.jurnal.edit', compact('jurnal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:500',
            'deskripsi' => 'nullable|string|max:2000',
            'nama_jurnal' => 'required|string|max:255',
            'issn' => 'nullable|string|max:20',
            'e_issn' => 'nullable|string|max:20',
            'penerbit' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:50',
            'nomor' => 'nullable|string|max:50',
            'halaman' => 'nullable|string|max:50',
            'tanggal_publikasi' => 'nullable|date',
            'tahun' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'doi' => 'nullable|string|max:255',
            'url_jurnal' => 'nullable|url|max:500',
            'jenis_jurnal' => 'required|in:nasional,internasional',
            'status' => 'required|in:published,in_press,accepted,submitted,draft',
            'penulis' => 'required|array|min:1',
            'penulis.*' => 'required|string|max:255',
            'kata_kunci' => 'nullable|array',
            'kata_kunci.*' => 'string|max:100',
            'bahasa' => 'required|in:id,en',
            'abstrak' => 'nullable|string|max:5000',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_featured' => 'nullable|boolean',
            'akreditasi' => 'nullable|in:sinta_1,sinta_2,sinta_3,sinta_4,sinta_5,sinta_6,scopus,wos,non_sinta',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        // Handle file uploads
        if ($request->hasFile('file_pdf')) {
            // Delete old file
            if ($jurnal->file_pdf) {
                Storage::disk('public')->delete($jurnal->file_pdf);
            }
            $validated['file_pdf'] = $request->file('file_pdf')->store('jurnal/pdf', 'public');
        }

        if ($request->hasFile('cover_image')) {
            // Delete old file
            if ($jurnal->cover_image) {
                Storage::disk('public')->delete($jurnal->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('jurnal/covers', 'public');
        }

        // Set is_featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Update jurnal
        $jurnal->update($validated);

        return redirect()->route('admin.jurnal.index')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurnal $jurnal)
    {
        // Delete associated files
        if ($jurnal->file_pdf) {
            Storage::disk('public')->delete($jurnal->file_pdf);
        }
        if ($jurnal->cover_image) {
            Storage::disk('public')->delete($jurnal->cover_image);
        }

        $jurnal->delete();

        return redirect()->route('admin.jurnal.index')
            ->with('success', 'Jurnal berhasil dihapus.');
    }
}
