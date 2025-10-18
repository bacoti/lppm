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

            // Additional research fields
            'nidn_leader' => $this->faker->optional(0.9)->numerify('##########'), // 90% chance has NIDN
            'leader_name' => $this->faker->name(),
            'pddikti_code_pt' => $this->faker->optional(0.8)->numerify('###'), // 80% chance has PDDIKTI code
            'institution' => $this->faker->company(),
            'skema_abbreviation' => $this->faker->randomElement(['PDUPT', 'PD', 'PKM', 'P3MI', 'RKAT', 'RKPD']),
            'skema_name' => $this->faker->randomElement([
                'Penelitian Dosen Pemula Unggulan Perguruan Tinggi',
                'Penelitian Disertasi Doktor',
                'Pengabdian kepada Masyarakat',
                'Program Pengembangan Media dan Informasi',
                'Rencana Kerja dan Anggaran Tahunan',
                'Rencana Kerja dan Pengembangan'
            ]),
            'first_proposal_year' => $this->faker->numberBetween(2018, 2024),
            'proposed_year_of_activities' => $this->faker->numberBetween(2020, 2025),
            'year_of_activity' => $this->faker->numberBetween(2020, 2025),
            'duration_of_activity' => $this->faker->numberBetween(1, 4),
            'proposal_status' => $this->faker->randomElement([
                'draft', 'submitted', 'approved', 'rejected', 'revision', 'funded', 'completed'
            ]),
            'funds_approved' => $this->faker->optional(0.7)->randomFloat(2, 1_000_000, 50_000_000), // 70% chance has approved funds
            'sinta_affiliation_id' => $this->faker->optional(0.6)->numerify('###'), // 60% chance has SINTA ID
            'funds_institution' => $this->faker->optional(0.8)->company(), // 80% chance has funding institution
            'target_tkt_level' => $this->faker->numberBetween(1, 9),
            'hibah_program' => $this->faker->randomElement([
                'Penelitian Dasar', 'Penelitian Terapan', 'Pengembangan Teknologi',
                'Penelitian Kerjasama', 'Penelitian Mandiri'
            ]),
            'focus_area' => $this->faker->randomElement([
                'Teknologi Informasi', 'Kesehatan', 'Pendidikan', 'Lingkungan',
                'Ekonomi', 'Sosial', 'Budaya', 'Pertanian', 'Energi'
            ]),
            'fund_source_category' => $this->faker->randomElement([
                'Pemerintah', 'Swasta', 'Internasional', 'Mandiri', 'Kerjasama'
            ]),
            'fund_source' => $this->faker->randomElement([
                'DIKTI', 'Kemenristekdikti', 'LPDP', 'Bank Mandiri', 'BRI', 'BNI',
                'World Bank', 'ADB', 'Ford Foundation', 'Dana Internal'
            ]),
            'country_fund_source' => $this->faker->randomElement([
                'Indonesia', 'Amerika Serikat', 'Jepang', 'Jerman', 'Australia',
                'Belanda', 'Korea Selatan', 'Singapura', 'Malaysia'
            ]),
        ];
    }
}
