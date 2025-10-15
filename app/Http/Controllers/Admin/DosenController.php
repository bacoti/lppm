<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dosen::query()->latest();

        // If search query exists, apply filter
        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nidn_nip', 'like', "%{$search}%")
                    ->orWhere('gelar_akademik', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%");
            });
        }

        // Paginate results (10 per page) and keep query string for pagination links
        $dosens = $query->paginate(10)->withQueryString();

        return view('admin.dosens.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dosens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn_nip' => 'required|string|unique:dosens,nidn_nip|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gelar_akademik' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date|before:today',
            'tempat_lahir' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string|max:500',
        ], [
            'nidn_nip.required' => 'NIDN/NIP wajib diisi.',
            'nidn_nip.unique' => 'NIDN/NIP sudah terdaftar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        ]);

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('dosens', 'public');
            $validated['photo'] = $path;
        }

        try {
            Dosen::create($validated);
            return redirect()->route('admin.dosens.index')
                ->with('success', 'Data dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /** @var Dosen $dosen */
        $dosen = Dosen::findOrFail($id);

        return view('admin.dosens.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /** @var Dosen $dosen */
        $dosen = Dosen::findOrFail($id);

        return view('admin.dosens.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gelar_akademik' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date|before:today',
            'tempat_lahir' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string|max:500',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        ]);

        $dosen = Dosen::findOrFail($id);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($dosen->photo && Storage::disk('public')->exists($dosen->photo)) {
                Storage::disk('public')->delete($dosen->photo);
            }

            // Store new photo
            $path = $request->file('photo')->store('dosens', 'public');
            $validated['photo'] = $path;
        }

        try {
            $dosen->update($validated);
            return redirect()->route('admin.dosens.index')
                ->with('success', 'Data dosen berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Dosen::destroy($id);

        return redirect()->route('admin.dosens.index')->with('success', 'Data dosen berhasil dihapus.');

    }
}
