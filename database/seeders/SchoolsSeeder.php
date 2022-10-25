<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'npsn' => Str::random(8),
            'nama' => Str::random(20),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
            'alamat' => Str::random(30),
            'kodesekolah' => Str::random(6)
        ]);
    }
}
