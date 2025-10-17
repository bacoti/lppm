<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'mime_type',
        'status',
        'slug',
        'user_id'
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Relationship to User (uploader)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get file URL
     */
    public function getFileUrlAttribute()
    {
        return \Storage::url($this->file_path);
    }

    /**
     * Get formatted file size
     */
    public function getFileSizeFormattedAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get file extension
     */
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    /**
     * Scope for published documents
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dokumen) {
            if (empty($dokumen->slug)) {
                $dokumen->slug = Str::slug($dokumen->judul);
            }
        });

        static::updating(function ($dokumen) {
            if ($dokumen->isDirty('judul') && empty($dokumen->slug)) {
                $dokumen->slug = Str::slug($dokumen->judul);
            }
        });
    }
}
