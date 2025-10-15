<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hakis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('jenis_haki', [
                'paten', 
                'merek', 
                'hak_cipta', 
                'desain_industri', 
                'rahasia_dagang',
                'indikasi_geografis',
                'desain_tata_letak_sirkuit_terpadu'
            ]);
            $table->string('nomor_pendaftaran')->nullable();
            $table->string('nomor_publikasi')->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->date('tanggal_granted')->nullable();
            $table->enum('status', [
                'draft',
                'diajukan', 
                'dalam_proses',
                'dipublikasi',
                'granted',
                'ditolak',
                'expired'
            ])->default('draft');
            $table->text('deskripsi')->nullable();
            $table->json('inventor'); // Menyimpan array inventor/pencipta
            $table->string('klasifikasi')->nullable(); // Klasifikasi IPC untuk paten
            $table->string('bidang_teknologi')->nullable();
            $table->string('kantor_kekayaan_intelektual')->default('DJKI Indonesia');
            $table->string('nomor_sertifikat')->nullable();
            $table->date('tanggal_berlaku_mulai')->nullable();
            $table->date('tanggal_berlaku_selesai')->nullable();
            $table->boolean('diperpanjang')->default(false);
            $table->text('catatan')->nullable();
            $table->string('file_dokumen')->nullable(); // Path ke file dokumen
            $table->string('file_sertifikat')->nullable(); // Path ke file sertifikat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hakis');
    }
};
