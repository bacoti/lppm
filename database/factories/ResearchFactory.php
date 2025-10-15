<?php

namespace Database\Factories;

use App\Models\Research;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Research>
 */
class ResearchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dosen_id' => null,
            'judul' => $this->faker->sentence(6),
            'bidang' => $this->faker->randomElement([
                'Pangan', 'Energi', 'Kesehatan', 'Transportasi', 'Rekayasa', 'Pertahanan'
            ]),
            'tahun' => $this->faker->year(),
            'sumber_dana' => $this->faker->randomElement(['Internal', 'Hibah DIKTI', 'Mandiri']),
            'jumlah_dana' => $this->faker->randomFloat(2, 1_000_000, 100_000_000),
            'abstrak' => $this->faker->paragraph(),
            'luaran' => $this->faker->randomElement(['Publikasi', 'HKI', 'Prototipe']),
            'file_laporan' => null,
        ];
    }
}
