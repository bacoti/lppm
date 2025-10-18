<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class ComprehensiveDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dosen dengan informasi lengkap
        $dosenData = [
            [
                'nidn_nip' => '197001011999031001',
                'nama_lengkap' => 'Dr. Ahmad Surya, S.Kom., M.Kom.',
                'gelar_akademik' => 'Dr.',
                'tanggal_lahir' => '1970-01-01',
                'tempat_lahir' => 'Jakarta',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'role' => 'lecturer',
                'affiliation' => 'Universitas Indonesia',
                'email' => 'ahmad.surya@ui.ac.id',
                'scopus_id' => '1234567890',
                'google_id' => 'Ahmad-Surya-1234',
                'wos_researcher_id' => 'ABC-1234-5678',
                'garuda_id' => '12345678',
                'level_department' => 's3',
                'department' => 'Teknik Informatika',
                'academic_grade' => 'Lektor Kepala',
                'country' => 'Indonesia',
                'id_card' => '3171234567890001',
            ],
            [
                'nidn_nip' => '198002021999032002',
                'nama_lengkap' => 'Prof. Dr. Budi Santoso, M.T.',
                'gelar_akademik' => 'Prof. Dr.',
                'tanggal_lahir' => '1980-02-02',
                'tempat_lahir' => 'Bandung',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Asia Afrika No. 45, Bandung',
                'role' => 'researcher',
                'affiliation' => 'Institut Teknologi Bandung',
                'email' => 'budi.santoso@itb.ac.id',
                'scopus_id' => '2345678901',
                'google_id' => 'Budi-Santoso-5678',
                'wos_researcher_id' => 'DEF-5678-9012',
                'garuda_id' => '23456789',
                'level_department' => 's3',
                'department' => 'Teknik Elektro',
                'academic_grade' => 'Guru Besar',
                'country' => 'Indonesia',
                'id_card' => '3271234567890002',
            ],
            [
                'nidn_nip' => '198503031999033003',
                'nama_lengkap' => 'Ir. Maya Sari, M.Kom.',
                'gelar_akademik' => 'Ir.',
                'tanggal_lahir' => '1985-03-03',
                'tempat_lahir' => 'Surabaya',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Tunjungan No. 67, Surabaya',
                'role' => 'lecturer',
                'affiliation' => 'Universitas Airlangga',
                'email' => 'maya.sari@unair.ac.id',
                'scopus_id' => '3456789012',
                'google_id' => 'Maya-Sari-9012',
                'wos_researcher_id' => 'GHI-9012-3456',
                'garuda_id' => '34567890',
                'level_department' => 's2',
                'department' => 'Sistem Informasi',
                'academic_grade' => 'Lektor',
                'country' => 'Indonesia',
                'id_card' => '3571234567890003',
            ],
            [
                'nidn_nip' => '197804041999034004',
                'nama_lengkap' => 'Dr. Hendro Wicaksono, M.Sc.',
                'gelar_akademik' => 'Dr.',
                'tanggal_lahir' => '1978-04-04',
                'tempat_lahir' => 'Yogyakarta',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Malioboro No. 89, Yogyakarta',
                'role' => 'researcher',
                'affiliation' => 'Universitas Gadjah Mada',
                'email' => 'hendro.wicaksono@ugm.ac.id',
                'scopus_id' => '4567890123',
                'google_id' => 'Hendro-Wicaksono-3456',
                'wos_researcher_id' => 'JKL-3456-7890',
                'garuda_id' => '45678901',
                'level_department' => 's3',
                'department' => 'Teknik Sipil',
                'academic_grade' => 'Lektor Kepala',
                'country' => 'Indonesia',
                'id_card' => '3471234567890004',
            ],
            [
                'nidn_nip' => '198906051999035005',
                'nama_lengkap' => 'Siti Nurhaliza, M.Pd.',
                'gelar_akademik' => 'M.Pd.',
                'tanggal_lahir' => '1989-06-05',
                'tempat_lahir' => 'Semarang',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pandanaran No. 12, Semarang',
                'role' => 'lecturer',
                'affiliation' => 'Universitas Diponegoro',
                'email' => 'siti.nurhaliza@undip.ac.id',
                'scopus_id' => '5678901234',
                'google_id' => 'Siti-Nurhaliza-7890',
                'wos_researcher_id' => 'MNO-7890-1234',
                'garuda_id' => '56789012',
                'level_department' => 's2',
                'department' => 'Pendidikan Bahasa Inggris',
                'academic_grade' => 'Asisten Ahli',
                'country' => 'Indonesia',
                'id_card' => '3371234567890005',
            ],
            [
                'nidn_nip' => '197607061999036006',
                'nama_lengkap' => 'Prof. Dr. Rina Sari, S.Kom., M.Kom.',
                'gelar_akademik' => 'Prof. Dr.',
                'tanggal_lahir' => '1976-07-06',
                'tempat_lahir' => 'Medan',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Sudirman No. 234, Medan',
                'role' => 'researcher',
                'affiliation' => 'Universitas Sumatera Utara',
                'email' => 'rina.sari@usu.ac.id',
                'scopus_id' => '6789012345',
                'google_id' => 'Rina-Sari-1234',
                'wos_researcher_id' => 'PQR-1234-5678',
                'garuda_id' => '67890123',
                'level_department' => 's3',
                'department' => 'Teknik Informatika',
                'academic_grade' => 'Guru Besar',
                'country' => 'Indonesia',
                'id_card' => '1271234567890006',
            ],
            [
                'nidn_nip' => '198208071999037007',
                'nama_lengkap' => 'Dr. Ir. Bambang Supriyanto, M.Sc.',
                'gelar_akademik' => 'Dr. Ir.',
                'tanggal_lahir' => '1982-08-07',
                'tempat_lahir' => 'Makassar',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Pettarani No. 45, Makassar',
                'role' => 'lecturer',
                'affiliation' => 'Universitas Hasanuddin',
                'email' => 'bambang.supriyanto@unhas.ac.id',
                'scopus_id' => '7890123456',
                'google_id' => 'Bambang-Supriyanto-5678',
                'wos_researcher_id' => 'STU-5678-9012',
                'garuda_id' => '78901234',
                'level_department' => 's3',
                'department' => 'Teknik Kimia',
                'academic_grade' => 'Lektor Kepala',
                'country' => 'Indonesia',
                'id_card' => '7371234567890007',
            ],
            [
                'nidn_nip' => '199009081999038008',
                'nama_lengkap' => 'Ahmad Rahman, S.Pd.',
                'gelar_akademik' => 'S.Pd.',
                'tanggal_lahir' => '1990-09-08',
                'tempat_lahir' => 'Palembang',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Jenderal Sudirman No. 56, Palembang',
                'role' => 'lecturer',
                'affiliation' => 'Universitas Sriwijaya',
                'email' => 'ahmad.rahman@unsri.ac.id',
                'scopus_id' => null,
                'google_id' => 'Ahmad-Rahman-9012',
                'wos_researcher_id' => null,
                'garuda_id' => '89012345',
                'level_department' => 's1',
                'department' => 'Matematika',
                'academic_grade' => 'Asisten Ahli',
                'country' => 'Indonesia',
                'id_card' => '1671234567890008',
            ],
        ];

        // Create dosen records
        foreach ($dosenData as $data) {
            Dosen::create($data);
        }

        // Create additional random dosen using factory
        $additionalCount = max(0, 50 - count($dosenData)); // Aim for total 50 records
        if ($additionalCount > 0) {
            Dosen::factory($additionalCount)->create();
        }

        $this->command->info('Berhasil membuat ' . Dosen::count() . ' data dosen');
    }
}
