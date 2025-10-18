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
        Schema::table('hakis', function (Blueprint $table) {
            $table->string('nomor_permohonan')->nullable()->after('jenis_haki');
            $table->integer('tahun_permohonan')->nullable()->after('nomor_permohonan');
            $table->string('pemegang_paten')->nullable()->after('deskripsi');
            $table->date('tanggal_penerimaan')->nullable()->after('tanggal_publikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hakis', function (Blueprint $table) {
            $table->dropColumn(['nomor_permohonan', 'tahun_permohonan', 'pemegang_paten', 'tanggal_penerimaan']);
        });
    }
};
