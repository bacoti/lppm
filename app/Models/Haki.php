<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Haki extends Model
{
    /** @use HasFactory<\Database\Factories\HakiFactory> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'jenis_haki',
        'nomor_pendaftaran',
        'nomor_publikasi',
        'tanggal_daftar',
        'tanggal_publikasi',
        'tanggal_granted',
        'status',
        'deskripsi',
        'inventor',
        'klasifikasi',
        'bidang_teknologi',
        'kantor_kekayaan_intelektual',
        'nomor_sertifikat',
        'tanggal_berlaku_mulai',
        'tanggal_berlaku_selesai',
        'diperpanjang',
        'catatan',
        'file_dokumen',
        'file_sertifikat'
    ];

    protected $casts = [
        'inventor' => 'array',
        'tanggal_daftar' => 'date',
        'tanggal_publikasi' => 'date',
        'tanggal_granted' => 'date',
        'tanggal_berlaku_mulai' => 'date',
        'tanggal_berlaku_selesai' => 'date',
        'diperpanjang' => 'boolean'
    ];

    /**
     * Get HAKI type options
     */
    public static function getJenisHakiOptions(): array
    {
        return [
            'paten' => 'Paten',
            'merek' => 'Merek',
            'hak_cipta' => 'Hak Cipta',
            'desain_industri' => 'Desain Industri',
            'rahasia_dagang' => 'Rahasia Dagang',
            'indikasi_geografis' => 'Indikasi Geografis',
            'desain_tata_letak_sirkuit_terpadu' => 'Desain Tata Letak Sirkuit Terpadu'
        ];
    }

    /**
     * Get status options
     */
    public static function getStatusOptions(): array
    {
        return [
            'draft' => 'Draft',
            'diajukan' => 'Diajukan',
            'dalam_proses' => 'Dalam Proses',
            'dipublikasi' => 'Dipublikasi',
            'granted' => 'Granted/Diterima',
            'ditolak' => 'Ditolak',
            'expired' => 'Expired/Kedaluwarsa'
        ];
    }

    /**
     * Get inventor names as string
     */
    protected function inventorNames(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => is_array($this->inventor) 
                ? implode(', ', $this->inventor) 
                : $this->inventor
        );
    }

    /**
     * Check if HAKI is still valid
     */
    public function isValid(): bool
    {
        if (!$this->tanggal_berlaku_selesai) {
            return true; // No expiry date set
        }
        
        return $this->tanggal_berlaku_selesai->isFuture();
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'draft' => 'bg-secondary',
            'diajukan' => 'bg-info',
            'dalam_proses' => 'bg-warning',
            'dipublikasi' => 'bg-primary',
            'granted' => 'bg-success',
            'ditolak' => 'bg-danger',
            'expired' => 'bg-dark',
            default => 'bg-secondary'
        };
    }

    /**
     * Scope for searching
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('nomor_pendaftaran', 'like', '%' . $search . '%')
              ->orWhere('nomor_publikasi', 'like', '%' . $search . '%')
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              ->orWhere('bidang_teknologi', 'like', '%' . $search . '%');
        });
    }

    /**
     * Scope for filtering by jenis
     */
    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis_haki', $jenis);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
