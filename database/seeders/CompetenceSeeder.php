<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Dosen;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data dosen terlebih dahulu
        $dosens = Dosen::all();

        if ($dosens->isEmpty()) {
            $this->command->info('Tidak ada data dosen. Menjalankan DosenSeeder terlebih dahulu...');
            $this->call(DosenSeeder::class);
            $dosens = Dosen::all();
        }

        // Sample competence data
        $competenceData = [
            [
                'dosen_id' => $dosens->first()->id,
                'jenjang_pendidikan' => 'S3',
                'nama_perguruan_tinggi' => 'Universitas Indonesia',
                'tahun_lulus' => 2015,
                'bidang_keilmuan' => 'Teknologi Informasi',
                'keahlian_bidang' => 'Machine Learning, Data Science, Artificial Intelligence',
                'metodologi_pengajaran' => 'Project-Based Learning, Problem-Based Learning, Flipped Classroom',
                'sertifikat_pendidik' => 'Sertifikat Pendidik Profesional',
                'status_sertifikasi' => 'aktif',
                'nomor_sertifikat' => 'SP-2024-001',
                'tanggal_terbit' => '2024-01-15',
                'tanggal_kadaluarsa' => '2029-01-15',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(1)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S2',
                'nama_perguruan_tinggi' => 'Institut Teknologi Bandung',
                'tahun_lulus' => 2018,
                'bidang_keilmuan' => 'Teknik Elektro',
                'keahlian_bidang' => 'Sistem Kontrol, Robotika, Internet of Things',
                'metodologi_pengajaran' => 'Experiential Learning, Case Study Method, Collaborative Learning',
                'sertifikat_pendidik' => 'Sertifikat Pendidik',
                'status_sertifikasi' => 'aktif',
                'nomor_sertifikat' => 'SP-2024-002',
                'tanggal_terbit' => '2024-02-20',
                'tanggal_kadaluarsa' => '2029-02-20',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(2)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S3',
                'nama_perguruan_tinggi' => 'Universitas Gadjah Mada',
                'tahun_lulus' => 2012,
                'bidang_keilmuan' => 'Manajemen',
                'keahlian_bidang' => 'Strategic Management, Human Resource Management, Organizational Behavior',
                'metodologi_pengajaran' => 'Case Method, Role Playing, Group Discussion',
                'sertifikat_pendidik' => 'Sertifikat Pendidik Profesional',
                'status_sertifikasi' => 'aktif',
                'nomor_sertifikat' => 'SP-2024-003',
                'tanggal_terbit' => '2024-03-10',
                'tanggal_kadaluarsa' => '2029-03-10',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(3)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S2',
                'nama_perguruan_tinggi' => 'Universitas Diponegoro',
                'tahun_lulus' => 2016,
                'bidang_keilmuan' => 'Pendidikan Bahasa',
                'keahlian_bidang' => 'Teaching English as a Foreign Language, Linguistics, Literature',
                'metodologi_pengajaran' => 'Communicative Language Teaching, Task-Based Learning, Direct Method',
                'sertifikat_pendidik' => 'Sertifikat Pendidik',
                'status_sertifikasi' => 'proses_perpanjangan',
                'nomor_sertifikat' => 'SP-2024-004',
                'tanggal_terbit' => '2024-01-25',
                'tanggal_kadaluarsa' => '2024-12-31',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(4)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S3',
                'nama_perguruan_tinggi' => 'Universitas Airlangga',
                'tahun_lulus' => 2019,
                'bidang_keilmuan' => 'Kesehatan Masyarakat',
                'keahlian_bidang' => 'Epidemiology, Public Health Policy, Health Promotion',
                'metodologi_pengajaran' => 'Problem-Based Learning, Community-Based Learning, Research-Based Teaching',
                'sertifikat_pendidik' => 'Sertifikat Pendidik Profesional',
                'status_sertifikasi' => 'aktif',
                'nomor_sertifikat' => 'SP-2024-005',
                'tanggal_terbit' => '2024-04-05',
                'tanggal_kadaluarsa' => '2029-04-05',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(5)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S2',
                'nama_perguruan_tinggi' => 'Universitas Sebelas Maret',
                'tahun_lulus' => 2017,
                'bidang_keilmuan' => 'Teknik Sipil',
                'keahlian_bidang' => 'Structural Engineering, Construction Management, Geotechnical Engineering',
                'metodologi_pengajaran' => 'Project-Based Learning, Laboratory Work, Field Study',
                'sertifikat_pendidik' => 'Sertifikat Pendidik',
                'status_sertifikasi' => 'tidak_aktif',
                'nomor_sertifikat' => 'SP-2024-006',
                'tanggal_terbit' => '2024-02-15',
                'tanggal_kadaluarsa' => '2024-08-15',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(6)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S3',
                'nama_perguruan_tinggi' => 'Universitas Padjadjaran',
                'tahun_lulus' => 2014,
                'bidang_keilmuan' => 'Ekonomi',
                'keahlian_bidang' => 'Development Economics, International Trade, Macroeconomics',
                'metodologi_pengajaran' => 'Lecture Discussion, Case Study, Seminar Method',
                'sertifikat_pendidik' => 'Sertifikat Pendidik Profesional',
                'status_sertifikasi' => 'aktif',
                'nomor_sertifikat' => 'SP-2024-007',
                'tanggal_terbit' => '2024-03-20',
                'tanggal_kadaluarsa' => '2029-03-20',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'dosen_id' => $dosens->skip(7)->first()->id ?? $dosens->first()->id,
                'jenjang_pendidikan' => 'S2',
                'nama_perguruan_tinggi' => 'Universitas Hasanuddin',
                'tahun_lulus' => 2020,
                'bidang_keilmuan' => 'Pertanian',
                'keahlian_bidang' => 'Agribusiness, Agricultural Economics, Sustainable Agriculture',
                'metodologi_pengajaran' => 'Field Practice, Group Project, Experiential Learning',
                'sertifikat_pendidik' => 'Sertifikat Pendidik',
                'status_sertifikasi' => 'aktif',
                'nomor_sertifikat' => 'SP-2024-008',
                'tanggal_terbit' => '2024-05-10',
                'tanggal_kadaluarsa' => '2029-05-10',
                'penyelenggara_sertifikasi' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
        ];

        // Create competence records
        foreach ($competenceData as $data) {
            Competence::create($data);
        }

        // Create additional random competence using factory if available
        $additionalCount = max(0, 15 - count($competenceData)); // Aim for total 15 records
        if ($additionalCount > 0 && method_exists(Competence::class, 'factory')) {
            Competence::factory($additionalCount)->create();
        }

        $this->command->info('Berhasil membuat ' . Competence::count() . ' data kompetensi dosen');
    }
}
