<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterService
{
    public function register(RegisterRequest $request)
    {

        if ($request->type == 'guru') {
            $sekolah = Sekolah::where('kodesekolah', $request->kodesekolah)->firstOrFail();
            $lastIncrement = Guru::where('idguru', 'like', '%' . $sekolah->kodesekolah . '%')->orderBy('idguru', 'desc')->first();
            if (isset($lastIncrement)) {
                $lastIncrement = explode('-', $lastIncrement->idguru);
                $idguru = $sekolah->kodesekolah . '-' . str_pad((int)$lastIncrement[1] + 1, 2, 0, STR_PAD_LEFT);
            } else {
                $idguru = $sekolah->kodesekolah . '-01';
            }
            $guru = Guru::create([
                'idguru' => $idguru,
                'npsn' => $sekolah->npsn,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nip' => $request->nip ?: null,
            ]);
        } elseif ($request->type == 'sekolah') {
            $sekolah = Sekolah::create([
                'npsn' => $request->npsn,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'kodesekolah' => Str::random(6),
            ]);
        } else {
            return response()->json([
                'message' => 'type not found'
            ], 404);
        }
        User::create([
            'user_id' => $request->type == 'guru' ? $idguru : $request->npsn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->type == 'guru' ? 'guru' : 'admin',
        ]);
        return response()->json([
            'message' => 'success',
            'data' => $request->type == 'guru' ? $guru : $sekolah
        ], 200);
    }
}
