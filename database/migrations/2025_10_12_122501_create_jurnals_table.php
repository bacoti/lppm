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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('nama_jurnal');
            $table->string('issn')->nullable();
            $table->string('e_issn')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('volume')->nullable();
            $table->string('nomor')->nullable();
            $table->string('halaman')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('doi')->nullable();
            $table->text('url_jurnal')->nullable();
            $table->enum('jenis_jurnal', ['nasional', 'internasional'])->default('nasional');
            $table->enum('status', ['published', 'in_press', 'accepted', 'submitted', 'draft'])->default('draft');
            $table->json('penulis')->nullable(); // Array of authors
            $table->json('kata_kunci')->nullable(); // Array of keywords
            $table->string('bahasa')->default('id');
            $table->text('abstrak')->nullable();
            $table->string('file_pdf')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->enum('akreditasi', ['sinta_1', 'sinta_2', 'sinta_3', 'sinta_4', 'sinta_5', 'sinta_6', 'scopus', 'wos', 'non_sinta'])->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['status', 'tanggal_publikasi']);
            $table->index(['jenis_jurnal', 'tahun']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
