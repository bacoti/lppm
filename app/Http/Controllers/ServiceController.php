<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::with('dosen');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis pengabdian
        if ($request->filled('jenis_pengabdian')) {
            $query->where('jenis_pengabdian', $request->jenis_pengabdian);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('tanggal_mulai', $request->year);
        }

        // Search by judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter by dosen
        if ($request->filled('dosen_id')) {
            $query->where('dosen_id', $request->dosen_id);
        }

        $services = $query->orderBy('created_at', 'desc')->paginate(15);

        $statusOptions = Service::getStatusOptions();
        $jenisOptions = Service::getJenisPengabdianOptions();
        $dosens = Dosen::orderBy('nama_lengkap')->get();

        return view('admin.services.index', compact(
            'services',
            'statusOptions',
            'jenisOptions',
            'dosens'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::orderBy('nama_lengkap')->get();
        $statusOptions = Service::getStatusOptions();
        $jenisOptions = Service::getJenisPengabdianOptions();
        $kepuasanOptions = Service::getTingkatKepuasanOptions();
        $proposalStatusOptions = Service::getProposalStatusOptions();

        return view('admin.services.create', compact(
            'dosens',
            'statusOptions',
            'jenisOptions',
            'kepuasanOptions',
            'proposalStatusOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(Service::validationRules());

        DB::beginTransaction();
        try {
            $service = new Service();

            // Handle file uploads
            $files = $this->handleFileUploads($request, $service);

            $service->fill(array_merge($validated, $files));
            $service->save();

            DB::commit();

            return redirect()->route('admin.services.index')
                ->with('success', 'Pengabdian masyarakat berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating service: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data pengabdian.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load('dosen');
        $timPelaksanaNames = $service->getTimPelaksanaNames();

        return view('admin.services.show', compact('service', 'timPelaksanaNames'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $dosens = Dosen::orderBy('nama_lengkap')->get();
        $statusOptions = Service::getStatusOptions();
        $jenisOptions = Service::getJenisPengabdianOptions();
        $kepuasanOptions = Service::getTingkatKepuasanOptions();
        $proposalStatusOptions = Service::getProposalStatusOptions();

        return view('admin.services.edit', compact(
            'service',
            'dosens',
            'statusOptions',
            'jenisOptions',
            'kepuasanOptions',
            'proposalStatusOptions'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate(Service::validationRules(true));

        DB::beginTransaction();
        try {
            // Handle file uploads
            $files = $this->handleFileUploads($request, $service);

            $service->fill(array_merge($validated, $files));
            $service->save();

            DB::commit();

            return redirect()->route('admin.services.index')
                ->with('success', 'Pengabdian masyarakat berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating service: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data pengabdian.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        DB::beginTransaction();
        try {
            // Delete associated files
            $this->deleteAssociatedFiles($service);

            $service->delete();

            DB::commit();

            return redirect()->route('admin.services.index')
                ->with('success', 'Pengabdian masyarakat berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting service: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat menghapus data pengabdian.');
        }
    }

    /**
     * Handle file uploads for service
     */
    private function handleFileUploads(Request $request, Service $service): array
    {
        $files = [];

        $fileFields = [
            'file_proposal',
            'file_laporan',
            'file_dokumentasi',
            'file_sertifikat',
            'file_sk'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($service->$field && Storage::disk('public')->exists($service->$field)) {
                    Storage::disk('public')->delete($service->$field);
                }

                $file = $request->file($field);
                $filename = time() . '_' . $field . '_' . $service->id . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('services', $filename, 'public');
                $files[$field] = $path;
            }
        }

        return $files;
    }

    /**
     * Delete associated files
     */
    private function deleteAssociatedFiles(Service $service): void
    {
        $fileFields = [
            'file_proposal',
            'file_laporan',
            'file_dokumentasi',
            'file_sertifikat',
            'file_sk'
        ];

        foreach ($fileFields as $field) {
            if ($service->$field && Storage::disk('public')->exists($service->$field)) {
                Storage::disk('public')->delete($service->$field);
            }
        }
    }

    /**
     * Export services data
     */
    public function export(Request $request)
    {
        $query = Service::with('dosen');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis_pengabdian')) {
            $query->where('jenis_pengabdian', $request->jenis_pengabdian);
        }

        if ($request->filled('year')) {
            $query->whereYear('tanggal_mulai', $request->year);
        }

        if ($request->filled('dosen_id')) {
            $query->where('dosen_id', $request->dosen_id);
        }

        $services = $query->orderBy('created_at', 'desc')->get();

        // Generate CSV content
        $csvContent = $this->generateCsvContent($services);

        $filename = 'pengabdian_masyarakat_' . date('Y-m-d_H-i-s') . '.csv';

        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Generate CSV content for services
     */
    private function generateCsvContent($services): string
    {
        $headers = [
            'ID',
            'Judul',
            'Dosen',
            'Bidang',
            'Jenis Pengabdian',
            'Status',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Lokasi',
            'Jumlah Dana',
            'Progress (%)'
        ];

        $rows = [$headers];

        foreach ($services as $service) {
            $rows[] = [
                $service->id,
                $service->judul,
                $service->dosen ? $service->dosen->nama_lengkap : '-',
                $service->bidang ?? '-',
                Service::getJenisPengabdianOptions()[$service->jenis_pengabdian] ?? '-',
                Service::getStatusOptions()[$service->status] ?? '-',
                $service->tanggal_mulai ? $service->tanggal_mulai->format('d/m/Y') : '-',
                $service->tanggal_selesai ? $service->tanggal_selesai->format('d/m/Y') : '-',
                $service->lokasi ?? '-',
                $service->getFormattedJumlahDana(),
                $service->progress_percentage ?? 0
            ];
        }

        $csv = '';
        foreach ($rows as $row) {
            $csv .= implode(',', array_map(function($field) {
                return '"' . str_replace('"', '""', $field) . '"';
            }, $row)) . "\n";
        }

        return $csv;
    }

    /**
     * Display pengabdian for public view
     */
    public function pengabdian(Request $request)
    {
        $search = $request->query('q');
        $tahun = $request->query('tahun');
        $jenis = $request->query('jenis');

        $query = Service::with('dosen')->latest();

        // Only show completed or ongoing services for public
        $query->whereIn('status', ['ongoing', 'completed', 'reported']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('leader_name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%")
                    ->orWhere('skema_name', 'like', "%{$search}%")
                    ->orWhere('skema_abbreviation', 'like', "%{$search}%")
                    ->orWhere('hibah_program', 'like', "%{$search}%")
                    ->orWhere('focus_area', 'like', "%{$search}%")
                    ->orWhereHas('dosen', function ($q2) use ($search) {
                        $q2->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('nidn_nip', 'like', "%{$search}%");
                    });
            });
        }

        if ($tahun) {
            $query->whereYear('tanggal_mulai', $tahun);
        }

        if ($jenis) {
            $query->where('jenis_pengabdian', $jenis);
        }

        $services = $query->paginate(9)->withQueryString();
        
        $years = Service::select(DB::raw('YEAR(tanggal_mulai) as year'))
            ->distinct()
            ->whereNotNull('tanggal_mulai')
            ->orderByDesc('year')
            ->pluck('year');

        $jenisOptions = Service::getJenisPengabdianOptions();

        return view('frontend.tridarma.pengabdian', compact('services', 'years', 'jenisOptions'));
    }

    /**
     * Display service detail for public view
     */
    public function detail(string $id)
    {
        $service = Service::with('dosen')->findOrFail($id);

        return view('frontend.tridarma.detail-pengabdian', compact('service'));
    }
}