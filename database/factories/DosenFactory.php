<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nidn_nip' => $this->faker->unique()->numerify('##########'),
            'nama_lengkap' => $this->faker->name(),
            'gelar_akademik' => $this->faker->randomElement(['S.Kom', 'M.Kom', 'Dr.', 'Prof.']),
            'tanggal_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->address(),

            // Field-field baru
            'role' => $this->faker->randomElement(['lecturer', 'researcher']),
            'affiliation' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'scopus_id' => $this->faker->optional(0.7)->numerify('##########'),
            'google_id' => $this->faker->optional(0.6)->bothify('?????-####-####'),
            'wos_researcher_id' => $this->faker->optional(0.5)->bothify('???-####-####'),
            'garuda_id' => $this->faker->optional(0.8)->numerify('########'),
            'level_department' => $this->faker->randomElement(['s1', 's2', 's3', 'd3', 'd4']),
            'department' => $this->faker->randomElement([
                'Teknik Informatika',
                'Sistem Informasi',
                'Teknik Elektro',
                'Teknik Sipil',
                'Manajemen',
                'Akuntansi',
                'Ilmu Komunikasi',
                'Psikologi',
                'Pendidikan Bahasa Inggris',
                'Matematika'
            ]),
            'academic_grade' => $this->faker->randomElement([
                'Asisten Ahli',
                'Lektor',
                'Lektor Kepala',
                'Guru Besar',
                'Tenaga Pengajar'
            ]),
            'country' => $this->faker->randomElement(['Indonesia', 'Malaysia', 'Singapura']),
            'id_card' => $this->faker->optional(0.9)->numerify('################'),
        ];
    }
}
