<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sekolah::create([
            'npsn' => '12312312',
            'nama' => Str::random(20),
            'alamat' => Str::random(30),
            'kodesekolah' => '12sq3s',
        ]);
        User::create([
            'user_id' => '12312312',
            'email' => 'islamiyah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    }
}
