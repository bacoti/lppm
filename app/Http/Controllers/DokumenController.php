<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::published()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dokumen.index', compact('dokumens'));
    }

    public function show($slug)
    {
        $dokumen = Dokumen::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('dokumen.show', compact('dokumen'));
    }

    public function download($slug)
    {
        $dokumen = Dokumen::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $filePath = storage_path('app/public/' . $dokumen->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $dokumen->file_name);
    }
}
