<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Qualification>
 */
class QualificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'riwayat_pendidikan' => $this->faker->sentence(3),
            'jenjang_pendidikan' => $this->faker->randomElement(['S1', 'S2', 'S3']),
            'nama_perguruan_tinggi' => $this->faker->company(),
            'bidang_keilmuan' => $this->faker->word(),
            'tahun_lulus' => $this->faker->year(),
            'jabatan' => $this->faker->randomElement(['Dosen', 'Peneliti', 'Asisten']),
            'jabatan_fungsional' => $this->faker->randomElement(['Asisten Ahli', 'Lektor', 'Lektor Kepala']),
        ];
    }
}
