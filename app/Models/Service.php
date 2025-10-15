<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'dosen_id',
        // Informasi Dasar
        'judul',
        'deskripsi',
        'bidang',
        'jenis_pengabdian',
        // Status dan Progress
        'status',
        'progress_percentage',
        // Tim Pelaksana
        'ketua_pengabdian',
        'tim_pelaksana',
        'anggota_eksternal',
        'mitra_kerjasama',
        // Waktu Pelaksanaan
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_target_selesai',
        'durasi_hari',
        // Lokasi dan Sasaran
        'lokasi',
        'alamat_lengkap',
        'kelompok_sasaran',
        'jumlah_peserta',
        'kriteria_peserta',
        // Pendanaan
        'sumber_dana',
        'jumlah_dana',
        'hibah_kompetitif',
        // Output dan Dampak
        'tujuan',
        'luaran',
        'dampak_manfaat',
        'indikator_keberhasilan',
        'kendala_hambatan',
        // Dokumentasi
        'file_proposal',
        'file_laporan',
        'file_dokumentasi',
        'file_sertifikat',
        'link_dokumentasi',
        // SK dan Administrasi
        'nomor_sk',
        'tanggal_sk',
        'file_sk',
        // Evaluasi
        'evaluasi_kegiatan',
        'tingkat_kepuasan',
        'rekomendasi',
    ];

    protected $casts = [
        'tim_pelaksana' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_target_selesai' => 'date',
        'tanggal_sk' => 'date',
        'hibah_kompetitif' => 'boolean',
        'progress_percentage' => 'integer',
        'jumlah_peserta' => 'integer',
        'durasi_hari' => 'integer',
        'jumlah_dana' => 'decimal:2',
    ];

    /**
     * Validation rules for service data
     */
    public static function validationRules($isUpdate = false): array
    {
        $rules = [
            'dosen_id' => 'nullable|exists:dosens,id',
            'judul' => 'required|string|max:500',
            'deskripsi' => 'nullable|string|max:2000',
            'bidang' => 'nullable|string|max:255',
            'jenis_pengabdian' => 'nullable|in:pengabdian_masyarakat,pengembangan_masyarakat,pemberdayaan_masyarakat,kemitraan,lainnya',

            // Status dan Progress
            'status' => 'required|in:draft,submitted,approved,ongoing,completed,reported,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',

            // Tim Pelaksana
            'ketua_pengabdian' => 'nullable|string|max:255',
            'tim_pelaksana' => 'nullable|array',
            'tim_pelaksana.*' => 'exists:dosens,id',
            'anggota_eksternal' => 'nullable|string|max:1000',
            'mitra_kerjasama' => 'nullable|string|max:500',

            // Waktu Pelaksanaan
            'tanggal_mulai' => 'nullable|date|before_or_equal:today',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tanggal_target_selesai' => 'nullable|date|after:tanggal_mulai',
            'durasi_hari' => 'nullable|integer|min:1|max:365',

            // Lokasi dan Sasaran
            'lokasi' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string|max:500',
            'kelompok_sasaran' => 'nullable|string|max:255',
            'jumlah_peserta' => 'nullable|integer|min:1',
            'kriteria_peserta' => 'nullable|string|max:1000',

            // Pendanaan
            'sumber_dana' => 'nullable|string|max:255',
            'jumlah_dana' => 'nullable|numeric|min:0|max:999999999999.99',
            'hibah_kompetitif' => 'nullable|boolean',

            // Output dan Dampak
            'tujuan' => 'nullable|string|max:1000',
            'luaran' => 'nullable|string|max:1000',
            'dampak_manfaat' => 'nullable|string|max:2000',
            'indikator_keberhasilan' => 'nullable|string|max:1000',
            'kendala_hambatan' => 'nullable|string|max:1000',

            // Dokumentasi
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_dokumentasi' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:20480',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'link_dokumentasi' => 'nullable|url|max:1000',

            // SK dan Administrasi
            'nomor_sk' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date|before_or_equal:today',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:5120',

            // Evaluasi
            'evaluasi_kegiatan' => 'nullable|string|max:2000',
            'tingkat_kepuasan' => 'nullable|in:sangat_baik,baik,cukup,kurang,sangat_kurang',
            'rekomendasi' => 'nullable|string|max:1000',
        ];

        return $rules;
    }

    /**
     * Get status options
     */
    public static function getStatusOptions(): array
    {
        return [
            'draft' => 'Draft',
            'submitted' => 'Diajukan',
            'approved' => 'Disetujui',
            'ongoing' => 'Sedang Berjalan',
            'completed' => 'Selesai',
            'reported' => 'Dilaporkan',
            'cancelled' => 'Dibatalkan',
        ];
    }

    /**
     * Get jenis pengabdian options
     */
    public static function getJenisPengabdianOptions(): array
    {
        return [
            'pengabdian_masyarakat' => 'Pengabdian Masyarakat',
            'pengembangan_masyarakat' => 'Pengembangan Masyarakat',
            'pemberdayaan_masyarakat' => 'Pemberdayaan Masyarakat',
            'kemitraan' => 'Kemitraan',
            'lainnya' => 'Lainnya',
        ];
    }

    /**
     * Get tingkat kepuasan options
     */
    public static function getTingkatKepuasanOptions(): array
    {
        return [
            'sangat_baik' => 'Sangat Baik',
            'baik' => 'Baik',
            'cukup' => 'Cukup',
            'kurang' => 'Kurang',
            'sangat_kurang' => 'Sangat Kurang',
        ];
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'draft' => 'secondary',
            'submitted' => 'info',
            'approved' => 'primary',
            'ongoing' => 'warning',
            'completed' => 'success',
            'reported' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Check if service is active
     */
    public function isActive(): bool
    {
        return in_array($this->status, ['approved', 'ongoing']);
    }

    /**
     * Check if service is completed
     */
    public function isCompleted(): bool
    {
        return in_array($this->status, ['completed', 'reported']);
    }

    /**
     * Get formatted jumlah dana
     */
    public function getFormattedJumlahDana(): string
    {
        return $this->jumlah_dana ? 'Rp ' . number_format($this->jumlah_dana, 0, ',', '.') : '-';
    }

    /**
     * Get tim pelaksana names
     */
    public function getTimPelaksanaNames(): array
    {
        if (!$this->tim_pelaksana) return [];

        return \App\Models\Dosen::whereIn('id', $this->tim_pelaksana)
            ->pluck('nama_lengkap')
            ->toArray();
    }

    /**
     * Calculate duration in days
     */
    public function calculateDuration(): ?int
    {
        if ($this->tanggal_mulai && $this->tanggal_selesai) {
            return $this->tanggal_mulai->diffInDays($this->tanggal_selesai) + 1;
        }
        return null;
    }

    /**
     * Relationship with Dosen
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    /**
     * Scope for active services
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['approved', 'ongoing']);
    }

    /**
     * Scope for completed services
     */
    public function scopeCompleted($query)
    {
        return $query->whereIn('status', ['completed', 'reported']);
    }

    /**
     * Scope for services by year
     */
    public function scopeByYear($query, $year)
    {
        return $query->whereYear('tanggal_mulai', $year);
    }

    /**
     * Scope for services by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('jenis_pengabdian', $type);
    }
}
