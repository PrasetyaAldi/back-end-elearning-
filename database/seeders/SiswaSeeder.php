<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Siswa::create([
            'npsn' => '12312312',
            'nisn' => '1234567891',
            'nama' => 'Siswa 1',
        ]);
        Siswa::create([
            'npsn' => '12312312',
            'nisn' => '1234567892',
            'nama' => 'Siswa 2',
        ]);
        User::create([
            'user_id' => '1234567891',
            'email' => 'eskobar@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa'
        ]);
        User::create([
            'user_id' => '1234567892',
            'email' => 'siswa2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa'
        ]);
    }
}
