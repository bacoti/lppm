<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Haki>
 */
class HakiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisHaki = ['paten', 'merek', 'hak_cipta', 'desain_industri', 'rahasia_dagang'];
        $status = ['draft', 'diajukan', 'dalam_proses', 'dipublikasi', 'granted', 'ditolak'];
        $jenis = fake()->randomElement($jenisHaki);
        
        return [
            'judul' => fake()->sentence(4),
            'jenis_haki' => $jenis,
            'nomor_pendaftaran' => 'P' . fake()->year() . fake()->randomNumber(6),
            'nomor_publikasi' => 'WO' . fake()->year() . '/' . fake()->randomNumber(6),
            'tanggal_daftar' => fake()->dateTimeBetween('-3 years', 'now'),
            'tanggal_publikasi' => fake()->optional()->dateTimeBetween('-2 years', '+6 months'),
            'tanggal_granted' => fake()->optional()->dateTimeBetween('-1 year', '+1 year'),
            'status' => fake()->randomElement($status),
            'deskripsi' => fake()->paragraph(3),
            'inventor' => [
                fake()->name(),
                fake()->name(),
                fake()->optional()->name()
            ],
            'klasifikasi' => $jenis === 'paten' ? fake()->bothify('A##?##/##') : null,
            'bidang_teknologi' => fake()->randomElement([
                'Teknologi Informasi',
                'Biomedical Engineering',
                'Material Science',
                'Mechanical Engineering',
                'Chemical Engineering',
                'Electrical Engineering'
            ]),
            'kantor_kekayaan_intelektual' => fake()->randomElement([
                'DJKI Indonesia',
                'USPTO',
                'EPO',
                'WIPO'
            ]),
            'nomor_sertifikat' => fake()->optional()->bothify('IDP######'),
            'tanggal_berlaku_mulai' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'tanggal_berlaku_selesai' => fake()->optional()->dateTimeBetween('now', '+20 years'),
            'diperpanjang' => fake()->boolean(20),
            'catatan' => fake()->optional()->sentence(),
        ];
    }
}
