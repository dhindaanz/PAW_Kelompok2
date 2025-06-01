<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Kategori::count() === 0) {
            Kategori::create([
                'nama' => 'Fiksi',
                'deskripsi' => 'Buku fiksi adalah buku yang berisi cerita atau narasi yang dibuat berdasarkan imajinasi penulis.',
            ]);
            Kategori::create([
                'nama' => 'Non-Fiksi',
                'deskripsi' => 'Buku non-fiksi adalah buku yang berisi informasi atau fakta yang nyata dan dapat diverifikasi.',
            ]);
            Kategori::create([
                'nama' => 'Biografi',
                'deskripsi' => 'Buku biografi adalah buku yang menceritakan kehidupan seseorang, biasanya tokoh terkenal.',
            ]);
        }
    }
}
