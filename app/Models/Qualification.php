<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Qualification extends Model
{
    /** @use HasFactory<\Database\Factories\QualificationFactory> */
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'riwayat_pendidikan',
        'gelar_diperoleh',
        'jenjang_pendidikan',
        'nama_perguruan_tinggi',
        'status_pt',
        'akreditasi_pt',
        'bidang_keilmuan',
        'ipk',
        'tahun_lulus',
        'status_kelulusan',
        'jabatan',
        'jabatan_fungsional',
        'nomor_sertifikat_pendidik',
        'tahun_sertifikasi',
        'status_sertifikasi',
        'bidang_penelitian_utama',
        'h_index',
        'publikasi_scopus',
    ];

    protected $casts = [
        'ipk' => 'decimal:2',
        'tahun_lulus' => 'integer',
        'tahun_sertifikasi' => 'integer',
        'h_index' => 'integer',
        'publikasi_scopus' => 'integer',
    ];

    // Accessor for IPK formatting
    public function getFormattedIpkAttribute()
    {
        return $this->ipk ? number_format($this->ipk, 2) : null;
    }

    // Scope for filtering by jenjang
    public function scopeByJenjang($query, $jenjang)
    {
        return $query->where('jenjang_pendidikan', $jenjang);
    }

    // Scope for certified lecturers
    public function scopeCertified($query)
    {
        return $query->where('status_sertifikasi', 'Sudah');
    }

    // Static methods for dropdown options
    public static function getJenjangPendidikanOptions()
    {
        return [
            'D3' => 'D3 - Diploma',
            'D4/S1' => 'D4/S1 - Sarjana',
            'S2' => 'S2 - Magister',
            'S3' => 'S3 - Doktor',
            'Profesi' => 'Profesi'
        ];
    }

    public static function getStatusPTOptions()
    {
        return [
            'Negeri' => 'Negeri',
            'Swasta' => 'Swasta',
            'Kedinasan' => 'Kedinasan'
        ];
    }

    public static function getAkreditasiPTOptions()
    {
        return [
            'Unggul' => 'Unggul',
            'Baik Sekali' => 'Baik Sekali',
            'Baik' => 'Baik',
            'A' => 'A (Lama)',
            'B' => 'B (Lama)',
            'C' => 'C (Lama)'
        ];
    }

    public static function getStatusKelulusanOptions()
    {
        return [
            'Lulus' => 'Lulus',
            'Dalam Proses' => 'Dalam Proses'
        ];
    }

    public static function getJabatanFungsionalOptions()
    {
        return [
            'Tenaga Pengajar' => 'Tenaga Pengajar',
            'Asisten Ahli' => 'Asisten Ahli',
            'Lektor' => 'Lektor',
            'Lektor Kepala' => 'Lektor Kepala',
            'Profesor' => 'Profesor'
        ];
    }

    public static function getStatusSertifikasiOptions()
    {
        return [
            'Sudah' => 'Sudah',
            'Belum' => 'Belum',
            'Dalam Proses' => 'Dalam Proses'
        ];
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
}
