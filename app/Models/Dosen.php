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
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }


    public function researches()
    {
        return $this->hasMany(Research::class);
    }

}
