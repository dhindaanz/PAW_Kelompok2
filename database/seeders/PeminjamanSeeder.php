<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Peminjaman::count() === 0) {
            Peminjaman::create([
                'user_id' => User::where('email', 'user@gmail.com')->first()->id,
                'buku_id' => Buku::where('kode_buku', 'B002')->first()->id,
                'tanggal_pinjam' => now(),
                'tanggal_wajib_kembali' => now()->addDays(7),
                'tanggal_pengembalian' => null,
            ]);
            Peminjaman::create([
                'user_id' => User::where('email', 'user@gmail.com')->first()->id,
                'buku_id' => Buku::where('kode_buku', 'B003')->first()->id,
                'tanggal_pinjam' => now()->subDays(10),
                'tanggal_wajib_kembali' => now()->subDays(3),
                'tanggal_pengembalian' => now()->subDays(5),
            ]);
            Peminjaman::create([
                'user_id' => User::where('email', 'user@gmail.com')->first()->id,
                'buku_id' => Buku::where('kode_buku', 'B001')->first()->id,
                'tanggal_pinjam' => now()->subDays(10),
                'tanggal_wajib_kembali' => now()->subDays(3),
                'tanggal_pengembalian' => now()->subDays(1),
            ]);
        }
    }
}
