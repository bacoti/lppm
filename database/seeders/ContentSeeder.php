<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    public function run()
    {
        Content::updateOrCreate(
            ['slug' => 'home'],
            ['title' => 'Selamat Datang di LPPM', 'body' => '<p>Ini adalah halaman beranda...</p>']
        );

        Content::updateOrCreate(
            ['slug' => 'tentang'],
            ['title' => 'Tentang Kami', 'body' => '<p>Informasi mengenai LPPM...</p>']
        );
    }
}
