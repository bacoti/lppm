<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-2 years', '+1 year');
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s') . ' +6 months');

        return [
            'dosen_id' => Dosen::factory(),
            'judul' => $this->faker->sentence(8, true),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'bidang' => $this->faker->randomElement([
                'Teknologi Informasi',
                'Pendidikan',
                'Pertanian',
                'Kesehatan',
                'Ekonomi',
                'Sosial',
                'Lingkungan',
                'Infrastruktur'
            ]),
            'jenis_pengabdian' => $this->faker->randomElement([
                'pengabdian_masyarakat',
                'pengembangan_masyarakat',
                'pemberdayaan_masyarakat',
                'kemitraan',
                'lainnya'
            ]),
            'status' => $this->faker->randomElement([
                'draft',
                'submitted',
                'approved',
                'ongoing',
                'completed',
                'reported'
            ]),
            'progress_percentage' => $this->faker->numberBetween(0, 100),
            'ketua_pengabdian' => $this->faker->name(),
            'tim_pelaksana' => Dosen::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray(),
            'anggota_eksternal' => $this->faker->optional(0.7)->sentence(4),
            'mitra_kerjasama' => $this->faker->optional(0.8)->company(),
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $this->faker->optional(0.9)->dateTimeBetween($startDate, '+1 year'),
            'tanggal_target_selesai' => $this->faker->dateTimeBetween($startDate, '+1 year'),
            'durasi_hari' => $this->faker->numberBetween(30, 365),
            'lokasi' => $this->faker->city(),
            'alamat_lengkap' => $this->faker->address(),
            'kelompok_sasaran' => $this->faker->randomElement([
                'Masyarakat Umum',
                'Pelajar SMA',
                'Mahasiswa',
                'Petani',
                'Pedagang Kecil',
                'Ibu Rumah Tangga',
                'Penyandang Disabilitas',
                'Lansia'
            ]),
            'jumlah_peserta' => $this->faker->numberBetween(10, 200),
            'kriteria_peserta' => $this->faker->optional(0.6)->sentence(6),
            'sumber_dana' => $this->faker->randomElement([
                'Mandiri',
                'Hibah Internal',
                'Hibah Eksternal',
                'Kemitraan',
                'CSR'
            ]),
            'jumlah_dana' => $this->faker->numberBetween(500000, 50000000),
            'hibah_kompetitif' => $this->faker->boolean(30),
            'tujuan' => $this->faker->paragraph(),
            'luaran' => $this->faker->sentences(3, true),
            'dampak_manfaat' => $this->faker->paragraphs(2, true),
            'indikator_keberhasilan' => $this->faker->sentences(2, true),
            'kendala_hambatan' => $this->faker->optional(0.5)->paragraph(),
            'link_dokumentasi' => $this->faker->optional(0.4)->url(),
            'nomor_sk' => $this->faker->optional(0.7)->bothify('??/??/####/??'),
            'tanggal_sk' => $this->faker->optional(0.7)->dateTimeBetween('-1 year', 'now'),
            'evaluasi_kegiatan' => $this->faker->optional(0.6)->paragraph(),
            'tingkat_kepuasan' => $this->faker->optional(0.6)->randomElement([
                'sangat_baik',
                'baik',
                'cukup',
                'kurang',
                'sangat_kurang'
            ]),
            'rekomendasi' => $this->faker->optional(0.5)->paragraph(),
        ];
    }

    /**
     * Indicate that the service is in draft status.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'progress_percentage' => 0,
        ]);
    }

    /**
     * Indicate that the service is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'progress_percentage' => 100,
            'tanggal_selesai' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the service is ongoing.
     */
    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ongoing',
            'progress_percentage' => $this->faker->numberBetween(10, 90),
            'tanggal_mulai' => $this->faker->dateTimeBetween('-6 months', '-1 month'),
        ]);
    }

    /**
     * Indicate that the service has competitive grant.
     */
    public function hibahKompetitif(): static
    {
        return $this->state(fn (array $attributes) => [
            'hibah_kompetitif' => true,
            'sumber_dana' => 'Hibah Kompetitif',
        ]);
    }
}