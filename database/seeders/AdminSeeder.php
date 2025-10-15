<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'admin@lppm.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('090703'),
            ]
        );
    }
}