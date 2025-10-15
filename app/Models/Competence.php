<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Competence extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceFactory> */
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        // Kompetensi Pedagogik
        'metodologi_pengajaran',
        'teknik_evaluasi',
        'manajemen_kelas',
        'teknologi_pembelajaran',
        'pengembangan_kurikulum',
        // Kompetensi Profesional
        'keahlian_bidang',
        'penelitian_terapan',
        'publikasi_ilmiah',
        'kolaborasi_industri',
        'update_pengetahuan',
        // Kompetensi Sosial
        'komunikasi_efektif',
        'kerjasama_tim',
        'kepemimpinan',
        'adaptasi_budaya',
        'etika_profesi',
        // Sertifikasi dan Kompetensi Formal
        'sertifikat_pendidik',
        'tanggal_sertifikat',
        'sertifikasi_lain',
        'pelatihan_kompetensi',
        'status_sertifikasi',
    ];

    protected $casts = [
        'tanggal_sertifikat' => 'date',
    ];

    /**
     * Validation rules for competence data
     */
    public static function validationRules(): array
    {
        return [
            'dosen_id' => 'required|exists:dosens,id',
            
            // Kompetensi Pedagogik
            'metodologi_pengajaran' => 'nullable|string|max:1000',
            'teknik_evaluasi' => 'nullable|string|max:1000',
            'manajemen_kelas' => 'nullable|string|max:1000',
            'teknologi_pembelajaran' => 'nullable|string|max:1000',
            'pengembangan_kurikulum' => 'nullable|string|max:1000',
            
            // Kompetensi Profesional
            'keahlian_bidang' => 'nullable|string|max:1000',
            'penelitian_terapan' => 'nullable|string|max:1000',
            'publikasi_ilmiah' => 'nullable|string|max:1000',
            'kolaborasi_industri' => 'nullable|string|max:1000',
            'update_pengetahuan' => 'nullable|string|max:1000',
            
            // Kompetensi Sosial
            'komunikasi_efektif' => 'nullable|string|max:1000',
            'kerjasama_tim' => 'nullable|string|max:1000',
            'kepemimpinan' => 'nullable|string|max:1000',
            'adaptasi_budaya' => 'nullable|string|max:1000',
            'etika_profesi' => 'nullable|string|max:1000',
            
            // Sertifikasi
            'sertifikat_pendidik' => 'nullable|string|max:255',
            'tanggal_sertifikat' => 'nullable|date',
            'sertifikasi_lain' => 'nullable|string|max:1000',
            'pelatihan_kompetensi' => 'nullable|string|max:1000',
            'status_sertifikasi' => 'required|in:aktif,tidak_aktif,proses_perpanjangan',
        ];
    }

    /**
     * Get status sertifikasi options
     */
    public static function getStatusSertifikasiOptions(): array
    {
        return [
            'aktif' => 'Aktif',
            'tidak_aktif' => 'Tidak Aktif',
            'proses_perpanjangan' => 'Proses Perpanjangan',
        ];
    }

    /**
     * Check if dosen has active certification
     */
    public function hasActiveCertification(): bool
    {
        return $this->status_sertifikasi === 'aktif';
    }

    /**
     * Get competency categories with their fields
     */
    public static function getCompetencyCategories(): array
    {
        return [
            'pedagogik' => [
                'title' => 'Kompetensi Pedagogik',
                'description' => 'Kemampuan mengelola pembelajaran peserta didik',
                'fields' => [
                    'metodologi_pengajaran' => 'Metodologi Pengajaran',
                    'teknik_evaluasi' => 'Teknik Evaluasi',
                    'manajemen_kelas' => 'Manajemen Kelas',
                    'teknologi_pembelajaran' => 'Teknologi Pembelajaran',
                    'pengembangan_kurikulum' => 'Pengembangan Kurikulum',
                ]
            ],
            'profesional' => [
                'title' => 'Kompetensi Profesional',
                'description' => 'Kemampuan penguasaan materi pembelajaran secara luas dan mendalam',
                'fields' => [
                    'keahlian_bidang' => 'Keahlian Bidang',
                    'penelitian_terapan' => 'Penelitian Terapan',
                    'publikasi_ilmiah' => 'Publikasi Ilmiah',
                    'kolaborasi_industri' => 'Kolaborasi Industri',
                    'update_pengetahuan' => 'Update Pengetahuan',
                ]
            ],
            'sosial' => [
                'title' => 'Kompetensi Sosial',
                'description' => 'Kemampuan berkomunikasi dan bergaul secara efektif',
                'fields' => [
                    'komunikasi_efektif' => 'Komunikasi Efektif',
                    'kerjasama_tim' => 'Kerjasama Tim',
                    'kepemimpinan' => 'Kepemimpinan',
                    'adaptasi_budaya' => 'Adaptasi Budaya',
                    'etika_profesi' => 'Etika Profesi',
                ]
            ],
            'sertifikasi' => [
                'title' => 'Sertifikasi dan Kompetensi Formal',
                'description' => 'Sertifikasi dan pelatihan formal yang dimiliki',
                'fields' => [
                    'sertifikat_pendidik' => 'Sertifikat Pendidik',
                    'tanggal_sertifikat' => 'Tanggal Sertifikat',
                    'sertifikasi_lain' => 'Sertifikasi Lain',
                    'pelatihan_kompetensi' => 'Pelatihan Kompetensi',
                    'status_sertifikasi' => 'Status Sertifikasi',
                ]
            ],
        ];
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
}
