<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dosen_id',
        'judul',
        'bidang',
        'tahun',
        'sumber_dana',
        'jumlah_dana',
        'abstrak',
        'luaran',
        'file_laporan',
        // Status dan Progress
        'status',
        'progress_percentage',
        // Kategori dan Klasifikasi
        'kategori',
        'tingkat',
        'hibah_kompetitif',
        // Tim Peneliti
        'tim_peneliti',
        'ketua_peneliti',
        'anggota_eksternal',
        // Waktu Pelaksanaan
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_target_selesai',
        // SK dan Administrasi
        'nomor_sk',
        'tanggal_sk',
        'file_sk',
        // Publikasi dan Output
        'keywords',
        'doi',
        'issn_isbn',
        'link_publikasi',
        'jurnal_conference',
        'jenis_publikasi',
        // Output Tambahan
        'luaran_tambahan',
        'dampak_manfaat',
        'kendala_hambatan',
        // File Tambahan
        'file_proposal',
        'file_progress_report',
        'file_final_report',
        // Additional fields
        'nidn_leader',
        'leader_name',
        'pddikti_code_pt',
        'institution',
        'skema_abbreviation',
        'skema_name',
        'first_proposal_year',
        'proposed_year_of_activities',
        'year_of_activity',
        'duration_of_activity',
        'proposal_status',
        'funds_approved',
        'sinta_affiliation_id',
        'funds_institution',
        'target_tkt_level',
        'hibah_program',
        'focus_area',
        'fund_source_category',
        'fund_source',
        'country_fund_source',
    ];

    protected $casts = [
        'tim_peneliti' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_target_selesai' => 'date',
        'tanggal_sk' => 'date',
        'hibah_kompetitif' => 'boolean',
        'progress_percentage' => 'integer',
        'first_proposal_year' => 'integer',
        'proposed_year_of_activities' => 'integer',
        'year_of_activity' => 'integer',
        'duration_of_activity' => 'integer',
        'target_tkt_level' => 'integer',
        'funds_approved' => 'decimal:2',
    ];

    /**
     * Validation rules for research data
     */
    public static function validationRules($isUpdate = false): array
    {
        $rules = [
            'dosen_id' => 'nullable|exists:dosens,id',
            'judul' => 'required|string|max:500',
            'bidang' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'sumber_dana' => 'nullable|string|max:255',
            'jumlah_dana' => 'nullable|numeric|min:0|max:999999999999.99',
            'abstrak' => 'nullable|string|max:5000',
            'luaran' => 'nullable|string|max:1000',

            // Status dan Progress
            'status' => 'required|in:draft,submitted,ongoing,completed,published,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',

            // Kategori dan Klasifikasi
            'kategori' => 'nullable|in:penelitian_dasar,penelitian_terapan,pengembangan,penelitian_operasional',
            'tingkat' => 'nullable|in:lokal,nasional,internasional',
            'hibah_kompetitif' => 'nullable|boolean',

            // Tim Peneliti
            'tim_peneliti' => 'nullable|array',
            'tim_peneliti.*' => 'exists:dosens,id',
            'ketua_peneliti' => 'nullable|string|max:255',
            'anggota_eksternal' => 'nullable|string|max:1000',

            // Waktu Pelaksanaan
            'tanggal_mulai' => 'nullable|date|before_or_equal:today',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tanggal_target_selesai' => 'nullable|date|after:tanggal_mulai',

            // SK dan Administrasi
            'nomor_sk' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date|before_or_equal:today',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB

            // Publikasi dan Output
            'keywords' => 'nullable|string|max:1000',
            'doi' => 'nullable|string|max:255|regex:/^10\.\d{4,9}\/[-._;()\/:A-Z0-9]+$/i',
            'issn_isbn' => 'nullable|string|max:255',
            'link_publikasi' => 'nullable|url|max:1000',
            'jurnal_conference' => 'nullable|string|max:500',
            'jenis_publikasi' => 'nullable|in:jurnal_nasional,jurnal_internasional,conference_nasional,conference_internasional,prosiding,book_chapter,monograf,belum_dipublikasikan',

            // Output Tambahan
            'luaran_tambahan' => 'nullable|string|max:2000',
            'dampak_manfaat' => 'nullable|string|max:2000',
            'kendala_hambatan' => 'nullable|string|max:2000',

            // File Tambahan
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_progress_report' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_final_report' => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            // Additional research fields
            'nidn_leader' => 'nullable|string|max:255',
            'leader_name' => 'nullable|string|max:255',
            'pddikti_code_pt' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'skema_abbreviation' => 'nullable|string|max:255',
            'skema_name' => 'nullable|string|max:255',
            'first_proposal_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 10),
            'proposed_year_of_activities' => 'nullable|integer|min:2000|max:' . (date('Y') + 10),
            'year_of_activity' => 'nullable|integer|min:2000|max:' . (date('Y') + 10),
            'duration_of_activity' => 'nullable|integer|min:1|max:10',
            'proposal_status' => 'nullable|in:draft,submitted,approved,rejected,revision,funded,completed',
            'funds_approved' => 'nullable|numeric|min:0|max:999999999999.99',
            'sinta_affiliation_id' => 'nullable|string|max:255',
            'funds_institution' => 'nullable|string|max:255',
            'target_tkt_level' => 'nullable|integer|min:1|max:9',
            'hibah_program' => 'nullable|string|max:255',
            'focus_area' => 'nullable|string|max:255',
            'fund_source_category' => 'nullable|string|max:255',
            'fund_source' => 'nullable|string|max:255',
            'country_fund_source' => 'nullable|string|max:255',
        ];

        // For updates, make some fields optional
        if ($isUpdate) {
            $rules['judul'] = 'required|string|max:500';
            $rules['status'] = 'required|in:draft,submitted,ongoing,completed,published,cancelled';
        }

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
            'ongoing' => 'Sedang Berjalan',
            'completed' => 'Selesai',
            'published' => 'Dipublikasikan',
            'cancelled' => 'Dibatalkan',
        ];
    }

    /**
     * Get kategori options
     */
    public static function getKategoriOptions(): array
    {
        return [
            'penelitian_dasar' => 'Penelitian Dasar',
            'penelitian_terapan' => 'Penelitian Terapan',
            'pengembangan' => 'Pengembangan',
            'penelitian_operasional' => 'Penelitian Operasional',
        ];
    }

    /**
     * Get tingkat options
     */
    public static function getTingkatOptions(): array
    {
        return [
            'lokal' => 'Lokal',
            'nasional' => 'Nasional',
            'internasional' => 'Internasional',
        ];
    }

    /**
     * Get jenis publikasi options
     */
    public static function getJenisPublikasiOptions(): array
    {
        return [
            'jurnal_nasional' => 'Jurnal Nasional',
            'jurnal_internasional' => 'Jurnal Internasional',
            'conference_nasional' => 'Conference Nasional',
            'conference_internasional' => 'Conference Internasional',
            'prosiding' => 'Prosiding',
            'book_chapter' => 'Book Chapter',
            'monograf' => 'Monograf',
            'belum_dipublikasikan' => 'Belum Dipublikasikan',
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
            'ongoing' => 'primary',
            'completed' => 'success',
            'published' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Check if research is active
     */
    public function isActive(): bool
    {
        return in_array($this->status, ['ongoing', 'submitted']);
    }

    /**
     * Check if research is completed
     */
    public function isCompleted(): bool
    {
        return in_array($this->status, ['completed', 'published']);
    }

    /**
     * Get formatted jumlah dana
     */
    public function getFormattedJumlahDana(): string
    {
        return $this->jumlah_dana ? 'Rp ' . number_format($this->jumlah_dana, 0, ',', '.') : '-';
    }

    /**
     * Get keywords as array
     */
    public function getKeywordsArray(): array
    {
        return $this->keywords ? array_map('trim', explode(',', $this->keywords)) : [];
    }

    /**
     * Get tim peneliti names
     */
    public function getTimPenelitiNames(): array
    {
        if (!$this->tim_peneliti) return [];

        return \App\Models\Dosen::whereIn('id', $this->tim_peneliti)
            ->pluck('nama_lengkap')
            ->toArray();
    }

    /**
     * Scope for active researches
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['ongoing', 'submitted']);
    }

    /**
     * Scope for completed researches
     */
    public function scopeCompleted($query)
    {
        return $query->whereIn('status', ['completed', 'published']);
    }

    /**
     * Scope for researches by year
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('tahun', $year);
    }

    /**
     * Scope for researches by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('kategori', $category);
    }

    public function dosen(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    /**
     * Get proposal status options
     */
    public static function getProposalStatusOptions(): array
    {
        return [
            'draft' => 'Draft',
            'submitted' => 'Diajukan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'revision' => 'Revisi',
            'funded' => 'Didanai',
            'completed' => 'Selesai',
        ];
    }

    /**
     * Get proposal status badge class
     */
    public function getProposalStatusBadgeClass(): string
    {
        return match($this->proposal_status) {
            'draft' => 'secondary',
            'submitted' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            'revision' => 'warning',
            'funded' => 'primary',
            'completed' => 'success',
            default => 'secondary',
        };
    }

    /**
     * Get formatted funds approved
     */
    public function getFormattedFundsApproved(): string
    {
        return $this->funds_approved ? 'Rp ' . number_format($this->funds_approved, 0, ',', '.') : '-';
    }
}
