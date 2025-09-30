<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user sesuai informasi di halaman about
        User::create([
            'name' => 'Guna Darma Wangsa Negara',
            'email' => 'guna@example.com',
            'password' => Hash::make('password'), // Gunakan password yang aman
            'nim' => '123456789',
            'prodi' => 'Teknik Informatika'
        ]);
        
        // Membuat user tambahan jika diperlukan
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'nim' => '987654321',
            'prodi' => 'Sistem Informasi'
        ]);
    }
}
