<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Qualification::with('dosen');

        // Enhanced search functionality
        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('dosen', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nidn_nip', 'like', "%{$search}%");
            })->orWhere('bidang_keilmuan', 'like', "%{$search}%")
                ->orWhere('jenjang_pendidikan', 'like', "%{$search}%")
                ->orWhere('nama_perguruan_tinggi', 'like', "%{$search}%")
                ->orWhere('gelar_diperoleh', 'like', "%{$search}%")
                ->orWhere('bidang_penelitian_utama', 'like', "%{$search}%");
        }

        // Filter by jenjang pendidikan
        if ($request->filled('jenjang')) {
            $query->where('jenjang_pendidikan', $request->jenjang);
        }

        // Filter by jabatan fungsional
        if ($request->filled('jabatan_fungsional')) {
            $query->where('jabatan_fungsional', $request->jabatan_fungsional);
        }

        // Filter by status sertifikasi
        if ($request->filled('status_sertifikasi')) {
            $query->where('status_sertifikasi', $request->status_sertifikasi);
        }

        $qualifications = $query->paginate(10)->withQueryString();

        return view('admin.qualifications.index', compact('qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            
            // Data Pendidikan
            'riwayat_pendidikan' => 'nullable|string|max:1000',
            'gelar_diperoleh' => 'nullable|string|max:100',
            'jenjang_pendidikan' => 'nullable|in:D3,D4/S1,S2,S3,Profesi',
            'nama_perguruan_tinggi' => 'nullable|string|max:255',
            'status_pt' => 'nullable|in:Negeri,Swasta,Kedinasan',
            'akreditasi_pt' => 'nullable|in:Unggul,Baik Sekali,Baik,A,B,C',
            'bidang_keilmuan' => 'nullable|string|max:255',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'tahun_lulus' => 'nullable|digits:4|integer|min:1950|max:' . (date('Y') + 5),
            'status_kelulusan' => 'nullable|in:Lulus,Dalam Proses',
            
            // Jabatan & Karir
            'jabatan' => 'nullable|string|max:255',
            'jabatan_fungsional' => 'nullable|in:Tenaga Pengajar,Asisten Ahli,Lektor,Lektor Kepala,Profesor',
            
            // Sertifikasi Pendidik
            'nomor_sertifikat_pendidik' => 'nullable|string|max:50',
            'tahun_sertifikasi' => 'nullable|digits:4|integer|min:2000|max:' . date('Y'),
            'status_sertifikasi' => 'nullable|in:Sudah,Belum,Dalam Proses',
            
            // Data Penelitian
            'bidang_penelitian_utama' => 'nullable|string|max:255',
            'h_index' => 'nullable|integer|min:0',
            'publikasi_scopus' => 'nullable|integer|min:0',
        ], [
            // Custom error messages
            'dosen_id.required' => 'Pilih dosen terlebih dahulu.',
            'dosen_id.exists' => 'Dosen yang dipilih tidak valid.',
            
            'jenjang_pendidikan.in' => 'Jenjang pendidikan tidak valid.',
            'nama_perguruan_tinggi.max' => 'Nama perguruan tinggi maksimal 255 karakter.',
            'status_pt.in' => 'Status perguruan tinggi tidak valid.',
            'akreditasi_pt.in' => 'Akreditasi perguruan tinggi tidak valid.',
            'bidang_keilmuan.max' => 'Bidang keilmuan maksimal 255 karakter.',
            
            'ipk.numeric' => 'IPK harus berupa angka.',
            'ipk.min' => 'IPK minimal 0.',
            'ipk.max' => 'IPK maksimal 4.',
            'tahun_lulus.digits' => 'Tahun lulus harus 4 digit.',
            'tahun_lulus.min' => 'Tahun lulus minimal 1950.',
            'tahun_lulus.max' => 'Tahun lulus maksimal ' . (date('Y') + 5) . '.',
            'status_kelulusan.in' => 'Status kelulusan tidak valid.',
            
            'jabatan_fungsional.in' => 'Jabatan fungsional tidak valid.',
            
            'nomor_sertifikat_pendidik.max' => 'Nomor sertifikat pendidik maksimal 50 karakter.',
            'tahun_sertifikasi.digits' => 'Tahun sertifikasi harus 4 digit.',
            'tahun_sertifikasi.min' => 'Tahun sertifikasi minimal 2000.',
            'tahun_sertifikasi.max' => 'Tahun sertifikasi maksimal ' . date('Y') . '.',
            'status_sertifikasi.in' => 'Status sertifikasi tidak valid.',
            
            'bidang_penelitian_utama.max' => 'Bidang penelitian utama maksimal 255 karakter.',
            'h_index.integer' => 'H-Index harus berupa angka.',
            'h_index.min' => 'H-Index minimal 0.',
            'publikasi_scopus.integer' => 'Publikasi Scopus harus berupa angka.',
            'publikasi_scopus.min' => 'Publikasi Scopus minimal 0.',
        ]);

        try {
            Qualification::create($validated);
            
            return redirect()->route('admin.qualifications.index')
                ->with('success', 'Data kualifikasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all();
        return view('admin.qualifications.create', compact('dosens'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Qualification $qualification)
    {
        $qualification->load('dosen');
        return view('admin.qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualification $qualification)
    {
        return view('admin.qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qualification $qualification)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            
            // Data Pendidikan
            'riwayat_pendidikan' => 'nullable|string|max:1000',
            'gelar_diperoleh' => 'nullable|string|max:100',
            'jenjang_pendidikan' => 'nullable|in:D3,D4/S1,S2,S3,Profesi',
            'nama_perguruan_tinggi' => 'nullable|string|max:255',
            'status_pt' => 'nullable|in:Negeri,Swasta,Kedinasan',
            'akreditasi_pt' => 'nullable|in:Unggul,Baik Sekali,Baik,A,B,C',
            'bidang_keilmuan' => 'nullable|string|max:255',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'tahun_lulus' => 'nullable|digits:4|integer|min:1950|max:' . (date('Y') + 5),
            'status_kelulusan' => 'nullable|in:Lulus,Dalam Proses',
            
            // Jabatan & Karir
            'jabatan' => 'nullable|string|max:255',
            'jabatan_fungsional' => 'nullable|in:Tenaga Pengajar,Asisten Ahli,Lektor,Lektor Kepala,Profesor',
            
            // Sertifikasi Pendidik
            'nomor_sertifikat_pendidik' => 'nullable|string|max:50',
            'tahun_sertifikasi' => 'nullable|digits:4|integer|min:2000|max:' . date('Y'),
            'status_sertifikasi' => 'nullable|in:Sudah,Belum,Dalam Proses',
            
            // Data Penelitian
            'bidang_penelitian_utama' => 'nullable|string|max:255',
            'h_index' => 'nullable|integer|min:0',
            'publikasi_scopus' => 'nullable|integer|min:0',
        ], [
            // Custom error messages
            'dosen_id.required' => 'Pilih dosen terlebih dahulu.',
            'dosen_id.exists' => 'Dosen yang dipilih tidak valid.',
            
            'jenjang_pendidikan.in' => 'Jenjang pendidikan tidak valid.',
            'nama_perguruan_tinggi.max' => 'Nama perguruan tinggi maksimal 255 karakter.',
            'status_pt.in' => 'Status perguruan tinggi tidak valid.',
            'akreditasi_pt.in' => 'Akreditasi perguruan tinggi tidak valid.',
            'bidang_keilmuan.max' => 'Bidang keilmuan maksimal 255 karakter.',
            
            'ipk.numeric' => 'IPK harus berupa angka.',
            'ipk.min' => 'IPK minimal 0.',
            'ipk.max' => 'IPK maksimal 4.',
            'tahun_lulus.digits' => 'Tahun lulus harus 4 digit.',
            'tahun_lulus.min' => 'Tahun lulus minimal 1950.',
            'tahun_lulus.max' => 'Tahun lulus maksimal ' . (date('Y') + 5) . '.',
            'status_kelulusan.in' => 'Status kelulusan tidak valid.',
            
            'jabatan_fungsional.in' => 'Jabatan fungsional tidak valid.',
            
            'nomor_sertifikat_pendidik.max' => 'Nomor sertifikat pendidik maksimal 50 karakter.',
            'tahun_sertifikasi.digits' => 'Tahun sertifikasi harus 4 digit.',
            'tahun_sertifikasi.min' => 'Tahun sertifikasi minimal 2000.',
            'tahun_sertifikasi.max' => 'Tahun sertifikasi maksimal ' . date('Y') . '.',
            'status_sertifikasi.in' => 'Status sertifikasi tidak valid.',
            
            'bidang_penelitian_utama.max' => 'Bidang penelitian utama maksimal 255 karakter.',
            'h_index.integer' => 'H-Index harus berupa angka.',
            'h_index.min' => 'H-Index minimal 0.',
            'publikasi_scopus.integer' => 'Publikasi Scopus harus berupa angka.',
            'publikasi_scopus.min' => 'Publikasi Scopus minimal 0.',
        ]);

        try {
            $qualification->update($validated);
            
            return redirect()->route('admin.qualifications.index')
                ->with('success', 'Data kualifikasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        try {
            $dosenName = $qualification->dosen->nama_lengkap;
            $qualification->delete();
            
            return redirect()->route('admin.qualifications.index')
                ->with('success', "Data kualifikasi {$dosenName} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    public function kualifikasi(Request $request)
    {
        $query = $request->query('q');

        $qualifications = Qualification::with('dosen')
            ->when($query, function ($q) use ($query) {
                $q->whereHas('dosen', function ($d) use ($query) {
                    $d->where('nama_lengkap', 'like', "%{$query}%")
                        ->orWhere('nidn_nip', 'like', "%{$query}%");
                })
                    ->orWhere('bidang_keilmuan', 'like', "%{$query}%")
                    ->orWhere('jenjang_pendidikan', 'like', "%{$query}%");
            })
            ->paginate(6);

        return view('frontend.pangkalan.kualifikasi', compact('qualifications', 'query'));
    }
}
