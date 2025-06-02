<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Buku::count() === 0) {
            Buku::create([
                'kode_buku' => 'B001',
                'judul' => 'Alamat Cinta',
                'pengarang' => 'John Doe',
                'penerbit' => 'Penerbit A',
                'tahun_terbit' => 2023,
                'deskripsi' => 'Buku ini adalah novel romantis yang mengisahkan perjalanan cinta dua insan.',
                'gambar' => null,
                'kategori_id' => Kategori::where('nama', 'Fiksi')->first()->id,
                'is_available' => true,
            ]);
            Buku::create([
                'kode_buku' => 'B002',
                'judul' => 'Pemrograman PHP',
                'pengarang' => 'Jane Smith',
                'penerbit' => 'Penerbit B',
                'tahun_terbit' => 2022,
                'deskripsi' => 'Buku ini membahas dasar-dasar pemrograman PHP untuk pemula.',
                'gambar' => null,
                'kategori_id' => Kategori::where('nama', 'Non-Fiksi')->first()->id,
                'is_available' => true,
            ]);
            Buku::create([
                'kode_buku' => 'B003',
                'judul' => 'Sejarah Dunia',
                'pengarang' => 'Alice Johnson',
                'penerbit' => 'Penerbit C',
                'tahun_terbit' => 2021,
                'deskripsi' => 'Buku ini membahas sejarah dunia dari zaman prasejarah hingga modern.',
                'gambar' => null,
                'kategori_id' => Kategori::where('nama', 'Biografi')->first()->id,
                'is_available' => true,
            ]);
        }
    }
}
