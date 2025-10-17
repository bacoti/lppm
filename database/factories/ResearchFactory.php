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
        $startDate = $this->faker->dateTimeBetween('-3 years', '-1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 years');

        return [
            'dosen_id' => null,
            'judul' => $this->faker->sentence(rand(8, 15)),
            'bidang' => $this->faker->randomElement([
                'Teknologi Informasi', 'Teknik Elektro', 'Teknik Sipil', 'Teknik Mesin',
                'Teknik Kimia', 'Biologi', 'Kimia', 'Fisika', 'Matematika', 'Statistika',
                'Ekonomi', 'Manajemen', 'Akuntansi', 'Hukum', 'Pendidikan', 'Psikologi'
            ]),
            'tahun' => $this->faker->numberBetween(2020, 2025),
            'sumber_dana' => $this->faker->randomElement([
                'Hibah DIKTI', 'Hibah Internal Universitas', 'Mandiri', 'Kerjasama Industri',
                'Hibah Kemenristekdikti', 'Hibah LPDP', 'Dana BLU', 'Hibah Internasional'
            ]),
            'jumlah_dana' => $this->faker->randomFloat(2, 5_000_000, 500_000_000),
            'abstrak' => $this->faker->paragraphs(rand(3, 6), true),
            'luaran' => $this->faker->randomElement([
                'Artikel Jurnal', 'HKI Paten', 'Prototipe', 'Buku', 'Prosiding Seminar',
                'Software', 'Policy Brief', 'Artikel Popular'
            ]),
            'file_laporan' => null,

            // Status dan Progress
            'status' => $this->faker->randomElement(['draft', 'submitted', 'ongoing', 'completed', 'published']),
            'progress_percentage' => $this->faker->numberBetween(0, 100),

            // Kategori dan Klasifikasi
            'kategori' => $this->faker->randomElement([
                'penelitian_dasar', 'penelitian_terapan', 'pengembangan', 'penelitian_operasional'
            ]),
            'tingkat' => $this->faker->randomElement(['lokal', 'nasional', 'internasional']),
            'hibah_kompetitif' => $this->faker->boolean(30), // 30% chance of being competitive grant

            // Tim Peneliti
            'tim_peneliti' => $this->faker->randomElements(range(1, 20), rand(0, 5)), // Random team members
            'ketua_peneliti' => $this->faker->name(),
            'anggota_eksternal' => $this->faker->optional(0.3)->sentence(), // 30% chance of external members

            // Waktu Pelaksanaan
            'tanggal_mulai' => $startDate->format('Y-m-d'),
            'tanggal_selesai' => $this->faker->optional(0.7, null)->dateTimeBetween($startDate, '+2 years')?->format('Y-m-d'), // 70% chance completed
            'tanggal_target_selesai' => $endDate->format('Y-m-d'),

            // SK dan Administrasi
            'nomor_sk' => $this->faker->optional(0.8)->numerify('SK-###/UN##.##/####'), // 80% chance has SK
            'tanggal_sk' => $this->faker->optional(0.8, null)->dateTimeBetween('-2 years', 'now')?->format('Y-m-d'),
            'file_sk' => null,

            // Publikasi dan Output
            'keywords' => implode(', ', $this->faker->words(rand(3, 8))),
            'doi' => $this->faker->optional(0.4)->regexify('10\.[0-9]{4,9}/[-._;()/:A-Z0-9]+'), // 40% chance has DOI
            'issn_isbn' => $this->faker->optional(0.5)->regexify('[0-9]{4}-[0-9]{4}'), // ISSN format
            'link_publikasi' => $this->faker->optional(0.6)->url(), // 60% chance has publication link
            'jurnal_conference' => $this->faker->optional(0.7)->company(), // 70% chance has journal/conference name
            'jenis_publikasi' => $this->faker->optional(0.8)->randomElement([
                'jurnal_nasional', 'jurnal_internasional', 'conference_nasional',
                'conference_internasional', 'prosiding', 'book_chapter', 'monograf'
            ]),

            // Output Tambahan
            'luaran_tambahan' => $this->faker->optional(0.4)->paragraph(),
            'dampak_manfaat' => $this->faker->optional(0.6)->paragraph(),
            'kendala_hambatan' => $this->faker->optional(0.3)->paragraph(),

            // File Tambahan
            'file_proposal' => null,
            'file_progress_report' => null,
            'file_final_report' => null,
        ];
    }
}
