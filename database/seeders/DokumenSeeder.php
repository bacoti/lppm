<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokumens = [
            [
                'judul' => 'Panduan Lengkap Penelitian LPPM LPKIA',
                'deskripsi' => 'Dokumen panduan komprehensif untuk melakukan penelitian di Lembaga Penelitian dan Pengabdian Kepada Masyarakat Institut Digital Ekonomi LPKIA Bandung. Berisi panduan metodologi, etika penelitian, dan prosedur pengajuan proposal.',
                'file_path' => 'dokumen/panduan-penelitian-lppm-2024.pdf',
                'file_name' => 'panduan-penelitian-lppm-2024.pdf',
                'file_size' => 2048576, // 2MB
                'mime_type' => 'application/pdf',
                'status' => 'published',
            ],
            [
                'judul' => 'Template Proposal Penelitian',
                'deskripsi' => 'Template standar untuk proposal penelitian yang digunakan di LPPM LPKIA. Template ini mencakup format penulisan, struktur proposal, dan persyaratan administrasi yang harus dipenuhi.',
                'file_path' => 'dokumen/template-proposal-penelitian.docx',
                'file_name' => 'template-proposal-penelitian.docx',
                'file_size' => 512000, // 512KB
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'status' => 'published',
            ],
            [
                'judul' => 'Formulir Pengabdian Masyarakat',
                'deskripsi' => 'Formulir pengajuan kegiatan pengabdian kepada masyarakat. Berisi panduan pengisian dan persyaratan dokumen yang perlu dilampirkan untuk pengajuan program pengabdian.',
                'file_path' => 'dokumen/formulir-pengabdian-masyarakat.xlsx',
                'file_name' => 'formulir-pengabdian-masyarakat.xlsx',
                'file_size' => 256000, // 256KB
                'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'status' => 'published',
            ],
            [
                'judul' => 'Kode Etik Peneliti LPPM',
                'deskripsi' => 'Dokumen kode etik dan pedoman perilaku peneliti di LPPM LPKIA. Berisi prinsip-prinsip etika penelitian, tanggung jawab peneliti, dan sanksi pelanggaran etika.',
                'file_path' => 'dokumen/kode-etik-peneliti-lppm.pdf',
                'file_name' => 'kode-etik-peneliti-lppm.pdf',
                'file_size' => 1536000, // 1.5MB
                'mime_type' => 'application/pdf',
                'status' => 'published',
            ],
            [
                'judul' => 'Panduan Publikasi Jurnal',
                'deskripsi' => 'Panduan lengkap untuk publikasi artikel di jurnal-jurnal yang terakreditasi. Berisi tips penulisan, proses review, dan standar kualitas publikasi ilmiah.',
                'file_path' => 'dokumen/panduan-publikasi-jurnal.pdf',
                'file_name' => 'panduan-publikasi-jurnal.pdf',
                'file_size' => 1024000, // 1MB
                'mime_type' => 'application/pdf',
                'status' => 'published',
            ],
            [
                'judul' => 'Laporan Tahunan LPPM 2024',
                'deskripsi' => 'Laporan kegiatan tahunan LPPM LPKIA tahun 2024. Berisi ringkasan penelitian, pengabdian masyarakat, publikasi, dan pencapaian lainnya selama satu tahun.',
                'file_path' => 'dokumen/laporan-tahunan-lppm-2024.pdf',
                'file_name' => 'laporan-tahunan-lppm-2024.pdf',
                'file_size' => 3072000, // 3MB
                'mime_type' => 'application/pdf',
                'status' => 'published',
            ],
            [
                'judul' => 'Template Laporan Kemajuan Penelitian',
                'deskripsi' => 'Template untuk laporan kemajuan penelitian yang harus disubmit secara berkala. Template ini membantu peneliti melaporkan progress dan hasil interim penelitian.',
                'file_path' => 'dokumen/template-laporan-kemajuan.docx',
                'file_name' => 'template-laporan-kemajuan.docx',
                'file_size' => 384000, // 384KB
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'status' => 'published',
            ],
            [
                'judul' => 'Panduan Hak Kekayaan Intelektual (HAKI)',
                'deskripsi' => 'Panduan komprehensif tentang hak kekayaan intelektual untuk peneliti. Berisi informasi tentang paten, hak cipta, merek dagang, dan prosedur pendaftaran HAKI.',
                'file_path' => 'dokumen/panduan-haki-lppm.pdf',
                'file_name' => 'panduan-haki-lppm.pdf',
                'file_size' => 2048000, // 2MB
                'mime_type' => 'application/pdf',
                'status' => 'published',
            ],
        ];

        foreach ($dokumens as $dokumen) {
            Dokumen::create([
                'judul' => $dokumen['judul'],
                'deskripsi' => $dokumen['deskripsi'],
                'file_path' => $dokumen['file_path'],
                'file_name' => $dokumen['file_name'],
                'file_size' => $dokumen['file_size'],
                'mime_type' => $dokumen['mime_type'],
                'status' => $dokumen['status'],
                'slug' => Str::slug($dokumen['judul']),
                'user_id' => 1, // Assuming admin user with ID 1 exists
            ]);
        }
    }
}
