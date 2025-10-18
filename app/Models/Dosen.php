<?php

namespace App\Models;

use Database\Factories\DosenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    /** @use HasFactory<DosenFactory> */
    use HasFactory;

    protected $fillable = [
        'nidn_nip',
        'nama_lengkap',
        'photo',
        'gelar_akademik',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
        'role',
        'affiliation',
        'email',
        'scopus_id',
        'google_id',
        'wos_researcher_id',
        'garuda_id',
        'level_department',
        'department',
        'academic_grade',
        'country',
        'id_card',
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }


    public function researches()
    {
        return $this->hasMany(Research::class);
    }

    // Helper methods untuk mendapatkan label
    public function getRoleLabel()
    {
        return match($this->role) {
            'lecturer' => 'Dosen',
            'researcher' => 'Peneliti',
            default => 'Tidak Diketahui'
        };
    }

    public function getLevelDepartmentLabel()
    {
        return match($this->level_department) {
            'd1' => 'Diploma 1',
            'd2' => 'Diploma 2',
            'd3' => 'Diploma 3',
            'd4' => 'Diploma 4',
            's1' => 'Sarjana',
            's2' => 'Magister',
            's3' => 'Doktor',
            'profesi' => 'Profesi',
            'spesialis' => 'Spesialis',
            default => 'Tidak Diketahui'
        };
    }

    public function getJenisKelaminLabel()
    {
        return match($this->jenis_kelamin) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => 'Tidak Diketahui'
        };
    }
}
