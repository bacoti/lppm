<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 sample services with different statuses
        Service::factory(5)->draft()->create();
        Service::factory(5)->ongoing()->create();
        Service::factory(5)->completed()->create();
        Service::factory(3)->hibahKompetitif()->create();
        Service::factory(2)->create(['status' => 'approved']);
    }
}