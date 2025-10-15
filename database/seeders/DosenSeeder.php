<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $rows = Excel::toArray([], storage_path('app/dosen.xlsx'))[0];

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header

            User::updateOrCreate(
                ['email' => $row[1]],
                [
                    'name' => $row[0],
                    'password' => Hash::make('lpkiajaya1984'),
                ]
            );
        }
    }
}