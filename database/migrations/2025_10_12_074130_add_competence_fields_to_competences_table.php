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
        Schema::table('competences', function (Blueprint $table) {
            // Kompetensi Pedagogik
            $table->text('metodologi_pengajaran')->nullable()->comment('Metodologi dan strategi pengajaran yang dikuasai');
            $table->text('teknik_evaluasi')->nullable()->comment('Teknik evaluasi dan penilaian pembelajaran');
            $table->text('manajemen_kelas')->nullable()->comment('Kemampuan manajemen dan pengelolaan kelas');
            $table->text('teknologi_pembelajaran')->nullable()->comment('Penggunaan teknologi dalam pembelajaran');
            $table->text('pengembangan_kurikulum')->nullable()->comment('Kemampuan pengembangan dan adaptasi kurikulum');
            
            // Kompetensi Profesional
            $table->text('keahlian_bidang')->nullable()->comment('Keahlian khusus dalam bidang ilmu');
            $table->text('penelitian_terapan')->nullable()->comment('Kemampuan penelitian terapan di bidangnya');
            $table->text('publikasi_ilmiah')->nullable()->comment('Publikasi dan karya ilmiah yang dihasilkan');
            $table->text('kolaborasi_industri')->nullable()->comment('Kolaborasi dengan industri dan praktisi');
            $table->text('update_pengetahuan')->nullable()->comment('Upaya pembaruan pengetahuan dan kompetensi');
            
            // Kompetensi Sosial
            $table->text('komunikasi_efektif')->nullable()->comment('Kemampuan komunikasi dengan mahasiswa dan kolega');
            $table->text('kerjasama_tim')->nullable()->comment('Kemampuan bekerja dalam tim dan kolaborasi');
            $table->text('kepemimpinan')->nullable()->comment('Kemampuan kepemimpinan dan pengembangan orang lain');
            $table->text('adaptasi_budaya')->nullable()->comment('Kemampuan adaptasi dengan beragam budaya');
            $table->text('etika_profesi')->nullable()->comment('Pemahaman dan penerapan etika profesi');
            
            // Sertifikasi dan Kompetensi Formal
            $table->string('sertifikat_pendidik')->nullable()->comment('Sertifikat pendidik yang dimiliki');
            $table->date('tanggal_sertifikat')->nullable()->comment('Tanggal perolehan sertifikat pendidik');
            $table->text('sertifikasi_lain')->nullable()->comment('Sertifikasi profesional lainnya');
            $table->text('pelatihan_kompetensi')->nullable()->comment('Pelatihan kompetensi yang pernah diikuti');
            $table->enum('status_sertifikasi', ['aktif', 'tidak_aktif', 'proses_perpanjangan'])->default('tidak_aktif')->comment('Status sertifikasi pendidik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competences', function (Blueprint $table) {
            // Drop Kompetensi Pedagogik
            $table->dropColumn([
                'metodologi_pengajaran',
                'teknik_evaluasi', 
                'manajemen_kelas',
                'teknologi_pembelajaran',
                'pengembangan_kurikulum'
            ]);
            
            // Drop Kompetensi Profesional  
            $table->dropColumn([
                'keahlian_bidang',
                'penelitian_terapan',
                'publikasi_ilmiah', 
                'kolaborasi_industri',
                'update_pengetahuan'
            ]);
            
            // Drop Kompetensi Sosial
            $table->dropColumn([
                'komunikasi_efektif',
                'kerjasama_tim',
                'kepemimpinan',
                'adaptasi_budaya', 
                'etika_profesi'
            ]);
            
            // Drop Sertifikasi
            $table->dropColumn([
                'sertifikat_pendidik',
                'tanggal_sertifikat',
                'sertifikasi_lain',
                'pelatihan_kompetensi',
                'status_sertifikasi'
            ]);
        });
    }
};
