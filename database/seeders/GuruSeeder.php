<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guru::create([
            'idguru' => '12sq3s-01',
            'npsn' => '12312312',
            'nip' => '123456789012345678',
            'nama' => 'Guru 1',
            'alamat' => 'Jl. Guru 1',
        ]);
        User::create([
            'user_id' => '12sq3s-01',
            'email' => 'guru1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru'
        ]);
    }
}
