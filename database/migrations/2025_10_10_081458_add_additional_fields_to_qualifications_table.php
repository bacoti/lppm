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
        Schema::table('qualifications', function (Blueprint $table) {
            // Data Akademik
            $table->string('gelar_diperoleh')->nullable()->after('riwayat_pendidikan');
            $table->decimal('ipk', 3, 2)->nullable()->after('gelar_diperoleh');
            $table->enum('status_kelulusan', ['Lulus', 'Dalam Proses'])->default('Lulus')->after('tahun_lulus');
            
            // Info Perguruan Tinggi
            $table->enum('status_pt', ['Negeri', 'Swasta', 'Kedinasan'])->nullable()->after('nama_perguruan_tinggi');
            $table->enum('akreditasi_pt', ['A', 'B', 'C', 'Unggul', 'Baik Sekali', 'Baik'])->nullable()->after('status_pt');
            
            // Sertifikasi Pendidik
            $table->string('nomor_sertifikat_pendidik')->nullable()->after('jabatan_fungsional');
            $table->year('tahun_sertifikasi')->nullable()->after('nomor_sertifikat_pendidik');
            $table->enum('status_sertifikasi', ['Sudah', 'Belum', 'Dalam Proses'])->nullable()->after('tahun_sertifikasi');
            
            // Data Penelitian (Optional)
            $table->string('bidang_penelitian_utama')->nullable()->after('status_sertifikasi');
            $table->integer('h_index')->nullable()->after('bidang_penelitian_utama');
            $table->integer('publikasi_scopus')->nullable()->after('h_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qualifications', function (Blueprint $table) {
            $table->dropColumn([
                'gelar_diperoleh',
                'ipk',
                'status_kelulusan',
                'status_pt',
                'akreditasi_pt',
                'nomor_sertifikat_pendidik',
                'tahun_sertifikasi',
                'status_sertifikasi',
                'bidang_penelitian_utama',
                'h_index',
                'publikasi_scopus'
            ]);
        });
    }
};
