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
            // Leader information
            $table->string('nidn_leader')->nullable()->after('file_final_report');
            $table->string('leader_name')->nullable()->after('nidn_leader');

            // Institution information
            $table->string('pddikti_code_pt')->nullable()->after('leader_name');
            $table->string('institution')->nullable()->after('pddikti_code_pt');

            // Skema information
            $table->string('skema_abbreviation')->nullable()->after('institution');
            $table->string('skema_name')->nullable()->after('skema_abbreviation');

            // Year information
            $table->year('first_proposal_year')->nullable()->after('skema_name');
            $table->year('proposed_year_of_activities')->nullable()->after('first_proposal_year');
            $table->year('year_of_activity')->nullable()->after('proposed_year_of_activities');

            // Activity duration
            $table->integer('duration_of_activity')->nullable()->after('year_of_activity');

            // Proposal status
            $table->enum('proposal_status', [
                'draft',
                'submitted',
                'approved',
                'rejected',
                'revision',
                'funded',
                'completed'
            ])->default('draft')->after('duration_of_activity');

            // Funding information
            $table->decimal('funds_approved', 15, 2)->nullable()->after('proposal_status');
            $table->string('sinta_affiliation_id')->nullable()->after('funds_approved');
            $table->string('funds_institution')->nullable()->after('sinta_affiliation_id');

            // Target and program information
            $table->integer('target_tkt_level')->nullable()->after('funds_institution');
            $table->string('hibah_program')->nullable()->after('target_tkt_level');
            $table->string('focus_area')->nullable()->after('hibah_program');

            // Fund source information
            $table->string('fund_source_category')->nullable()->after('focus_area');
            $table->string('fund_source')->nullable()->after('fund_source_category');
            $table->string('country_fund_source')->default('Indonesia')->after('fund_source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropColumn([
                'nidn_leader',
                'leader_name',
                'pddikti_code_pt',
                'institution',
                'skema_abbreviation',
                'skema_name',
                'first_proposal_year',
                'proposed_year_of_activities',
                'year_of_activity',
                'duration_of_activity',
                'proposal_status',
                'funds_approved',
                'sinta_affiliation_id',
                'funds_institution',
                'target_tkt_level',
                'hibah_program',
                'focus_area',
                'fund_source_category',
                'fund_source',
                'country_fund_source'
            ]);
        });
    }
};
