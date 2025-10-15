<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::all()->each(function ($dosen) {
            Qualification::factory()->count(3)->create([
                'dosen_id' => $dosen->id,
            ]);
        });
    }
}
