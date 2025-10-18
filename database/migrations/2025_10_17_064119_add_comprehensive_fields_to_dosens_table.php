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
        Schema::table('dosens', function (Blueprint $table) {
            // Role dosen
            $table->enum('role', ['lecturer', 'researcher'])->default('lecturer')->after('alamat');

            // Informasi kontak dan afiliasi
            $table->string('affiliation')->nullable()->after('role');
            $table->string('email')->nullable()->after('affiliation');

            // ID peneliti dari berbagai platform
            $table->string('scopus_id')->nullable()->after('email');
            $table->string('google_id')->nullable()->after('scopus_id');
            $table->string('wos_researcher_id')->nullable()->after('google_id');
            $table->string('garuda_id')->nullable()->after('wos_researcher_id');

            // Informasi akademik
            $table->enum('level_department', ['d1', 'd2', 'd3', 'd4', 's1', 's2', 's3', 'profesi', 'spesialis'])->nullable()->after('garuda_id');
            $table->string('department')->nullable()->after('level_department');
            $table->string('academic_grade')->nullable()->after('department'); // jabatan fungsional

            // Informasi tambahan
            $table->string('country')->default('Indonesia')->after('academic_grade');
            $table->string('id_card')->nullable()->after('country'); // nomor KTP atau identitas lainnya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn([
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
                'id_card'
            ]);
        });
    }
};
