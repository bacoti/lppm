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
        Schema::table('researches', function (Blueprint $table) {
            // Status dan Progress
            $table->enum('status', ['draft', 'submitted', 'ongoing', 'completed', 'published', 'cancelled'])
                  ->default('draft')->after('file_laporan');
            $table->integer('progress_percentage')->default(0)->after('status');

            // Kategori dan Klasifikasi
            $table->enum('kategori', [
                'penelitian_dasar',
                'penelitian_terapan',
                'pengembangan',
                'penelitian_operasional'
            ])->nullable()->after('progress_percentage');
            $table->enum('tingkat', ['lokal', 'nasional', 'internasional'])->nullable()->after('kategori');
            $table->boolean('hibah_kompetitif')->default(false)->after('tingkat');

            // Tim Peneliti
            $table->json('tim_peneliti')->nullable()->after('hibah_kompetitif'); // Array of researcher IDs
            $table->string('ketua_peneliti')->nullable()->after('tim_peneliti'); // Nama ketua peneliti
            $table->text('anggota_eksternal')->nullable()->after('ketua_peneliti'); // Anggota dari luar universitas

            // Waktu Pelaksanaan
            $table->date('tanggal_mulai')->nullable()->after('anggota_eksternal');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
            $table->date('tanggal_target_selesai')->nullable()->after('tanggal_selesai');

            // SK dan Administrasi
            $table->string('nomor_sk')->nullable()->after('tanggal_target_selesai');
            $table->date('tanggal_sk')->nullable()->after('nomor_sk');
            $table->string('file_sk')->nullable()->after('tanggal_sk');

            // Publikasi dan Output
            $table->text('keywords')->nullable()->after('file_sk'); // Comma-separated keywords
            $table->string('doi')->nullable()->after('keywords');
            $table->string('issn_isbn')->nullable()->after('doi');
            $table->text('link_publikasi')->nullable()->after('issn_isbn');
            $table->text('jurnal_conference')->nullable()->after('link_publikasi'); // Nama jurnal atau conference
            $table->enum('jenis_publikasi', [
                'jurnal_nasional',
                'jurnal_internasional',
                'conference_nasional',
                'conference_internasional',
                'prosiding',
                'book_chapter',
                'monograf',
                'belum_dipublikasikan'
            ])->nullable()->after('jurnal_conference');

            // Output Tambahan
            $table->text('luaran_tambahan')->nullable()->after('jenis_publikasi'); // Paten, prototype, dll
            $table->text('dampak_manfaat')->nullable()->after('luaran_tambahan'); // Dampak dan manfaat penelitian
            $table->text('kendala_hambatan')->nullable()->after('dampak_manfaat'); // Kendala selama penelitian

            // File Tambahan
            $table->string('file_proposal')->nullable()->after('kendala_hambatan');
            $table->string('file_progress_report')->nullable()->after('file_proposal');
            $table->string('file_final_report')->nullable()->after('file_progress_report');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'progress_percentage',
                'kategori',
                'tingkat',
                'hibah_kompetitif',
                'tim_peneliti',
                'ketua_peneliti',
                'anggota_eksternal',
                'tanggal_mulai',
                'tanggal_selesai',
                'tanggal_target_selesai',
                'nomor_sk',
                'tanggal_sk',
                'file_sk',
                'keywords',
                'doi',
                'issn_isbn',
                'link_publikasi',
                'jurnal_conference',
                'jenis_publikasi',
                'luaran_tambahan',
                'dampak_manfaat',
                'kendala_hambatan',
                'file_proposal',
                'file_progress_report',
                'file_final_report'
            ]);
        });
    }
};
