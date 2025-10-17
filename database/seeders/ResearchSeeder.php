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
        // Get all dosen for reference
        $dosens = Dosen::all();

        if ($dosens->isEmpty()) {
            $this->command->warn('Tidak ada data dosen. Jalankan DosenSeeder terlebih dahulu.');
            return;
        }

        // Sample research data with realistic titles and details
        $researchData = [
            [
                'judul' => 'Pengembangan Sistem Informasi Akademik Berbasis Cloud Computing untuk Meningkatkan Efisiensi Administrasi Akademik',
                'bidang' => 'Teknologi Informasi',
                'tahun' => 2024,
                'sumber_dana' => 'Hibah DIKTI',
                'jumlah_dana' => 150000000,
                'abstrak' => 'Penelitian ini bertujuan mengembangkan sistem informasi akademik yang berbasis cloud computing untuk meningkatkan efisiensi administrasi akademik di perguruan tinggi. Sistem ini akan mengintegrasikan berbagai aspek administrasi mulai dari pendaftaran mahasiswa, pengelolaan kurikulum, hingga monitoring kegiatan akademik secara real-time.',
                'luaran' => 'Artikel Jurnal',
                'status' => 'ongoing',
                'progress_percentage' => 75,
                'kategori' => 'penelitian_terapan',
                'tingkat' => 'nasional',
                'hibah_kompetitif' => true,
                'ketua_peneliti' => 'Dr. Ahmad Surya, S.Kom., M.Kom.',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_target_selesai' => '2024-12-31',
                'keywords' => 'cloud computing, sistem informasi akademik, efisiensi administrasi, digital transformation',
                'jenis_publikasi' => 'jurnal_nasional',
                'jurnal_conference' => 'Jurnal Teknologi Informasi',
                'dampak_manfaat' => 'Sistem ini diharapkan dapat mengurangi waktu administrasi hingga 60% dan meningkatkan akurasi data akademik.',
            ],
            [
                'judul' => 'Analisis Dampak Pandemi COVID-19 terhadap Kualitas Pembelajaran Daring di Perguruan Tinggi',
                'bidang' => 'Pendidikan',
                'tahun' => 2023,
                'sumber_dana' => 'Hibah Internal Universitas',
                'jumlah_dana' => 75000000,
                'abstrak' => 'Penelitian ini menganalisis dampak pandemi COVID-19 terhadap kualitas pembelajaran daring di perguruan tinggi. Fokus penelitian meliputi efektivitas metode pembelajaran online, tingkat partisipasi mahasiswa, serta tantangan yang dihadapi oleh dosen dan mahasiswa dalam proses pembelajaran jarak jauh.',
                'luaran' => 'Artikel Jurnal',
                'status' => 'completed',
                'progress_percentage' => 100,
                'kategori' => 'penelitian_dasar',
                'tingkat' => 'nasional',
                'hibah_kompetitif' => false,
                'ketua_peneliti' => 'Prof. Dr. Siti Nurhaliza, M.Pd.',
                'tanggal_mulai' => '2023-03-01',
                'tanggal_selesai' => '2023-11-30',
                'tanggal_target_selesai' => '2023-11-30',
                'keywords' => 'pembelajaran daring, COVID-19, pendidikan tinggi, efektivitas pembelajaran',
                'doi' => '10.1234/jurnal.2023.001',
                'jenis_publikasi' => 'jurnal_internasional',
                'jurnal_conference' => 'International Journal of Education Technology',
                'dampak_manfaat' => 'Hasil penelitian ini dapat menjadi acuan untuk pengembangan kebijakan pembelajaran hybrid pasca pandemi.',
            ],
            [
                'judul' => 'Optimasi Produksi Bioetanol dari Limbah Pertanian Menggunakan Teknik Fermentasi Modern',
                'bidang' => 'Teknik Kimia',
                'tahun' => 2024,
                'sumber_dana' => 'Hibah Kemenristekdikti',
                'jumlah_dana' => 300000000,
                'abstrak' => 'Penelitian ini fokus pada optimasi produksi bioetanol dari limbah pertanian seperti jerami padi dan tongkol jagung menggunakan teknik fermentasi modern. Penelitian meliputi isolasi mikroorganisme, optimasi kondisi fermentasi, serta purifikasi produk akhir untuk mendapatkan bioetanol berkualitas tinggi.',
                'luaran' => 'HKI Paten',
                'status' => 'ongoing',
                'progress_percentage' => 60,
                'kategori' => 'penelitian_terapan',
                'tingkat' => 'internasional',
                'hibah_kompetitif' => true,
                'ketua_peneliti' => 'Dr. Ir. Bambang Supriyanto, M.Sc.',
                'tanggal_mulai' => '2024-02-01',
                'tanggal_target_selesai' => '2025-01-31',
                'keywords' => 'bioetanol, limbah pertanian, fermentasi, energi terbarukan',
                'jenis_publikasi' => 'jurnal_internasional',
                'jurnal_conference' => 'Journal of Chemical Engineering',
                'luaran_tambahan' => 'Pengajuan paten untuk metode fermentasi baru',
                'dampak_manfaat' => 'Produksi bioetanol dari limbah dapat mengurangi ketergantungan pada bahan bakar fosil dan mengelola limbah pertanian.',
            ],
            [
                'judul' => 'Pengembangan Model Pembelajaran Matematika Berbasis Problem Solving untuk Meningkatkan Kemampuan Berpikir Kritis Siswa',
                'bidang' => 'Pendidikan',
                'tahun' => 2023,
                'sumber_dana' => 'Mandiri',
                'jumlah_dana' => 25000000,
                'abstrak' => 'Penelitian ini bertujuan mengembangkan model pembelajaran matematika berbasis problem solving untuk meningkatkan kemampuan berpikir kritis siswa SMA. Model ini akan diuji efektivitasnya melalui eksperimen kuasi dengan melibatkan siswa sebagai subjek penelitian.',
                'luaran' => 'Buku',
                'status' => 'completed',
                'progress_percentage' => 100,
                'kategori' => 'pengembangan',
                'tingkat' => 'lokal',
                'hibah_kompetitif' => false,
                'ketua_peneliti' => 'Dr. Maya Sari, M.Pd.',
                'tanggal_mulai' => '2023-01-15',
                'tanggal_selesai' => '2023-08-30',
                'tanggal_target_selesai' => '2023-08-30',
                'keywords' => 'pembelajaran matematika, problem solving, berpikir kritis, model pembelajaran',
                'jenis_publikasi' => 'book_chapter',
                'jurnal_conference' => 'Buku Panduan Pembelajaran Matematika',
                'dampak_manfaat' => 'Model pembelajaran ini dapat diterapkan di sekolah-sekolah untuk meningkatkan kualitas pembelajaran matematika.',
            ],
            [
                'judul' => 'Sistem Monitoring Kualitas Air Sungai Berbasis IoT untuk Pengendalian Pencemaran Industri',
                'bidang' => 'Teknik Elektro',
                'tahun' => 2024,
                'sumber_dana' => 'Kerjasama Industri',
                'jumlah_dana' => 200000000,
                'abstrak' => 'Penelitian ini mengembangkan sistem monitoring kualitas air sungai secara real-time menggunakan teknologi Internet of Things (IoT). Sistem terdiri dari sensor-sensor kualitas air, modul komunikasi, dan dashboard monitoring yang dapat diakses melalui web dan mobile.',
                'luaran' => 'Prototipe',
                'status' => 'ongoing',
                'progress_percentage' => 45,
                'kategori' => 'penelitian_terapan',
                'tingkat' => 'nasional',
                'hibah_kompetitif' => false,
                'ketua_peneliti' => 'Ir. Hendro Wicaksono, M.T.',
                'tanggal_mulai' => '2024-03-01',
                'tanggal_target_selesai' => '2024-11-30',
                'keywords' => 'IoT, monitoring kualitas air, pencemaran industri, sensor',
                'jenis_publikasi' => 'conference_nasional',
                'jurnal_conference' => 'Seminar Nasional Teknologi Informasi',
                'luaran_tambahan' => 'Prototipe sistem monitoring siap pakai',
                'dampak_manfaat' => 'Sistem ini dapat membantu pemerintah dan industri dalam pengendalian pencemaran air sungai.',
            ],
            [
                'judul' => 'Studi Etnobotani Tumbuhan Obat Tradisional di Daerah Pegunungan Jawa Barat',
                'bidang' => 'Biologi',
                'tahun' => 2023,
                'sumber_dana' => 'Hibah DIKTI',
                'jumlah_dana' => 120000000,
                'abstrak' => 'Penelitian ini melakukan studi etnobotani terhadap tumbuhan obat tradisional yang digunakan oleh masyarakat di daerah pegunungan Jawa Barat. Penelitian meliputi identifikasi spesies, dokumentasi penggunaan tradisional, serta potensi pengembangan menjadi produk herbal modern.',
                'luaran' => 'Artikel Jurnal',
                'status' => 'completed',
                'progress_percentage' => 100,
                'kategori' => 'penelitian_dasar',
                'tingkat' => 'nasional',
                'hibah_kompetitif' => true,
                'ketua_peneliti' => 'Dr. Dewi Lestari, M.Si.',
                'tanggal_mulai' => '2023-04-01',
                'tanggal_selesai' => '2023-12-15',
                'tanggal_target_selesai' => '2023-12-15',
                'keywords' => 'etnobotani, tumbuhan obat, pegunungan Jawa Barat, pengobatan tradisional',
                'doi' => '10.5678/ethnobotany.2023.045',
                'jenis_publikasi' => 'jurnal_nasional',
                'jurnal_conference' => 'Jurnal Etnobotani Indonesia',
                'dampak_manfaat' => 'Hasil penelitian dapat mendukung pengembangan industri herbal dan pelestarian pengetahuan tradisional.',
            ],
            [
                'judul' => 'Pengembangan Algoritma Machine Learning untuk Prediksi Risiko Diabetes Melitus Tipe 2',
                'bidang' => 'Teknologi Informasi',
                'tahun' => 2024,
                'sumber_dana' => 'Hibah LPDP',
                'jumlah_dana' => 180000000,
                'abstrak' => 'Penelitian ini mengembangkan algoritma machine learning untuk prediksi risiko diabetes melitus tipe 2 berdasarkan data klinis dan gaya hidup pasien. Algoritma akan dilatih menggunakan dataset kesehatan dan dievaluasi performanya untuk aplikasi skrining dini.',
                'luaran' => 'Software',
                'status' => 'ongoing',
                'progress_percentage' => 80,
                'kategori' => 'penelitian_terapan',
                'tingkat' => 'internasional',
                'hibah_kompetitif' => true,
                'ketua_peneliti' => 'Dr. Rina Sari, S.Kom., M.Kom.',
                'tanggal_mulai' => '2024-01-20',
                'tanggal_target_selesai' => '2024-12-20',
                'keywords' => 'machine learning, diabetes, prediksi risiko, algoritma',
                'jenis_publikasi' => 'jurnal_internasional',
                'jurnal_conference' => 'Journal of Medical Informatics',
                'luaran_tambahan' => 'Aplikasi web untuk skrining diabetes',
                'dampak_manfaat' => 'Model prediksi dapat membantu deteksi dini diabetes dan mencegah komplikasi penyakit.',
            ],
            [
                'judul' => 'Evaluasi Efektivitas Program Pengembangan Karir Dosen dalam Meningkatkan Kualitas Pendidikan',
                'bidang' => 'Pendidikan',
                'tahun' => 2023,
                'sumber_dana' => 'Hibah Internal Universitas',
                'jumlah_dana' => 50000000,
                'abstrak' => 'Penelitian ini mengevaluasi efektivitas program pengembangan karir dosen dalam meningkatkan kualitas pendidikan di perguruan tinggi. Evaluasi mencakup aspek kompetensi pedagogik, profesional, dan sosial dosen serta dampaknya terhadap mutu pembelajaran.',
                'luaran' => 'Artikel Jurnal',
                'status' => 'completed',
                'progress_percentage' => 100,
                'kategori' => 'penelitian_dasar',
                'tingkat' => 'lokal',
                'hibah_kompetitif' => false,
                'ketua_peneliti' => 'Prof. Dr. Ahmad Yani, M.Pd.',
                'tanggal_mulai' => '2023-02-01',
                'tanggal_selesai' => '2023-09-30',
                'tanggal_target_selesai' => '2023-09-30',
                'keywords' => 'pengembangan karir dosen, kualitas pendidikan, evaluasi program',
                'jenis_publikasi' => 'jurnal_nasional',
                'jurnal_conference' => 'Jurnal Pendidikan Tinggi',
                'dampak_manfaat' => 'Hasil evaluasi dapat digunakan untuk perbaikan program pengembangan dosen.',
            ],
        ];

        // Create research records
        foreach ($researchData as $data) {
            // Assign random dosen
            $data['dosen_id'] = $dosens->random()->id;

            // Add some team members (optional)
            if (rand(1, 3) === 1) { // 33% chance
                $teamMembers = $dosens->random(min(3, $dosens->count()))->pluck('id')->toArray();
                $data['tim_peneliti'] = $teamMembers;
            }

            Research::create($data);
        }

        // Create additional random research using factory
        $additionalCount = max(0, 50 - count($researchData)); // Aim for total 50 records
        if ($additionalCount > 0) {
            Dosen::all()->each(function ($dosen) use ($additionalCount) {
                $count = rand(1, 3); // 1-3 research per dosen
                Research::factory()->count($count)->create(['dosen_id' => $dosen->id]);
            });
        }

        $this->command->info('Berhasil membuat ' . Research::count() . ' data penelitian');
    }
}
