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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Foreign Key
            $table->foreignId('dosen_id')
                ->nullable()
                ->constrained('dosens')
                ->nullOnDelete();

            // Informasi Dasar
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('bidang')->nullable(); // Bidang pengabdian (pendidikan, kesehatan, ekonomi, dll)
            $table->enum('jenis_pengabdian', [
                'pengabdian_masyarakat',
                'pengembangan_masyarakat',
                'pemberdayaan_masyarakat',
                'kemitraan',
                'lainnya'
            ])->nullable();

            // Status dan Progress
            $table->enum('status', [
                'draft',
                'submitted',
                'approved',
                'ongoing',
                'completed',
                'reported',
                'cancelled'
            ])->default('draft');
            $table->integer('progress_percentage')->default(0);

            // Tim Pelaksana
            $table->string('ketua_pengabdian')->nullable();
            $table->json('tim_pelaksana')->nullable(); // Array of dosen IDs
            $table->text('anggota_eksternal')->nullable(); // Anggota dari luar universitas/mitra
            $table->text('mitra_kerjasama')->nullable(); // Nama mitra/instansi

            // Waktu Pelaksanaan
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_target_selesai')->nullable();
            $table->integer('durasi_hari')->nullable(); // Durasi dalam hari

            // Lokasi dan Sasaran
            $table->string('lokasi')->nullable(); // Tempat pelaksanaan
            $table->text('alamat_lengkap')->nullable();
            $table->string('kelompok_sasaran')->nullable(); // Siswa, petani, UMKM, dll
            $table->integer('jumlah_peserta')->nullable(); // Jumlah peserta/beneficiaries
            $table->text('kriteria_peserta')->nullable();

            // Pendanaan
            $table->string('sumber_dana')->nullable();
            $table->decimal('jumlah_dana', 15, 2)->nullable();
            $table->boolean('hibah_kompetitif')->default(false);

            // Output dan Dampak
            $table->text('tujuan')->nullable();
            $table->text('luaran')->nullable(); // Output yang dihasilkan
            $table->text('dampak_manfaat')->nullable(); // Dampak dan manfaat
            $table->text('indikator_keberhasilan')->nullable();
            $table->text('kendala_hambatan')->nullable();

            // Dokumentasi
            $table->string('file_proposal')->nullable();
            $table->string('file_laporan')->nullable();
            $table->string('file_dokumentasi')->nullable(); // Foto/video kegiatan
            $table->string('file_sertifikat')->nullable();
            $table->text('link_dokumentasi')->nullable(); // Link ke dokumentasi online

            // SK dan Administrasi
            $table->string('nomor_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('file_sk')->nullable();

            // Evaluasi
            $table->text('evaluasi_kegiatan')->nullable();
            $table->enum('tingkat_kepuasan', ['sangat_baik', 'baik', 'cukup', 'kurang', 'sangat_kurang'])->nullable();
            $table->text('rekomendasi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
