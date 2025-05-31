<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (UserProfile::count() === 0) {
            UserProfile::create([
                'user_id' => User::where('email', 'admin@gmail.com')->first()->id,
                'nim' => '123456789',
                'prodi' => 'Teknik Informatika',
                'alamat' => 'Jl. Contoh Alamat No. 1',
                'no_hp' => '08123456789',
                'foto' => 'default.jpg',
            ]);
            UserProfile::create([
                'user_id' => User::where('email', 'user@gmail.com')->first()->id,
                'nim' => '987654321',
                'prodi' => 'Sistem Informasi',
                'alamat' => 'Jl. Contoh Alamat No. 2',
                'no_hp' => '08987654321',
                'foto' => 'default.jpg',
            ]);
        }
    }
}
