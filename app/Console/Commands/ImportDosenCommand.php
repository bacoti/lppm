<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dosen;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportDosenCommand extends Command
{
    protected $signature = 'dosen:import {file=dosen.xlsx}';
    protected $description = 'Import data dosen dari file Excel di storage/app';

    public function handle()
    {
        $file = $this->argument('file');

        if (!Storage::exists($file)) {
            $this->error("File {$file} tidak ditemukan di storage/app");
            return Command::FAILURE;
        }

        $path = Storage::path($file);

        $data = Excel::toArray([], $path)[0]; // Ambil sheet pertama

        // Anggap baris pertama header
        $header = array_map('strtolower', array_shift($data));

        foreach ($data as $row) {
            $rowData = array_combine($header, $row);

            Dosen::updateOrCreate(
                ['email' => $rowData['email']],
                [
                    'name' => $rowData['nama'],
                    'password' => bcrypt('lpkiajaya1984'), // default password
                ]
            );
        }

        $this->info("Import selesai. Total dosen di database: " . Dosen::count());
        return Command::SUCCESS;
    }
}