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
        Schema::table('services', function (Blueprint $table) {
            // Leader Information
            $table->string('nidn_leader', 50)->nullable()->after('jenis_pengabdian');
            $table->string('leader_name', 255)->nullable()->after('nidn_leader');
            $table->string('pddikti_code_pt', 50)->nullable()->after('leader_name');
            $table->string('institution', 255)->nullable()->after('pddikti_code_pt');

            // Skema Information
            $table->string('skema_abbreviation', 50)->nullable()->after('institution');
            $table->string('skema_name', 255)->nullable()->after('skema_abbreviation');

            // Timeline Information
            $table->year('first_year_proposal')->nullable()->after('skema_name');
            $table->year('proposed_year_activities')->nullable()->after('first_year_proposal');
            $table->year('activity_year')->nullable()->after('proposed_year_activities');

            // Proposal Status
            $table->enum('proposal_status', ['draft', 'submitted', 'review', 'approved', 'rejected', 'funded'])->nullable()->after('activity_year');

            // Additional Funding Information
            $table->decimal('fund_approved', 15, 2)->nullable()->after('jumlah_dana');
            $table->string('funds_institution', 255)->nullable()->after('fund_approved');
            $table->string('fund_source_category', 255)->nullable()->after('funds_institution');
            $table->string('fund_source', 255)->nullable()->after('fund_source_category');
            $table->string('country_fund_source', 255)->nullable()->after('fund_source');

            // Additional Information
            $table->string('sinta_affiliation_id', 50)->nullable()->after('country_fund_source');
            $table->tinyInteger('target_tkt')->nullable()->after('sinta_affiliation_id');
            $table->string('hibah_program', 255)->nullable()->after('hibah_kompetitif');
            $table->string('focus_area', 500)->nullable()->after('hibah_program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Leader Information
            $table->dropColumn([
                'nidn_leader',
                'leader_name',
                'pddikti_code_pt',
                'institution',
                'skema_abbreviation',
                'skema_name',
                'first_year_proposal',
                'proposed_year_activities',
                'activity_year',
                'proposal_status',
                'fund_approved',
                'funds_institution',
                'fund_source_category',
                'fund_source',
                'country_fund_source',
                'sinta_affiliation_id',
                'target_tkt',
                'hibah_program',
                'focus_area'
            ]);
        });
    }
};
