<?php

namespace Database\Seeders;

use App\Models\Haki;
use Illuminate\Database\Seeder;

class HakiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample HAKI data with realistic titles and details
        $hakiData = [
            [
                'judul' => 'Sistem Informasi Akademik Terintegrasi Berbasis Cloud Computing',
                'jenis_haki' => 'hak_cipta',
                'nomor_pendaftaran' => 'EC002024001',
                'nomor_publikasi' => 'EC002024001',
                'tanggal_daftar' => '2024-01-15',
                'tanggal_publikasi' => '2024-03-20',
                'tanggal_granted' => '2024-06-15',
                'status' => 'granted',
                'deskripsi' => 'Sistem informasi akademik yang terintegrasi dengan teknologi cloud computing untuk meningkatkan efisiensi administrasi akademik di perguruan tinggi.',
                'inventor' => ['Dr. Ahmad Surya, S.Kom., M.Kom.', 'Prof. Dr. Budi Santoso, M.T.', 'Ir. Maya Sari, M.Kom.'],
                'klasifikasi' => 'Software',
                'bidang_teknologi' => 'Teknologi Informasi',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'nomor_sertifikat' => '000123456',
                'tanggal_berlaku_mulai' => '2024-06-15',
                'tanggal_berlaku_selesai' => '2034-06-15',
                'diperpanjang' => false,
                'catatan' => 'HAKI telah terdaftar dan mendapat sertifikat',
            ],
            [
                'judul' => 'Aplikasi Mobile Learning untuk Pembelajaran Matematika Interaktif',
                'jenis_haki' => 'hak_cipta',
                'nomor_pendaftaran' => 'EC002024002',
                'nomor_publikasi' => 'EC002024002',
                'tanggal_daftar' => '2024-02-01',
                'tanggal_publikasi' => '2024-04-10',
                'status' => 'dipublikasi',
                'deskripsi' => 'Aplikasi mobile yang dirancang khusus untuk pembelajaran matematika dengan fitur interaktif, kuis, dan tracking progress siswa.',
                'inventor' => ['Dr. Siti Nurhaliza, M.Pd.', 'Ahmad Rahman, S.Pd.'],
                'klasifikasi' => 'Software',
                'bidang_teknologi' => 'Pendidikan',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'catatan' => 'Sedang dalam proses pemeriksaan substantif',
            ],
            [
                'judul' => 'Metode Produksi Bioetanol dari Limbah Pertanian dengan Teknik Fermentasi Modern',
                'jenis_haki' => 'paten',
                'nomor_pendaftaran' => 'P002024003',
                'nomor_publikasi' => 'P002024003',
                'tanggal_daftar' => '2024-01-20',
                'tanggal_publikasi' => '2024-05-15',
                'status' => 'dalam_proses',
                'deskripsi' => 'Metode inovatif untuk memproduksi bioetanol dari limbah pertanian menggunakan teknik fermentasi modern dengan katalis biologis.',
                'inventor' => ['Dr. Ir. Bambang Supriyanto, M.Sc.', 'Prof. Dr. Dewi Lestari, M.Si.'],
                'klasifikasi' => 'Proses Produksi',
                'bidang_teknologi' => 'Teknik Kimia',
                'kantor_kekayaan_intelektual' => 'Kantor Paten Indonesia',
                'catatan' => 'Dalam tahap pemeriksaan paten',
            ],
            [
                'judul' => 'Logo dan Identitas Visual LPPM LPKIA',
                'jenis_haki' => 'merek',
                'nomor_pendaftaran' => 'M002024004',
                'nomor_publikasi' => 'M002024004',
                'tanggal_daftar' => '2024-03-01',
                'tanggal_publikasi' => '2024-06-01',
                'tanggal_granted' => '2024-09-15',
                'status' => 'granted',
                'deskripsi' => 'Logo dan identitas visual yang mewakili Lembaga Penelitian dan Pengabdian kepada Masyarakat LPKIA.',
                'inventor' => ['Tim Desain LPPM LPKIA'],
                'klasifikasi' => 'Merek',
                'bidang_teknologi' => 'Desain Grafis',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'nomor_sertifikat' => '000234567',
                'tanggal_berlaku_mulai' => '2024-09-15',
                'tanggal_berlaku_selesai' => '2034-09-15',
                'diperpanjang' => false,
                'catatan' => 'Merek telah terdaftar dan mendapat sertifikat',
            ],
            [
                'judul' => 'Desain Alat Ukur Kualitas Air Otomatis Berbasis IoT',
                'jenis_haki' => 'desain_industri',
                'nomor_pendaftaran' => 'D002024005',
                'nomor_publikasi' => 'D002024005',
                'tanggal_daftar' => '2024-02-15',
                'tanggal_publikasi' => '2024-05-20',
                'status' => 'dipublikasi',
                'deskripsi' => 'Desain alat ukur kualitas air otomatis yang terintegrasi dengan teknologi Internet of Things untuk monitoring real-time.',
                'inventor' => ['Ir. Hendro Wicaksono, M.T.', 'Dr. Rina Sari, S.Kom., M.Kom.'],
                'klasifikasi' => 'Alat Ukur',
                'bidang_teknologi' => 'Teknik Elektro',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'catatan' => 'Sedang dalam proses pemeriksaan desain',
            ],
            [
                'judul' => 'Buku Panduan Pembelajaran Matematika Berbasis Problem Solving',
                'jenis_haki' => 'hak_cipta',
                'nomor_pendaftaran' => 'EC002024006',
                'nomor_publikasi' => 'EC002024006',
                'tanggal_daftar' => '2024-01-10',
                'tanggal_publikasi' => '2024-03-25',
                'tanggal_granted' => '2024-07-10',
                'status' => 'granted',
                'deskripsi' => 'Buku panduan lengkap untuk pembelajaran matematika dengan pendekatan problem solving yang inovatif.',
                'inventor' => ['Dr. Maya Sari, M.Pd.', 'Prof. Dr. Ahmad Yani, M.Pd.'],
                'klasifikasi' => 'Buku',
                'bidang_teknologi' => 'Pendidikan',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'nomor_sertifikat' => '000345678',
                'tanggal_berlaku_mulai' => '2024-07-10',
                'tanggal_berlaku_selesai' => '2034-07-10',
                'diperpanjang' => false,
                'catatan' => 'Hak cipta telah terdaftar',
            ],
            [
                'judul' => 'Algoritma Machine Learning untuk Deteksi Dini Diabetes Melitus',
                'jenis_haki' => 'hak_cipta',
                'nomor_pendaftaran' => 'EC002024007',
                'nomor_publikasi' => 'EC002024007',
                'tanggal_daftar' => '2024-03-15',
                'status' => 'diajukan',
                'deskripsi' => 'Algoritma machine learning yang dikembangkan untuk deteksi dini diabetes melitus berdasarkan analisis data kesehatan.',
                'inventor' => ['Dr. Rina Sari, S.Kom., M.Kom.', 'Dr. Hendro Wicaksono, M.T.'],
                'klasifikasi' => 'Software',
                'bidang_teknologi' => 'Kesehatan',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'catatan' => 'Baru diajukan, dalam proses pemeriksaan formalitas',
            ],
            [
                'judul' => 'Metode Pengembangan Karir Dosen Berbasis Kompetensi',
                'jenis_haki' => 'hak_cipta',
                'nomor_pendaftaran' => 'EC002024008',
                'nomor_publikasi' => 'EC002024008',
                'tanggal_daftar' => '2024-02-20',
                'tanggal_publikasi' => '2024-04-30',
                'status' => 'dalam_proses',
                'deskripsi' => 'Metode sistematis untuk pengembangan karir dosen berdasarkan kompetensi dan kebutuhan institusi.',
                'inventor' => ['Prof. Dr. Ahmad Yani, M.Pd.', 'Dr. Siti Nurhaliza, M.Pd.'],
                'klasifikasi' => 'Metode',
                'bidang_teknologi' => 'Pendidikan',
                'kantor_kekayaan_intelektual' => 'Direktorat Jenderal Kekayaan Intelektual',
                'catatan' => 'Dalam proses pemeriksaan substantif',
            ],
        ];

        // Create HAKI records
        foreach ($hakiData as $data) {
            $haki = Haki::create($data);
            // Generate slug if not provided
            if (!$haki->slug) {
                $haki->slug = $haki->generateUniqueSlug($haki->judul);
                $haki->save();
            }
        }

        // Create additional random HAKI using factory
        $additionalCount = max(0, 25 - count($hakiData)); // Aim for total 25 records
        if ($additionalCount > 0) {
            Haki::factory($additionalCount)->create();
        }

        $this->command->info('Berhasil membuat ' . Haki::count() . ' data HAKI');
    }
}
