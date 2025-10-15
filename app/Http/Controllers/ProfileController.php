<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $dosens = Dosen::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nama_lengkap', 'like', "%{$query}%")
                    ->orWhere('nidn_nip', 'like', "%{$query}%");
            }, function ($q) {
                $q->latest();
            })
            ->paginate(4);

        return view('frontend.pangkalan.profil', compact('dosens', 'query'));
    }
}
