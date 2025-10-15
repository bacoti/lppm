<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Research;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::all()->each(function ($dosen) {
            Research::factory()->count(rand(1, 5))->create(['dosen_id' => $dosen->id]);
        });
    }
}
